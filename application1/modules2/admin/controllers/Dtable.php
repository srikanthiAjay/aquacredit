<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dtable extends CI_Controller {

   public function __construct() {
      parent::__construct();
      $this->load->database();
   }

   public function index()
   {
      $this->load->view('product_list');
   }

   public function get_products()
   {
      $draw = intval($this->input->get("draw"));
      $start = intval($this->input->get("start"));
      $length = intval($this->input->get("length"));

      $query = $this->db->get("products");
      $data = [];
      foreach($query->result() as $r) {
           $data[] = array(
                $r->id,
                $r->name,
                $r->price
           );
      }

      $result = array(
               "draw" => $draw,
                 "recordsTotal" => $query->num_rows(),
                 "recordsFiltered" => $query->num_rows(),
                 "data" => $data
            );
      echo json_encode($result);
      exit();
   }
}