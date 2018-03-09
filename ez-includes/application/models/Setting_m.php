<?php

class Setting_M extends MY_Model {

  protected $_table_name = 'settings';
  protected $_order_by = 'order asc';
  public $rules = array();

    public function update($data, $key) {
        $this->db->where('key', $key);
        $this->db->update($this->_table_name, $data);
        return true;
    }


}