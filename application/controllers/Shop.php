<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Shop extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $product_home_slider_bottom = $this->Product_model->product_home_slider_bottom();
        $categories = $this->Product_model->productListCategories(0);
        $data["categories"] = $categories;
        $data["product_home_slider_bottom"] = $product_home_slider_bottom;
        $customarray = [1, 2];
        $this->db->where_in('id', $customarray);
        $query = $this->db->get('custome_items');
        $customeitem = $query->result();

        $data['shirtcustome'] = $customeitem[0];
        $data['suitcustome'] = $customeitem[1];

        $query = $this->db->get('sliders');
        $data['sliders'] = $query->result();

        $this->load->view('home', $data);
    }

    public function contactus() {
        $this->load->view('pages/contactus');
    }

    public function aboutus() {
        $this->load->view('pages/aboutus');
    }

    public function testinsert() {
        $foldersstrip = ['HL_41007_72.jpg', 'HL_41009_72.jpg', 'HL_41043_72.jpg', 'HL_41044_72.jpg', 'HL_41045_72.jpg', 'HL_41094_72.jpg', 'HL_51045_64.jpg', 'HL_51047_64.jpg', 'HL_51048_64.jpg', 'HL_51077_64.jpg', 'HL_51082_64.jpg', 'HL_51143_64.jpg', 'HL_51145_64.jpg', 'HL_51146_64.jpg', 'HL_51147_64.jpg', 'HL_51148_64.jpg', 'HL_51156_64.jpg', 'HL_51157_64.jpg', 'HL_51158_64.jpg', 'HL_71005_56.jpg', 'HL_71007_56.jpg', 'HL_71008_56.jpg', 'HL_71009_56.jpg', 'HL_71010_56.jpg', 'HL_71058_56.jpg', 'HL_71059_56.jpg', 'HL_71087_56.jpg', 'HL_71088_56.jpg', 'HL_71093_56.jpg', 'HL_71094_56.jpg', 'HL_71098_56.jpg', 'HL_71099_56.jpg', 'HL_71122_56.jpg', 'HL_71124_56.jpg', 'HL_71126_56.jpg', 'HL_71241_56.jpg', 'HL_71242_56.jpg', 'HL_71299_56.jpg', 'HL_71300_56.jpg', 'HL_71301_56.jpg', 'HL_71303_56.jpg'];
        $foldercheck = ['HL_42002_72.jpg', 'HL_42004_72.jpg', 'HL_42004_72.png', 'HL_42009_72.jpg', 'HL_42023_72.jpg', 'HL_42031_72.jpg', 'HL_42032_72.jpg', 'HL_42033_72.jpg', 'HL_42034_72.jpg', 'HL_42035_72.jpg', 'HL_42036_72.jpg', 'HL_42037_72.jpg', 'HL_42038_72.jpg', 'HL_42039_72.jpg', 'HL_42040_56.jpg', 'HL_42040_72.jpg', 'HL_42041_72.jpg', 'HL_42042_72.jpg', 'HL_42067_72.jpg', 'HL_42068_72.jpg', 'HL_42069_72.jpg', 'HL_42071_72.jpg', 'HL_72104_56.jpg', 'HL_72107_56.jpg', 'HL_72108_56.jpg', 'HL_72119_56.jpg', 'HL_72120_56.jpg', 'HL_72121_56.jpg', 'HL_72124_56.jpg', 'HL_72197_56.jpg', 'HL_72198_56.jpg', 'HL_72199_56.jpg', 'HL_72200_56.jpg', 'HL_72211_56.jpg', 'HL_72214_56.jpg', 'HL_72215_56.jpg', 'HL_72217_56.jpg', 'HL_72219_56.jpg', 'HL_72221_56.jpg', 'HL_72222_56.jpg', 'HL_72275_56.jpg', 'HL_72276_56.jpg', 'HL_72277_56.jpg', 'HL_72281_56.jpg', 'HL_72282_56.jpg'];

        foreach ($foldersstrip as $key => $value) {
            $folder =  $value;
            
            $titles = explode("_", $folder);

            
            $title = "BT".$titles[1];

            $products = array(
                "category_id" => 44,
                "sku" => $title,
                "title" => $title,
                "short_description" => "2 Ply 100% Cotton",
                "description" => "2 Ply 100% Cotton",
                "video_link" => "",
                "regular_price" => "95",
                "sale_price" => "0",
                "credit_limit" => "",
                "price" => "95",
                "file_name" => $folder."shirt_model20001.png",
                "file_name1" => $folder."shirt_model10001.png",
                "file_name2" => $folder."fabricx0001.png",
                "file_name3" => "",
                "user_id" => "10",
                "op_date_time" => "",
                "status" => "1",
                "home_slider" => "",
                "home_bottom"=>"",
                "keywords" => "",
                "stock_status" => "In Stock",
                "variant_product_of" => "",
                "folder" => $folder);
              #$this->db->insert('products', $products);
           
        }
    }
    
    public function testinsertsuit() {
        $foldersstrip = ['HL_41007_72.jpg', 'HL_41009_72.jpg', 'HL_41043_72.jpg', 'HL_41044_72.jpg', 'HL_41045_72.jpg', 'HL_41094_72.jpg', 'HL_51045_64.jpg', 'HL_51047_64.jpg', 'HL_51048_64.jpg', 'HL_51077_64.jpg', 'HL_51082_64.jpg', 'HL_51143_64.jpg', 'HL_51145_64.jpg', 'HL_51146_64.jpg', 'HL_51147_64.jpg', 'HL_51148_64.jpg', 'HL_51156_64.jpg', 'HL_51157_64.jpg', 'HL_51158_64.jpg', 'HL_71005_56.jpg', 'HL_71007_56.jpg', 'HL_71008_56.jpg', 'HL_71009_56.jpg', 'HL_71010_56.jpg', 'HL_71058_56.jpg', 'HL_71059_56.jpg', 'HL_71087_56.jpg', 'HL_71088_56.jpg', 'HL_71093_56.jpg', 'HL_71094_56.jpg', 'HL_71098_56.jpg', 'HL_71099_56.jpg', 'HL_71122_56.jpg', 'HL_71124_56.jpg', 'HL_71126_56.jpg', 'HL_71241_56.jpg', 'HL_71242_56.jpg', 'HL_71299_56.jpg', 'HL_71300_56.jpg', 'HL_71301_56.jpg', 'HL_71303_56.jpg'];
        $foldercheck = ['12501.jpg', '12502.jpg', '12503.jpg', '12504.jpg', '12508.jpg', '12509.jpg', '12510.jpg', '12511.jpg', '12512.jpg', '12514.jpg', '12601.jpg', '12602.jpg', '9775.jpg', '9776.jpg', '9777.jpg', '9778.jpg', '9779.jpg', '9780.jpg'];
        foreach ($foldercheck as $key => $value) {
            $folder =  $value;
            
            $titles = explode("_", $folder);

            
            $title = "BT".$titles[1];

            $products = array(
                "category_id" => 44,
                "sku" => $title,
                "title" => $title,
                "short_description" => "2 Ply 100% Cotton",
                "description" => "2 Ply 100% Cotton",
                "video_link" => "",
                "regular_price" => "95",
                "sale_price" => "0",
                "credit_limit" => "",
                "price" => "95",
                "file_name" => $folder."shirt_model20001.png",
                "file_name1" => $folder."shirt_model10001.png",
                "file_name2" => $folder."fabricx0001.png",
                "file_name3" => "",
                "user_id" => "10",
                "op_date_time" => "",
                "status" => "1",
                "home_slider" => "",
                "home_bottom"=>"",
                "keywords" => "",
                "stock_status" => "In Stock",
                "variant_product_of" => "",
                "folder" => $folder);
              #$this->db->insert('products', $products);
           
        }
    }

}
