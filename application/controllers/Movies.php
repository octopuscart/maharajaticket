<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Movies extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('Movie');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
    }

    public function index() {
        $data['moves'] = $this->Movie->movieList();
        $this->load->view('movie/list', $data);
    }

    public function blog() {
        $data = array();
        $this->load->view('movie/blog', $data);
    }

    public function showTime($mid) {
        $movies = $this->Movie->movieList();
        $data['movie'] = $movies[$mid];

        $theater = $this->Movie->theaters($mid);

        $data['theaters'] = $theater;
        $eventdate = $this->Movie->movieevent($mid);
        $datearray = array();


        foreach ($eventdate as $key => $value) {
            $date = strtotime($value["event_date"]);

            $date_day = date('dS', $date);
            $date_day2 = date('d', $date);
            $date_month = Date('F', $date);
            $datearray[$value["event_date"]] = array("day" => $date_day, "month" => $date_month, "date" => $date_day2);
        }



        $data['datearray'] = $datearray;

        $this->load->view('movie/showtime', $data);
    }

    public function selectSit() {
        $mid = $this->input->get("movie");
        $thid = $this->input->get("theater");
        $stime = $this->input->get("selectdate");
        $sdate = $this->input->get("selecttime");
        $event_id = $this->input->get("event_id");


        $this->db->where('id', $event_id);
        $query = $this->db->get('movie_event');
        $eventobj = $query->row_array();

        $data["theater_template_id"] = $eventobj["theater_template_id"];

        $data['stime'] = $stime;
        $data['sdate'] = $sdate;
        $data['total_seats'] = $this->input->get("seats");

        $movies = $this->Movie->movieList();
        $data['movie'] = $movies[$mid];

        $theaters = $movies = $this->Movie->theaterInformation($thid);
        $data['theater'] = $theaters;
        $data['theater_id'] = $thid;

        if (isset($_POST['proceed'])) {
            $ticket = $this->input->post('ticket');
            $price = $this->input->post('price');
            $ticketarray = array(
                "ticket" => array(), "movie_id" => $mid, "total" => 0,
                "theater_id" => $thid, "selected_date" => $sdate, "selected_time" => $stime);
            foreach ($ticket as $key => $value) {
                $ticketarray["ticket"][$value] = $price[$key];
                $ticketarray["total"] += $price[$key];
            }
            $this->session->set_userdata('selectedseat', $ticketarray);
            redirect("Movies/checkout");
        }
        $this->load->view('movie/selectsit', $data);
    }

    function checkTicketExist($theater_id, $movie_id, $select_date, $select_time, $email, $contact_no) {
        $this->db->where('theater_id', $theater_id);
        $this->db->where('movie_id', $movie_id);
        $this->db->where('select_date', $select_date);
        $this->db->where('select_time', $select_time);
        $query = $this->db->get('movie_ticket_booking');
        $moviebooking = $query->row_array();
        return $moviebooking;
    }

    function bookAgain() {
        $selectedseat = $this->session->userdata('selectedseat');
        if ($selectedseat) {
            
        } else {
            redirect("Movies");
        }
        $bid = $this->input->get('booking_id');
        $this->db->where('id', $bid);
        $query = $this->db->get('movie_ticket_booking');
        $moviebooking = $query->row_array();

        $ticketlist = $selectedseat['ticket'];
        $data['ticketlist'] = $ticketlist;
        $data['total'] = $selectedseat['total'];

        $name = $moviebooking['name'];
        $email = $moviebooking['email'];
        $contact_no = $moviebooking['contact_no'];
        $paymenttype = $this->input->get('payment_type');
        $booktype = $this->input->get('booking_type');
        $bookingArray = array(
            "name" => $name,
            "email" => $email,
            "contact_no" => $contact_no,
            "select_date" => $selectedseat['selected_date'],
            "select_time" => $selectedseat['selected_time'],
            "movie_id" => $selectedseat['movie_id'],
            "theater_id" => $selectedseat['theater_id'],
            "total_price" => $selectedseat['total'],
            "payment_type" => $paymenttype,
            "payment_attr" => "",
            "payment_id" => "",
            "booking_type" => $booktype,
            "booking_time" => Date('Y-m-d'),
            "booking_date" => date('H:i:s'),
        );

        $this->db->insert('movie_ticket_booking', $bookingArray);
        $last_id = $this->db->insert_id();
        $bookid = Date('Ymd') . "" . $last_id;
        $bookid_md5 = md5($bookid);
        $this->db->set('booking_no', $bookid);
        $this->db->set('booking_id', $bookid_md5);
        $this->db->where('id', $last_id); //set column_name and value in which row need to update
        $this->db->update('movie_ticket_booking');
        foreach ($ticketlist as $vtk => $vtp) {
            $seatArray = array(
                "movie_ticket_booking_id" => $last_id,
                "seat_price" => $vtp,
                "seat" => $vtk,
            );
            $this->db->insert('movie_ticket', $seatArray);
        }
        redirect("Movies/yourTicket/" . $bookid_md5);
    }

    public function checkOut() {
        $selectedseat = $this->session->userdata('selectedseat');
        if ($selectedseat) {
            
        } else {
            redirect("Movies");
        }

        $data['stime'] = $selectedseat['selected_time'];
        $data['sdate'] = $selectedseat['selected_date'];
        $movies = $this->Movie->movieList();
        $data['movie'] = $movies[$selectedseat['movie_id']];


        $theaters = $movies = $this->Movie->theaterInformation($selectedseat['theater_id']);
        $data['theater'] = $theaters;

        $data['theater_id'] = $selectedseat['theater_id'];
        $ticketlist = $selectedseat['ticket'];
        $data['ticketlist'] = $ticketlist;
        $data['total'] = $selectedseat['total'];
        $data['checkpre'] = "no";
        if (isset($_GET['checkpre'])) {
            $checkmess = $this->input->get('checkpre');
            $data['checkpre'] = $checkmess;
        }

        if (isset($_POST['payment'])) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact_no');
            $paymenttype = $this->input->post('paymenttype');
            $bookingArray = array(
                "name" => $name,
                "email" => $email,
                "contact_no" => $contact_no,
                "select_date" => $selectedseat['selected_date'],
                "select_time" => $selectedseat['selected_time'],
                "movie_id" => $selectedseat['movie_id'],
                "theater_id" => $selectedseat['theater_id'],
                "total_price" => $selectedseat['total'],
                "payment_type" => $paymenttype,
                "payment_attr" => "",
                "payment_id" => "",
                "booking_type" => "Purchase",
                "booking_time" => Date('Y-m-d'),
                "booking_date" => date('H:i:s'),
            );

            $checkpreviouse = $this->checkTicketExist(
                    $selectedseat['theater_id'],
                    $selectedseat['movie_id'],
                    $selectedseat['selected_date'],
                    $selectedseat['selected_time'],
                    $email,
                    $contact_no
            );
            if ($checkpreviouse) {
                $bookid = $checkpreviouse['id'];
                redirect("Movies/checkOut?checkpre=exist&book_id=$bookid&booking_type=Purchase&paymenttype=" . $paymenttype);
            } else {
                $this->db->insert('movie_ticket_booking', $bookingArray);
                $last_id = $this->db->insert_id();
                $bookid = Date('Ymd') . "" . $last_id;
                $bookid_md5 = md5($bookid);
                $this->db->set('booking_no', $bookid);
                $this->db->set('booking_id', $bookid_md5);
                $this->db->where('id', $last_id); //set column_name and value in which row need to update
                $this->db->update('movie_ticket_booking');
                foreach ($ticketlist as $vtk => $vtp) {
                    $seatArray = array(
                        "movie_ticket_booking_id" => $last_id,
                        "seat_price" => $vtp,
                        "seat" => $vtk,
                    );
                    $this->db->insert('movie_ticket', $seatArray);
                }
                redirect("Movies/yourTicketView/" . $bookid_md5);
            }
        }

        if (isset($_POST['reserve'])) {
            $name = $this->input->post('name');
            $email = $this->input->post('email');
            $contact_no = $this->input->post('contact_no');
            $bookingArray = array(
                "name" => $name,
                "email" => $email,
                "contact_no" => $contact_no,
                "select_date" => $selectedseat['selected_date'],
                "select_time" => $selectedseat['selected_time'],
                "movie_id" => $selectedseat['movie_id'],
                "theater_id" => $selectedseat['theater_id'],
                "payment_type" => "",
                "payment_attr" => "",
                "payment_id" => "",
                "booking_type" => "Reserve",
                "booking_time" => Date('Y-m-d'),
                "booking_date" => date('H:i:s'),
                "total_price" => $selectedseat['total'],
            );
            $this->db->insert('movie_ticket_booking', $bookingArray);
            $last_id = $this->db->insert_id();

            $bookid = Date('Ymd') . "" . $last_id;
            $bookid_md5 = md5($bookid);

            $this->db->set('booking_no', $bookid);
            $this->db->set('booking_id', $bookid_md5);
            $this->db->where('id', $last_id); //set column_name and value in which row need to update
            $this->db->update('movie_ticket_booking');

            foreach ($ticketlist as $vtk => $vtp) {
                $seatArray = array(
                    "movie_ticket_booking_id" => $last_id,
                    "seat_price" => $vtp,
                    "seat" => $vtk,
                );
                $this->db->insert('movie_ticket', $seatArray);
            }
            redirect("Movies/yourTicketView/" . $bookid_md5);
        }


        $this->load->view('movie/checkout', $data);
    }

    public function yourTicket($bookingid) {
        $this->db->where('booking_id', $bookingid);
        $query = $this->db->get('movie_ticket_booking');
        $bookingobj = $query->row_array();
        $movies = $this->Movie->movieList();
        $data['movieobj'] = $movies[$bookingobj['movie_id']];


        $theaters = $movies = $this->Movie->theaterInformation($bookingobj['theater_id']);
        $data['theater'] = $theaters;

        $data['booking'] = $bookingobj;
        $data['seats'] = $this->Movie->bookedSeatById($bookingobj['id']);
        $this->load->view('movie/ticketview', $data);
    }

    public function yourTicketView($bookingid) {
        $this->db->where('booking_id', $bookingid);
        $query = $this->db->get('movie_ticket_booking');

        $bookingobj = $query->row_array();
        $movies = $this->Movie->movieList();
        $data['movieobj'] = $movies[$bookingobj['movie_id']];


        $theaters = $this->Movie->theaterInformation($bookingobj['theater_id']);
        $data['theater'] = $theaters;

        $data['booking'] = $bookingobj;
        $data['seats'] = $this->Movie->bookedSeatById($bookingobj['id']);

        $emailsender = email_sender;
        $sendername = email_sender_name;
        $email_bcc = email_bcc;

        $this->email->set_newline("\r\n");
        $this->email->from(email_bcc, $sendername);
        $this->email->to($bookingobj['email']);
        $this->email->bcc(email_bcc);

        $subject = "Your Movie Ticket(s) for " . $movies[$bookingobj['movie_id']]['title'];
        $this->email->subject($subject);


        $message = $this->load->view('movie/ticketviewemail', $data, true);
        setlocale(LC_MONETARY, 'en_US');
        $checkcode = REPORT_MODE;
        $checkcode = 1;
        if ($checkcode) {
            $this->email->message($message);
            $this->email->print_debugger();
            $send = $this->email->send();
            if ($send) {
//                echo json_encode("send");
                redirect("Movies/yourTicket/$bookingid");
            } else {
                $error = $this->email->print_debugger(array('headers'));
                echo json_encode($error);
            }
        } else {
            echo $message;
//            redirect("Movies/yourTicket/$bookingid");
        }
    }

    function getMovieQR($bookingid) {
        $this->load->library('phpqr');
        $linkdata = site_url("Movies/yourTicket/" . $bookingid);
        header('Content-type: image/jpeg');
        $this->phpqr->createcode2($linkdata);
    }

    public function ticketPaymentCancel($bookingid = 0) {
        $data['has_bookid'] = "0";
        $data["booking_id"] = $bookingid;
        $data['message'] = "";
        if ($bookingid == "0") {
            if (isset($_POST['findbooking'])) {
                $bookingid = $this->input->post('booking_id');
                $this->db->where('booking_no', $bookingid);
                $query = $this->db->get('movie_ticket_booking');
                $bookingobj = $query->row_array();
                if ($bookingobj) {
                    $bookingid = $bookingobj['booking_id'];
                    redirect("Movies/ticketPayment/$bookingid");
                } else {
                    $data['message'] = "Booking no. not found.";
                }
            }
        } else {
            $data['has_bookid'] = "1";

            $this->db->where('booking_id', $bookingid);
            $query = $this->db->get('movie_ticket_booking');
            $bookingobj = $query->row_array();
            $movies = $this->Movie->movieList();
            $data['movieobj'] = $movies[$bookingobj['movie_id']];


            $theaters = $this->Movie->theaterInformation($bookingobj['theater_id']);
            $data['theater'] = $theaters;

            $data['booking'] = $bookingobj;
            $data['seats'] = $this->Movie->bookedSeatById($bookingobj['id']);
            if (isset($_POST['payment'])) {
                $paymenttype = $this->input->post('reason');
                $bid = $bookingobj["id"];
                $bookingArray = array(
                    "payment_attr" => $paymenttype,
                    "booking_type" => "Cancel",
                    "booking_time" => Date('Y-m-d'),
                    "booking_date" => date('H:i:s'),
                );
                $this->db->set($bookingArray);
                $this->db->where('id', $bid); //set column_name and value in which row need to update
                $this->db->update('movie_ticket_booking');

                $this->db->set("status", "0");
                $this->db->where('movie_ticket_booking_id', $bid); //set column_name and value in which row need to update
                $this->db->update('movie_ticket');

                redirect("Movies/yourTicketView/" . $bookingid);
            }
        }
        $this->load->view('movie/ticketcancel', $data);
    }

    public function ticketPayment($bookingid = 0) {

        $data['message'] = "";

        if ($bookingid == "0") {
            $data['has_bookid'] = "0";
            if (isset($_POST['findbooking'])) {
                $bookingid = $this->input->post('booking_id');
                $this->db->where('booking_no', $bookingid);
                $query = $this->db->get('movie_ticket_booking');
                $bookingobj = $query->row_array();
                if ($bookingobj) {
                    $bookingid = $bookingobj['booking_id'];
                    redirect("Movies/ticketPayment/$bookingid");
                } else {
                    $data['message'] = "Booking no. not found.";
                }
            }
        } else {
            $data['has_bookid'] = "1";
         
            $this->db->where('booking_id', $bookingid);
            $query = $this->db->get('movie_ticket_booking');
            $bookingobj = $query->row_array();

         
            $movies = $this->Movie->movieList();
            $data['movieobj'] = $movies[$bookingobj['movie_id']];

              $theaters = $this->Movie->theaterInformation($bookingobj['theater_id']);
            $data['theater'] = $theaters;
            $data['booking'] = $bookingobj;
            $data['seats'] = $this->Movie->bookedSeatById($bookingobj['id']);
            if (isset($_POST['payment'])) {
                $paymenttype = $this->input->post('paymenttype');
                $bookingArray = array(
                    "payment_type" => $paymenttype,
                    "payment_attr" => "",
                    "payment_id" => "",
                    "booking_type" => "Purchase",
                    "booking_time" => Date('Y-m-d'),
                    "booking_date" => date('H:i:s'),
                );
                $this->db->set($bookingArray);
                $this->db->where('booking_no', $bookingid); //set column_name and value in which row need to update
                $this->db->update('movie_ticket_booking');
                redirect("Movies/yourTicketView/" . $bookingid);
            }
        }
        $this->load->view('movie/ticketpayment', $data);
    }

    public function payment() {
        
    }

}
