<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

  	public function __construct()
    {
        parent::__construct();
    }

    
	public function addRecord($table_name,$data){

		$query=$this->db->insert($table_name, $data);
	    $latest_id = $this->db->insert_id();
		return $latest_id;
	}

	public function updateRecord($table,$data,$where){

	    $this->db->where($where);
	    $this->db->update($table,$data);
		$row = $this->db->affected_rows();
	    return $row;
	}

	public function deleteRecord($table, $where){
        $this->db->where($where);
        $this->db->delete($table);   
    }

	 
	public function getRecords($table_name,$where,$order_by=null,$limit=null)
	{
	    $this->db->select('*');
	    $this->db->from($table_name);
	    $this->db->where($where); 
        if(!empty($order_by)){
            $this->db->order_by($order_by['order_by']);
        }
        if(!empty($limit)){

            $this->db->limit($limit);
        }
	    $query=$this->db->get();
	   /* echo "<br> Common_model ".$this->db->last_query();*/
	    return $query->result_array();
	}
	  
	public function getSingleRecord($table_name,$where){

	    $this->db->select('*');
	    $this->db->from($table_name);
	    if(!empty($where)){

	    	 $this->db->where($where);
	    }
	   
	    $query=$this->db->get();
	    $data=$query->row();
	    return $data;    
	}

	public function getRowCount($table_name,$where){

	    $this->db->select('*');
	    $this->db->from($table_name);
	    $this->db->where($where);
	    $query=$this->db->get();
	    $data=$query->num_rows();
	    return $data;    
	}

	public function checkExist($table,$where){
		$this->db->select('*');
	    $this->db->from($table);
	    $this->db->where($where);
	    $query=$this->db->get();
	    return $query->row();
	} 

	 public function check_email($where,$table)
    {
    	$this->db->select('*');
    	$this->db->from($table);
    	$this->db->where($where);
    	$query=$this->db->get();
    	if($query->num_rows() > 0)
    	{
    		return true;
    	}
    	else
    	{
    		return false;
    	}
    }
	
	public function LevelList(){
        $this->db->select('*');
        $this->db->from('tbl_level');
        $query=$this->db->get();
         return $query->result(); 
  }

  // to get last record of table by prtk

  public function getlastRecord($table_name){
        $this->db->select('*');
	    $this->db->from($table_name);
	  
	    $query=$this->db->get();
	    $data=$query->row();
	    return $data;    
    }
   // get all records by prtk

    public function getAllRecords($table_name,$where)
	{
	    $this->db->select('*');
	    $this->db->from($table_name);
	    $this->db->where($where); 
      
	    $query=$this->db->get();
	   /* echo "<br> Common_model ".$this->db->last_query();*/
	    return $query->result_array();
	}
	 public function getAllList($table_name,$where)
	{
	    $this->db->select('*');
	    $this->db->from($table_name);
	    $this->db->where($where); 
      	$this->db->order_by('post_id','DESC');
	    $query=$this->db->get();
	   /* echo "<br> Common_model ".$this->db->last_query();*/
	    return $query->result_array();
	}

	public function fetch_records($limit,$start,$table_name,$where)
	{
		
		$query=$this->db->select('*');
		$this->db->from($table_name);
		$this->db->where($where);
		$this->db->limit($limit,$start);
		$this->db->order_by('post_id','DESC');
		$qry_res = $this->db->get();
		$resArray=$qry_res->result_array();
		return $resArray;
		
	}


	public function getOrderByRow($table_name,$where,$order_by=null,$group_by=null){

	    $this->db->select('*');
	    $this->db->from($table_name);
	    $this->db->where($where);
	    if(!empty($order_by)){

	    	$this->db->order_by($order_by);
	    }
	    if(!empty($group_by)){

	    	$this->db->group_by($group_by);
	    }
	    $query=$this->db->get();
	    $data=$query->row();
	    return $data;    
	}
}
?>