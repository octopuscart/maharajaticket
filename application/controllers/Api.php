<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH . 'libraries/REST_Controller.php');

class Api extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Movie');
        $this->load->library('session');
        $this->checklogin = $this->session->userdata('logged_in');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $this->load->view('welcome_message');
    }

    //function for product list
    function cartOperation_post() {
        $product_id = $this->post('product_id');
        $quantity = $this->post('quantity');

        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity, $this->user_id);
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartOperation($product_id, $quantity);
            $session_cart = $this->Product_model->cartData();
        }

        $this->response($session_cart['products'][$product_id]);
    }

    function cartOperation_get() {
        if ($this->checklogin) {
            $session_cart = $this->Product_model->cartData($this->user_id);
        } else {
            $session_cart = $this->Product_model->cartData();
        }
        $this->response($session_cart);
    }

    function cartOperationDelete_get($product_id) {
        if ($this->checklogin) {
            $cartdata = $this->Product_model->cartData($this->user_id);
            $cid = $cartdata['products'][$product_id]['id'];
            $this->db->where('id', $cid); //set column_name and value in which row need to update
            $this->db->delete('cart'); //
        } else {
            $session_cart = $this->session->userdata('session_cart');
            unset($session_cart['products'][$product_id]);
            $this->session->set_userdata('session_cart', $session_cart);
        }
    }

    function cartOperationPut_get($product_id, $quantity) {
        if ($this->checklogin) {
            $cartdata = $this->Product_model->cartData($this->user_id);
            $total_price = $cartdata['products'][$product_id]['price'] * $quantity;
            $total_quantity = $quantity;
            $cid = $cartdata['products'][$product_id]['id'];
            $this->db->set('quantity', $total_quantity);
            $this->db->set('total_price', $total_price);
            $this->db->where('id', $cid); //set column_name and value in which row need to update
            $this->db->update('cart'); //
        } else {
            $session_cart = $this->session->userdata('session_cart');
            $session_cart['products'][$product_id]['quantity'] = $quantity;
            $price = $session_cart['products'][$product_id]['price'];
            $session_cart['products'][$product_id]['total_price'] = $quantity * $price;
            $this->session->set_userdata('session_cart', $session_cart);
        }
    }

    //Product 
    public function SearchSuggestApi_get() {
        $query = $this->get("query");
//        $query = $this->db->select('title, id, file_name, price')->from('products')->where("title LIKE '%$keyword%' ")->get();
//        $searchobj = $query->result_array();

        $pquery = "SELECT title, file_name, id, price from products where title like '%$query%'";
        $attr_products = $this->Product_model->query_exe($pquery);


        $this->response($attr_products);
    }

    public function prefetchdata_get() {
        $pquery = "SELECT title, file_name, id, price from products ";
        $attr_products = $this->Product_model->query_exe($pquery);
        $this->response($attr_products);
    }

    public function SearchSuggestApiJUI_get() {
        $getdata = $this->get();
        $keyword = $getdata['term'];
        $query = $this->db->select('title, id')->from('products')->where("keywords LIKE '%$keyword%'")->get();
        $searchobj = $query->result_array();
        $this->response($searchobj);
    }

    //ProductList APi
    public function productListApi_get($category_id) {
        $attrdatak = $this->get();
        $products = [];
        $countpr = 0;
        $pricequery = "";

        if (isset($attrdatak["minprice"])) {
            $mnpricr = $attrdatak["minprice"] - 1;
            $mxpricr = $attrdatak["maxprice"] + 1;
            unset($attrdatak["minprice"]);
            unset($attrdatak["maxprice"]);
            $pricequery = " and (price between '$mnpricr' and '$mxpricr') ";
        }

        foreach ($attrdatak as $key => $atv) {
            if ($atv) {
                $countpr += 1;
                $key = str_replace("a", "", $key);
                $val = str_replace("-", ", ", $atv);
                $query_attr = "SELECT product_id FROM product_attribute
                           where  attribute_id in ($key) and attribute_value_id in ($val)
                           group by product_id";
                $queryat = $this->db->query($query_attr);
                $productslist = $queryat->result();
                foreach ($productslist as $key => $value) {
                    array_push($products, $value->product_id);
                }
            }
        }
        //print_r($products);

        $productdict = [];

        $productcheck = array_count_values($products);


        //print_r($productcheck);

        foreach ($productcheck as $key => $value) {
            if ($value == $countpr) {
                array_push($productdict, $key);
            }
        }

        $proquery = "";
        if (count($productdict)) {
            $proquerylist = implode(",", $productdict);
            $proquery = " and pt.id in ($proquerylist) ";
        }

        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");

        $product_query = "select pt.id as product_id, pt.*
            from products as pt where pt.category_id in ($categoriesString) and variant_product_of = '' $pricequery $proquery";
        $product_result = $this->Product_model->query_exe($product_query);

        $productListSt = [];

        $productListFinal = [];

        $pricecount = [];

        foreach ($product_result as $key => $value) {
            $value['attr'] = $this->Product_model->singleProductAttrs($value['product_id']);
            array_push($productListSt, $value['product_id']);
            array_push($pricecount, $value['price']);
            $variantproduct = $this->Product_model->getProductVeriants($value['product_id']);

            if ($variantproduct) {
                $value['hasvarient'] = '1';
                $value['varients'] = $variantproduct;
                $value['selectedobject'] = $value['product_id'];
                $value['selectedvarient'] = $variantproduct[$value['product_id']];
            } else {
                $value['hasvarient'] = '0';
                $value['verients'] = [];
                $value['selectedvarient'] = array();
            }

            array_push($productListFinal, $value);
        }

        $attr_filter = array();
        $pricelist = array();
        if (count($productListSt)) {
            $pricelist = array('maxprice' => max($pricecount), 'minprice' => min($pricecount));


            $productString = implode(",", $productListSt);


            $attr_query = "select count(cav.id) product_count, '' as checked, cvv.widget, cav.attribute_value, cav.additional_value, cav.id, pa.attribute, pa.attribute_id from product_attribute as pa
        join category_attribute_value as cav on cav.id = pa.attribute_value_id
        join category_attribute as cvv on cvv.id = cav.attribute_id
        where pa.product_id in ($productString)
        group by cav.id";
            $attr_result = $this->Product_model->query_exe($attr_query);


            foreach ($attr_result as $key => $value) {
                $filter = $value['attribute_id'];
                $attitle = $value['attribute'];
                $widget = $value['widget'];
                if (isset($attr_filter[$filter])) {
                    array_push($attr_filter[$filter], $value);
                } else {
                    $attr_filter[$filter] = array("title" => $attitle, "attrs" => [], "widget" => $widget);
                    array_push($attr_filter[$filter], $value);
                }
            }
        }

        $this->output->set_header('Content-type: application/json');
        $this->db->where('offer', 1);
        $this->db->limit(5);
        $query = $this->db->get('products');
        $offerproduct = $query->result_array();
        $productArray = array('attributes' => $attr_filter,
            'products' => $productListFinal,
            'product_count' => count($product_result),
            'offers' => $offerproduct,
            'price' => $pricelist);
        $this->response($productArray);
    }

    public function productListOffersApi_get() {
        $this->output->set_header('Content-type: application/json');
        $this->db->where('offer', 1);
        $this->db->limit(6);
        $this->db->order_by("id desc");
        $query = $this->db->get('products');
        $offerproduct = $query->result_array();
        $this->response($offerproduct);
    }

    //ProductList APi
    public function productListSearchApi_get($searchkey) {
        $attrdatak = $this->get();
        $products = [];
        $countpr = 0;
        $searchtext = $searchkey;

        if (isset($attrdatak["minprice"])) {
            $mnpricr = $attrdatak["minprice"] - 1;
            $mxpricr = $attrdatak["maxprice"] + 1;
            unset($attrdatak["minprice"]);
            unset($attrdatak["maxprice"]);
            $pricequery = " and (price between '$mnpricr' and '$mxpricr') ";
        }

        foreach ($attrdatak as $key => $atv) {
            if ($atv) {
                $countpr += 1;
                $key = str_replace("a", "", $key);
                $val = str_replace("-", ", ", $atv);
                $query_attr = "SELECT product_id FROM product_attribute
                           where  attribute_id in ($key) and attribute_value_id in ($val)
                           group by product_id";
                $queryat = $this->db->query($query_attr);
                $productslist = $queryat->result();
                foreach ($productslist as $key => $value) {
                    array_push($products, $value->product_id);
                }
            }
        }
        //print_r($products);

        $productdict = [];

        $productcheck = array_count_values($products);


        //print_r($productcheck);

        foreach ($productcheck as $key => $value) {
            if ($value == $countpr) {
                array_push($productdict, $key);
            }
        }

        $proquery = "";
        if (count($productdict)) {
            $proquerylist = implode(",", $productdict);
            $proquery = " and pt.id in ($proquerylist) ";
        }

        $categoriesString = $this->Product_model->stringCategories($category_id) . ", " . $category_id;
        $categoriesString = ltrim($categoriesString, ", ");

        $product_query = "
                       
    select * from(
    (select pt.id as product_id, pt.* from products as pt where keywords like '%$searchtext%') 
    union
    (select pt.id as product_id, pt.* from products as pt where title like '%$searchtext%' )
        ) as pt where pt.id > 0 

                "
                . " $pricequery $proquery";
        $product_result = $this->Product_model->query_exe($product_query);

        $productListSt = [];

        $productListFinal = [];

        $pricecount = [];

        foreach ($product_result as $key => $value) {
            $value['attr'] = $this->Product_model->singleProductAttrs($value['product_id']);
            array_push($productListSt, $value['product_id']);
            array_push($pricecount, $value['price']);
            array_push($productListFinal, $value);
        }

        $attr_filter = array();
        $pricelist = array();
        if (count($productListSt)) {
            $pricelist = array('maxprice' => max($pricecount), 'minprice' => min($pricecount));


            $productString = implode(",", $productListSt);


            $attr_query = "select count(cav.id) product_count, '' as checked, cav.attribute_value, cav.id, pa.attribute, pa.attribute_id from product_attribute as pa
        join category_attribute_value as cav on cav.id = pa.attribute_value_id
        where pa.product_id in ($productString)
        group by cav.id";
            $attr_result = $this->Product_model->query_exe($attr_query);


            foreach ($attr_result as $key => $value) {
                $filter = $value['attribute'];
                if (isset($attr_filter[$filter])) {
                    array_push($attr_filter[$filter], $value);
                } else {
                    $attr_filter[$filter] = [];
                    array_push($attr_filter[$filter], $value);
                }
            }
        }
        ob_clean();
        $this->output->set_header('Content-type: application/json');
        $productArray = array('attributes' => $attr_filter,
            'products' => $productListFinal,
            'product_count' => count($product_result),
            'price' => $pricelist);
        $this->response($productArray);
    }

    //category list api
    function categoryMenu_get() {
        $categories = $this->Product_model->productListCategories(0);
        $this->response($categories);
    }

    //order detail get
    function orderDetails_get($order_id) {
        $order_details = $this->Product_model->getOrderDetails($order_id);
        $this->response($order_details);
    }

    function order_mail_get($order_id, $order_no) {
        $subject = "Order Confirmation - Your Order with www.bespoketailorshk.com [$order_no] has been successfully placed!";
        //$this->Product_model->order_mail($order_id, $subject);
    }

    function order_mailcheck_get($order_id, $order_no) {
        $this->db->where('order_id', $order_id);
        $query = $this->db->get('user_order_log');
        $orderlog = $query->result_array();
        if (count($orderlog)) {
            $this->response(array('checkpre' => '1'));
        } else {
            $this->response(array('checkpre' => '0'));
        }
    }

    function order_mailchecksend_get($order_id, $order_no) {
        $subject = "Order Confirmation - Your Order with www.bespoketailorshk.com [$order_no] has been successfully placed!";
        // $this->Product_model->order_mail($order_id, $subject);
    }

    function orderMailVender_get($order_id) {
        // $this->Product_model->order_mail_to_vendor($order_id);
        $this->response("hell");
    }

    //function for product list

    function createRange($start, $end, $total, $gapes, $row, $booked, $reserve, $gap) {
        //A Availble, B:Booked, R Reserved
        $temp = array();
        $temprow = array();
        for ($i = $start; $i <= $end; $i++) {
            $trow = $row . "-" . $i;
            $temp[$trow] = $trow;
        }
        for ($i = 1; $i <= $total; $i++) {
            $trow = $row . "-" . $i;
            if (isset($temp[$trow])) {
                $temprow[$trow] = "A";
            } else {
                $temprow[$trow] = "";
            }
            if (isset($booked[$trow])) {
                $temprow[$trow] = "B";
            }
            if (isset($reserve[$trow])) {
                $temprow[$trow] = "R";
            }
            if (isset($gap[$i])) {
                $trow = $row . "-" . $i . "_" . $gap[$i];
                $temprow[$trow] = "";
            }
        }
        foreach ($gapes as $key => $value) {
            $trow = $row . "-" . $value;
            $temprow[$trow] = "";
        }

        return $temprow;
    }

    function getBookedSheats($inputarray) {
        $sdate = $inputarray['sdate'];
        $stime = $inputarray['stime'];
        $th_id = $inputarray['th_id'];
        $mv_id = $inputarray['mv_id'];
        $seats = $this->Movie->getSelectedSeats($th_id, $mv_id, $sdate, $stime);
        $resurve = array();
        foreach ($seats as $key => $value) {
            $resurve[$value['seat']] = "";
        }
        return $resurve;
    }

    function getLayout_GH_V_WALK_get() {

        $reserveseats = $this->getBookedSheats($this->get());
        $booked = $reserveseats;
        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];
        $gaps = array();
        $layout = array(
            "totalinrow" => 20,
            "sitclass" => array(
                "class1" => array(
                    "price" => "200",
                    "rowcount" => "2",
                    "color" => "#fff",
                    "row" => array(
                        "A" => $this->createRange(6, 13, 19, [], "A", $booked, $reserved, $gaps),
                        "B" => $this->createRange(3, 16, 19, [], "B", $booked, $reserved, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => "220",
                    "rowcount" => "5",
                    "color" => "#fff",
                    "row" => array(
                        "C" => $this->createRange(3, 17, 19, [], "C", $booked, $reserved, $gaps),
                        "D" => $this->createRange(3, 17, 19, [], "D", $booked, $reserved, $gaps),
                        "E" => $this->createRange(3, 17, 19, [], "E", $booked, $reserved, $gaps),
                        "F" => $this->createRange(3, 18, 19, [], "F", $booked, $reserved, $gaps),
                        "G" => $this->createRange(1, 19, 19, [], "G", $booked, $reserved, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

    function getLayoutGrandOcean_get() {
        $booked = $this->getBookedSheats($this->get());
        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];

        $gaps = array("7" => "", "25" => "");
        $layout = array(
            "totalinrow" => 35,
            "sitclass" => array(
                "class1" => array(
                    "price" => $classprice[0]["class_price"],
                    "rowcount" => "2",
                    "color" => "#ffc0b266",
                    "row" => array(
                        "A" => $this->createRange(8, 25, 32, [], "A", $booked, $reserved, $gaps),
                        "B" => $this->createRange(1, 32, 32, [], "B", $booked, $reserved, $gaps),
                        "C" => $this->createRange(1, 32, 32, [], "C", $booked, $reserved, $gaps),
                        "D" => $this->createRange(1, 32, 32, [], "D", $booked, $reserved, $gaps),
                        "E" => $this->createRange(1, 32, 32, [], "E", $booked, $reserved, $gaps),
                        "F" => $this->createRange(1, 32, 32, [], "F", $booked, $reserved, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => $classprice[1]["class_price"],
                    "rowcount" => "5",
                    "color" => "#ffe0b266",
                    "row" => array(
                        "G" => $this->createRange(5, 28, 32, [25, 26, 7, 8], "G", $booked, $reserved, $gaps),
                        "H" => $this->createRange(5, 28, 32, [], "H", $booked, $reserved, $gaps),
                        "I" => $this->createRange(5, 28, 32, [], "I", $booked, $reserved, $gaps),
                        "J" => $this->createRange(5, 28, 32, [], "J", $booked, $reserved, $gaps),
                    )
                ),
                "class3" => array(
                    "price" => $classprice[2]["class_price"],
                    "rowcount" => "5",
                    "color" => "#ff572247",
                    "row" => array(
                        "K" => $this->createRange(1, 32, 32, [24, 25, 9, 8], "K", $booked, $reserved, $gaps),
                        "L" => $this->createRange(1, 32, 32, [24, 25, 9, 8], "L", $booked, $reserved, $gaps),
                        "M" => $this->createRange(1, 32, 32, [24, 25, 9, 8], "M", $booked, $reserved, $gaps),
                        "N" => $this->createRange(1, 32, 32, [], "N", $booked, $reserved, $gaps),
                        "O" => $this->createRange(1, 32, 32, [], "O", $booked, $reserved, $gaps),
                        "P" => $this->createRange(1, 32, 32, [], "P", $booked, $reserved, $gaps),
                        "Q" => $this->createRange(27, 32, 32, [], "Q", $booked, $reserved, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

    function getLayout_GH_HSE4_get() {

        $reserveseats = $this->getBookedSheats($this->get());
        $booked = $reserveseats;

        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];

        $gaps = array("4" => "", "19" => "");
        $layout = array(
            "totalinrow" => 25,
            "sitclass" => array(
                "class1" => array(
                    "price" => $classprice[0]["class_price"],
                    "rowcount" => "2",
                    "color" => "#ffc0b266",
                    "row" => array(
                        "B" => $this->createRange(1, 22, 22, [16], "B", $booked, $reserved, $gaps),
                        "C" => $this->createRange(1, 22, 22, [], "C", $booked, $reserved, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => $classprice[1]["class_price"],
                    "rowcount" => "6",
                    "color" => "#ffe0b266",
                    "row" => array(
                        "D" => $this->createRange(1, 22, 22, [16], "D", $booked, $reserved, $gaps),
                        "E" => $this->createRange(1, 22, 22, [], "E", $booked, $reserved, $gaps),
                        "F" => $this->createRange(1, 22, 22, [16], "F", $booked, $reserved, $gaps),
                        "G" => $this->createRange(1, 22, 22, [], "G", $booked, $reserved, $gaps),
                    )
                ),
                "class3" => array(
                    "price" => $classprice[2]["class_price"],
                    "rowcount" => "5",
                    "color" => "#ff572247",
                    "row" => array(
                        "H" => $this->createRange(1, 22, 22, [16], "H", $booked, $reserved, $gaps),
                        "I" => $this->createRange(1, 22, 22, [], "I", $booked, $reserved, $gaps),
                        "J" => $this->createRange(1, 22, 22, [16], "J", $booked, $reserved, $gaps),
                        "K" => $this->createRange(1, 22, 22, [], "K", $booked, $reserved, $gaps),
                        "L" => $this->createRange(1, 22, 22, [16], "L", $booked, $reserved, $gaps),
                        "M" => $this->createRange(1, 22, 22, [], "M", $booked, $reserved, $gaps),
                        "N" => $this->createRange(1, 22, 22, [16], "N", $booked, $reserved, $gaps),
                        "O" => $this->createRange(1, 22, 22, [], "O", $booked, $reserved, $gaps),
                        "P" => $this->createRange(1, 22, 22, [16, 5, 6, 7, 8, 9], "P", $booked, $reserved, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

    function getLayout_GH_HSE4B_get() {

        $reserveseats = $this->getBookedSheats($this->get());
        $booked = $reserveseats;

        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];

       $gaps = array("4" => "", "19" => "");
        $layout = array(
            "totalinrow" => 25,
            "sitclass" => array(
                "class1" => array(
                    "price" => count($classprice) ? $classprice[0]["class_price"] : 0,
                    "rowcount" => "2",
                    "color" => "#fff",
                    "row" => array(
                        "B" => $this->createRange(1, 22, 22, [16], "B", $booked, $reserved, $paid, $gaps),
                        "C" => $this->createRange(1, 22, 22, [], "C", $booked, $reserved, $paid, $gaps),
                        "D" => $this->createRange(1, 22, 22, [16], "D", $booked, $reserved, $paid, $gaps),
                        "E" => $this->createRange(1, 22, 22, [], "E", $booked, $reserved, $paid, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => count($classprice) ? $classprice[1]["class_price"] : 0,
                    "rowcount" => "6",
                    "color" => "#fff",
                    "row" => array(
                        "F" => $this->createRange(1, 22, 22, [16], "F", $booked, $reserved, $paid, $gaps),
                        "G" => $this->createRange(1, 22, 22, [], "G", $booked, $reserved, $paid, $gaps),
                        "H" => $this->createRange(1, 22, 22, [16], "H", $booked, $reserved, $paid, $gaps),
                        "I" => $this->createRange(1, 22, 22, [], "I", $booked, $reserved, $paid, $gaps),
                        "J" => $this->createRange(1, 22, 22, [16], "J", $booked, $reserved, $paid, $gaps),
                        "K" => $this->createRange(1, 22, 22, [], "K", $booked, $reserved, $paid, $gaps),
                    )
                ),
                "class3" => array(
                    "price" => count($classprice) ? $classprice[2]["class_price"] : 0,
                    "rowcount" => "5",
                    "color" => "#fff",
                    "row" => array(
                        
                        "L" => $this->createRange(1, 22, 22, [16], "L", $booked, $reserved, $paid, $gaps),
                        "M" => $this->createRange(1, 22, 22, [], "M", $booked, $reserved, $paid, $gaps),
                        "N" => $this->createRange(1, 22, 22, [16], "N", $booked, $reserved, $paid, $gaps),
                        "O" => $this->createRange(1, 22, 22, [], "O", $booked, $reserved, $paid, $gaps),
                        "P" => $this->createRange(1, 22, 22, [16, 5, 6, 7, 8, 9], "P", $booked, $reserved, $paid, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

    function getLayout_GH_HSE3_get() {
        $seats = $this->getBookedSheats($this->get());
        $reserveseats = $this->getBookedSheats($this->get());
        $booked = $reserveseats;
        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];


        $gaps = array("4" => "", "19" => "");
        $layout = array(
            "totalinrow" => 24,
            "sitclass" => array(
                "class1" => array(
                    "price" => $classprice[0]["class_price"],
                    "rowcount" => "2",
                    "color" => "#ffc0b266",
                    "row" => array(
                        "B" => $this->createRange(1, 21, 21, [19], "B", $booked, $reserved, $gaps),
                        "C" => $this->createRange(1, 21, 21, [], "C", $booked, $reserved, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => $classprice[1]["class_price"],
                    "rowcount" => "6",
                    "color" => "#ffe0b266",
                    "row" => array(
                        "D" => $this->createRange(1, 21, 21, [19], "D", $booked, $reserved, $gaps),
                        "E" => $this->createRange(1, 21, 21, [], "E", $booked, $reserved, $gaps),
                        "F" => $this->createRange(1, 21, 21, [19], "F", $booked, $reserved, $gaps),
                        "G" => $this->createRange(1, 21, 21, [], "G", $booked, $reserved, $gaps),
                        "H" => $this->createRange(1, 21, 21, [19], "H", $booked, $reserved, $gaps),
                        "I" => $this->createRange(1, 21, 21, [], "I", $booked, $reserved, $gaps),
                    )
                ),
                "class3" => array(
                    "price" => $classprice[2]["class_price"],
                    "rowcount" => "5",
                    "color" => "#ff572247",
                    "row" => array(
                        "J" => $this->createRange(1, 21, 21, [19], "J", $booked, $reserved, $gaps),
                        "K" => $this->createRange(1, 21, 21, [], "K", $booked, $reserved, $gaps),
                        "L" => $this->createRange(1, 21, 21, [19], "L", $booked, $reserved, $gaps),
                        "M" => $this->createRange(1, 21, 21, [], "M", $booked, $reserved, $gaps),
                        "N" => $this->createRange(1, 21, 21, [19], "N", $booked, $reserved, $gaps),
                        "O" => $this->createRange(1, 21, 21, [], "O", $booked, $reserved, $gaps),
                        "P" => $this->createRange(1, 21, 21, [19], "P", $booked, $reserved, $gaps),
                        "Q" => $this->createRange(1, 21, 21, [20, 21, 3], "Q", $booked, $reserved, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

    function getLayout_GH_HSE3B_get() {
        $seats = $this->getBookedSheats($this->get());
        $reserveseats = $this->getBookedSheats($this->get());
        $booked = $reserveseats;
        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];


        $gaps = array("4" => "", "19" => "");
        $layout = array(
            "totalinrow" => 24,
            "sitclass" => array(
                "class1" => array(
                    "price" => $classprice[0]["class_price"],
                    "rowcount" => "2",
                    "color" => "#ffc0b266",
                    "row" => array(
                        "B" => $this->createRange(1, 21, 21, [19], "B", $booked, $reserved, $gaps),
                        "C" => $this->createRange(1, 21, 21, [], "C", $booked, $reserved, $gaps),
                        "D" => $this->createRange(1, 21, 21, [19], "D", $booked, $reserved, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => $classprice[1]["class_price"],
                    "rowcount" => "6",
                    "color" => "#ffe0b266",
                    "row" => array(
                        "E" => $this->createRange(1, 21, 21, [], "E", $booked, $reserved, $gaps),
                        "F" => $this->createRange(1, 21, 21, [19], "F", $booked, $reserved, $gaps),
                        "G" => $this->createRange(1, 21, 21, [], "G", $booked, $reserved, $gaps),
                        "H" => $this->createRange(1, 21, 21, [19], "H", $booked, $reserved, $gaps),
                        "I" => $this->createRange(1, 21, 21, [], "I", $booked, $reserved, $gaps),
                    )
                ),
                "class3" => array(
                    "price" => $classprice[2]["class_price"],
                    "rowcount" => "5",
                    "color" => "#ff572247",
                    "row" => array(
                        "J" => $this->createRange(1, 21, 21, [19], "J", $booked, $reserved, $gaps),
                        "K" => $this->createRange(1, 21, 21, [], "K", $booked, $reserved, $gaps),
                        "L" => $this->createRange(1, 21, 21, [19], "L", $booked, $reserved, $gaps),
                        "M" => $this->createRange(1, 21, 21, [], "M", $booked, $reserved, $gaps),
                        "N" => $this->createRange(1, 21, 21, [19], "N", $booked, $reserved, $gaps),
                        "O" => $this->createRange(1, 21, 21, [], "O", $booked, $reserved, $gaps),
                        "P" => $this->createRange(1, 21, 21, [19], "P", $booked, $reserved, $gaps),
                        "Q" => $this->createRange(1, 21, 21, [20, 21, 3], "Q", $booked, $reserved, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

    function getLayout_GH_HSE1_get() {
        $reserveseats = $this->getBookedSheats($this->get());
        $booked = $reserveseats;
        $templateobj = $this->Movie->theaterTemplate($this->get("template_id"));
        $classprice = $templateobj["class_price"];
        $reserved = $templateobj["reserve_seats"];
        $gaps = array("4" => "", "19" => "");
        $layout = array(
            "totalinrow" => 26,
            "sitclass" => array(
                "class1" => array(
                    "price" => $classprice[0]["class_price"],
                    "rowcount" => "2",
                    "color" => "#ffc0b266",
                    "row" => array(
                        "C" => $this->createRange(1, 24, 24, [], "C", $booked, $reserved, $gaps),
                        "D" => $this->createRange(1, 24, 24, [19], "D", $booked, $reserved, $gaps),
                    )
                ),
                "class2" => array(
                    "price" => $classprice[1]["class_price"],
                    "rowcount" => "6",
                    "color" => "#ffe0b266",
                    "row" => array(
                        "E" => $this->createRange(1, 24, 24, [], "E", $booked, $reserved, $gaps),
                        "F" => $this->createRange(1, 24, 24, [19], "F", $booked, $reserved, $gaps),
                        "G" => $this->createRange(1, 24, 24, [], "G", $booked, $reserved, $gaps),
                        "H" => $this->createRange(1, 24, 24, [19], "H", $booked, $reserved, $gaps),
                        "I" => $this->createRange(1, 24, 24, [], "I", $booked, $reserved, $gaps),
                    )
                ),
                "class3" => array(
                    "price" => $classprice[2]["class_price"],
                    "rowcount" => "5",
                    "color" => "#ff572247",
                    "row" => array(
                        "J" => $this->createRange(1, 24, 24, [19], "J", $booked, $reserved, $gaps),
                        "K" => $this->createRange(1, 24, 24, [], "K", $booked, $reserved, $gaps),
                        "L" => $this->createRange(1, 24, 24, [19], "L", $booked, $reserved, $gaps),
                        "M" => $this->createRange(1, 24, 24, [], "M", $booked, $reserved, $gaps),
                        "N" => $this->createRange(1, 24, 24, [19], "N", $booked, $reserved, $gaps),
                        "O" => $this->createRange(1, 24, 24, [5, 6, 7, 12], "O", $booked, $reserved, $gaps),
                    )
                ),
            )
        );
        $this->response($layout);
    }

}

?>