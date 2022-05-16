<?php

	class Post_tag_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $count;
	        $data;
	        $lastInsertId;
	    }

	    public function get($id = false)
		{
				$query  = $this->db->get_where('post_tag', array('post_id'=> $id));
				$result = $query->result();

			$this->count = sizeof($result);
	        return $result;

		}
		public function get_posts()
		{
			$query = $this->db->select('post_tag.*,tag.nome as tag_nome')
							  ->from('post_tag')
							  ->join('tag','post_tag.tag_id = tag.id')
							  ->group_by('tag_id')
							  ->order_by('tag.nome ASC')
							  ->get();
			$result = $query->result();

			$this->count = sizeof($result);
	        return $result;

		}

		public function save($post_id, $tags_array)
		{
			//deletar primeiro
			$this->db->where('post_id', $post_id);
        	$this->db->delete('post_tag');

			foreach ($tags_array as $t => $v) {
				    $data = array(
				        'post_id' => $post_id,
				        'tag_id'  => $v 
				    );
				$query = $this->db->insert('post_tag', $data);
			}

			
			$this->lastInsertId = $this->db->insert_id();
			return $query;
		}

	}
?>