<?php

class Siteconfig extends CI_Model {

 public function __construct()
 {
    parent::__construct();
 }

 public function get_all()
 {
    return $this->db->get('config_data');
 }

}