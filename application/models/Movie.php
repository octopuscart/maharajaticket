<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Movie extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    function movieList() {
        $movies = array(
            "m1" =>
            array(
                "id" => "m1",
                "title" => "Baaghi 3",
                "attr" => "Hindi-U/A-2D",
                "image" => "baaghi.jpg",
                "about" => "This action-drama is the third installment in Sajid Nadiadwala’s martial arts movie series Baaghi. Loaded with power-packed stunts and high-octane thrills, the film promises a fast-paced narrative full of unexpected twists and turns."
            ),
            "m2" =>
            array("title" => "Dolittle",
                "id" => "m2",
                "attr" => "English-U-3D",
                "image" => "dolittle.jpg",
                "about" => "This fantasy-adventure is centered on the titular character created by Hugh Lofting for the series of books- The Voyages of Doctor Dolittle. The plot revolves around a physician who is blessed with the ability to talk to animals. The narrative is balanced with endearing moments as well as witty humour throughout. The ensemble cast of the film includes six Oscar winners.

",
            ),
            "m3" =>
            array("title" => "Bhoot",
                "id" => "m3",
                "attr" => "Hindi-A-2D",
                "image" => "bhoot.jpg",
                "about" => "Produced by Karan Johar's Dharma Productions, Bhoot: Part One - The Haunted Ship marks the beginning of the horror franchise. Starring Vicky Kaushal and Bhumi Pednekar in pivotal roles, the film is reportedly based on a true incident which occurred in Mumbai. Packed with all the essential chills and thrills, the film will be helmed by debutant director Bhanu Pratap Singh.

",
            ),
           
            "m5" =>
            array("title" => "Tanhaji: The Unsung Warrior",
                "id" => "m5",
                "attr" => "Hindi-U/A-3D",
                "image" => "tanhaji.jpg",
                "about" => "This period action film brings alive the story of Tanaji Malusare, a brave military leader of the Maratha empire. He is most famously known for his role in the Battle of Sinhagad in 1670 A.D. Laced with rich historical elements and stunning battle scenes, the movie offers a detailed insight into the life and times of the celebrated Maratha hero.

",
            )
        );
        return $movies;
    }

    function theaters() {
        $listoftheaters = array(
            "GH-V-WALK" => array(
                "title" => "GH V WALK - House 5",
                "timing" => ["10:40", "13:40", "17:40"],
                "layout" => "getLayout_GH_V_WALK",
                "active" => 0,
            ),
            "GH-HS1" => array(
                "title" => "GH Whampoa - House 1",
                "timing" => ["09:40", "15:40", "18:40", "21:10"],
                "layout" => "getLayout_GH_HSE1",
                "active" => 0,
            ),
            "GH-HSE3" => array(
                "title" => "GH Whampoa - House 3",
                "timing" => ["10:45", "14:45", "16:45", "20:50", "23:15"],
                "layout" => "getLayout_GH_HSE3",
                "active" => 1,
            ),
            "GH-HS4" => array(
                "title" => "GH Whampoa - House 4",
                "timing" => ["11:45", "14:30", "22:15"],
                "layout" => "getLayout_GH_HSE4",
                "active" => 0,
            ),
            "GRND-OCE" => array(
                "title" => "Grand Ocean (Tsim Sha Tsui)",
                "timing" => ["09:45", "13:45", "15:45", "21:50"],
                "layout" => "getLayoutGrandOcean",
                "active" => 1,
            )
        );
        return $listoftheaters;
    }

    function bookedSeatById($booking_id) {
        $this->db->select("*");
        $this->db->where('movie_ticket_booking_id', $booking_id);
        $query = $this->db->get('movie_ticket');
        $moviebooking = $query->result_array();
        return $moviebooking;
    }

    function getSelectedSeats($theater_id, $movie_id, $select_date, $select_time) {
        $this->db->select("*");
        $this->db->where('theater_id', $theater_id);
        $this->db->where('movie_id', $movie_id);
        $this->db->where('select_date', $select_date);
        $this->db->where('select_time', $select_time);
        $query = $this->db->get('movie_ticket_booking');
        $moviebooking = $query->result_array();
        $seats = [];
        foreach ($moviebooking as $mbkey => $mbvalue) {
            $bookingid = $mbvalue['id'];
            $booking_seat = $this->bookedSeatById($bookingid);
            foreach ($booking_seat as $skey => $svalue) {
                array_push($seats, $svalue);
            }
        }
        return $seats;
    }
    
      function booking_mail($order_id, $subject = "") {
        setlocale(LC_MONETARY, 'en_US');
        $checkcode = REPORT_MODE;
        
        
        $this->db->where('booking_id', $bookingid);
        $query = $this->db->get('movie_ticket_booking');
        $bookingobj = $query->row_array();
        $movies = $this->movieList();
        $data['movieobj'] =  $movies[$bookingobj['movie_id']];
        
        $theaters = $this->Movie->theaters();
       
        $data['theater'] = $theaters[$bookingobj['theater_id']];
        $data['booking'] = $bookingobj;
        $data['seats'] = $this->Movie->bookedSeatById($bookingobj['id']);
        $this->load->view('movie/ticketviewemail', $data);

        $emailsender = email_sender;
        $sendername = email_sender_name;
        $email_bcc = email_bcc;

        if ($order_details) {
            $order_no = $order_details['order_data']->order_no;
            $this->email->set_newline("\r\n");
            $this->email->from(email_bcc, $sendername);
            $this->email->to($order_details['order_data']->email);
            $this->email->bcc(email_bcc);

            $orderlog = array(
                'log_type' => 'Email',
                'log_datetime' => date('Y-m-d H:i:s'),
                'order_id' => $order_id,
            );
            $this->db->insert('user_order_log', $orderlog);

            $subject = "Your Movie Ticket(s) for";
            $this->email->subject($subject);

            $this->db->where('booking_id', $bookingid);
            $query = $this->db->get('movie_ticket_booking');
            $bookingobj = $query->row_array();
            $data['booking'] = $bookingobj;
            $data['seats'] = $this->bookedSeatById($bookingobj['id']);
            $this->load->view('movie/ticketview');

            if ($checkcode) {
                $this->email->message($this->load->view('Email/order_mail', $order_details, true));
                $this->email->print_debugger();
                $send = $this->email->send();
                if ($send) {
                    echo json_encode("send");
                } else {
                    $error = $this->email->print_debugger(array('headers'));
                    echo json_encode($error);
                }
            } else {
                echo $this->load->view('Email/order_mail', $order_details, true);
            }
        }
    }

}
