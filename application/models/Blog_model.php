<?php
class Blog_model extends CI_Model
{

	function get_all_blog()
	{
		$result = $this->db->get('blog');
		return $result;
	}

	function search_blog($title)
	{
		$this->db->like('user_name', $title, 'both');
		$this->db->order_by('id', 'ASC');
		$this->db->limit(10);
		return $this->db->get('user')->result();
	}
}
