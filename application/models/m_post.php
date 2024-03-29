<?php
class m_post extends CI_Model
{
    function get_posts($number = 10, $start = 0)
    {
        $this->db->select();
        $this->db->from('posting');
        $this->db->order_by('date_added','desc');
        $this->db->limit($number, $start);
        $query = $this->db->get();
        return $query->result_array();
    }
	function search_posts($query)
	{
		$this->db->select();
		$this->db->from('posts');
		$this->db->like("post_title", $query, 'both');
		$this->db->or_like("post", $query, 'both');
		$this->db->order_by('date_added', 'desc');
		$query = $this->db->get();
		return $query->result_array();
	}
    function get_post_count()
    {
        $this->db->select()->from('posting');
        $query = $this->db->get();
        return $query->num_rows;
    }
    function get_post($post_id)
    {
        $this->db->select();
        $this->db->from('posting');
        $this->db->where('post_id',$post_id);
        $this->db->order_by('date_added','desc');
        $query = $this->db->get();
        return $query->first_row('array');
    }
    function insert_post($data)
    {
        $this->db->insert('posting',$data);
        return $this->db->insert_id();
    }

    function update_post($post_id, $data)
    {
        $this->db->where('post_id',$post_id);
        $this->db->update('posting',$data);
    }

    function delete_post($post_id)
    {
        $this->db->where('post_id',$post_id);
        $this->db->delete('posting');
    }
}
