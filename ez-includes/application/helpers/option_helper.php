<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function add_option($name,$value,$place='theme',$style='text')
{
      $CI =& get_instance();
      $CI->load->database();
    $query=$CI->db->select('*')->from('ez_option')->where('option_name',$name)->get();

    //option already exists
    if($query->num_rows() > 0)
        return false;

    $data_type='text';
    if(is_array($value))
    {
        $data_type='array';
        $value=serialize($value);
    }
    elseif(is_object($value))
    {
        $data_type='object';
        $value=serialize($value);
    }

    $data=array(
        'option_name'=>$name,
        'option_value'=>$value,
        'option_type'=>$data_type,
        'option_place'=>$place,
        'option_style'=>$style,
    );
    $CI->db->insert('ez_option',$data);
}

function update_option($name,$value)
{
    $CI =& get_instance();
    $CI->load->database();

    $data_type='text';
    if(is_array($value))
    {
        $data_type='array';
        $value=serialize($value);
    }
    elseif(is_object($value))
    {
        $data_type='object';
        $value=serialize($value);
    }

    $data=array(
        'option_name'=>$name,
        'option_value'=>$value,
        'option_type'=>$data_type,
    );
    $query=$CI->db->select('*')->from('ez_option')->where('option_name',$name)->get();

    //if option already exists then update else insert new
    if($query->num_rows() < 1) return $CI->db->insert('ez_option',$data);
    else          return $CI->db->update('ez_option',$data,array('option_name'=>$name));
}

function is_option($name)
{
    $CI =& get_instance();
    $CI->load->database();

    $query=$CI->db->select('*')->from('ez_option')->where('option_name',$name)->get();

    //if option already exists then update else insert new
    if($query->num_rows() < 1) return FALSE;
    else return TRUE;
}
function get_option($name)
{
    $CI =& get_instance();
    $CI->load->database();
    $query=$CI->db->select('*')->from('ez_option')->where('option_name',$name)->get();
    //option not found
    if($query->num_rows() < 1) return false;      $option=$query->row();

    if('text'==$option->option_type)
        $value=$option->option_value;
    elseif('array'==$option->option_type || 'object'==$option->option_type)
        $value=unserialize($option->option_value);

    return $value;
}

function delete_option($name)
{
    $CI =& get_instance();
    $CI->load->database();
    return $CI->db->delete('ez_option',array('option_name'=>$name));
}