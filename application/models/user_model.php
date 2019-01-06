<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class user_model extends CI_Controller {

	
	public function show()
	{
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		$users = $query->result();
		return $users;
	}
	function show_by_id($id)
	{
		$query = $this->db->select('id')->from('users')->where('id',$id)->get();
		if ($query->num_rows() > 0) {
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('id',$id);
			$query = $this->db->get();
			$user = $query->row();
			return $user;
		}else{
			return 'Id Not Found';
		}
	}
	function insert($name,$email)
	{
		$data=array(
			'name'=> $name,
			'email'=> $email
		);
		if ($this->db->insert('users',$data)) {
			return 'User Inset Successfull';
		}else{
			return 'Error';
		}
	}
	public function update($id,$name,$email)
	{
		$data = array(
			'name' => $name,
			'email' => $email
		);
		$query = $this->db->select('id')->from('users')->where('id',$id)->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$id);
			$this->db->update('users',$data);
			return 'Update Successfull';
		}else{
			return 'Id Not Found';
		}
	}
	public function delete($id)
	{
		$query = $this->db->select('id')->from('users')->where('id',$id)->get();
		if ($query->num_rows() > 0) {
			$this->db->where('id',$id);
			$this->db->delete('users');
			return 'Delete Successfull';
		}else{
			return 'Id Not Found';
		}
	}
}
