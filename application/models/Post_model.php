<?php

	class Post_model extends  CI_model{

		function __construct() 
	    {
	        parent::__construct();
	        $count;
	        $data;
	        $lastInsertId;
	    }

	    public function get($id = false)
		{

			if($id)
			{
				$query  = $this->db->get_where('post', array('id'=> $id), 1);
				$result = $query->result();
				$result = $result[0];

			}
			else{
				$query  = $this->db->from('post');
				$result = $query->result();
			}

			$this->count = sizeof($result);
	        return $result;

		}

		public function get_paginate($p = null, $i = null){

			$first = ($i*$p)-$i;

			$busca = $this->input->get('q');

			$this->db->escape_like_str($busca);
			$busca = strtoupper($busca);
			$busca = explode(' ', $busca);
			//var_dump($busca);

			//Busca
			if( $this->input->get('q') ){ 
				$this->db->select('post.*');
				$this->db->from('post');
				foreach($busca as $c){             
					$this->db->like("UPPER(post.busca)",strtoupper($c),'both');            
				}
				$query = $this->db->limit($i, $first)->get();

				$this->db->select('post.*');
				$this->db->from('post');
				foreach($busca as $c){             
					$this->db->like("UPPER(post.busca)",strtoupper($c),'both');            
				}
				$result=$this->db->order_by($order)->get()->result();

				$this->count = count($result);

			}
			else {
				
				$query = $this->db->order_by('data', 'DESC')
								  ->get('post', $i, $first);
				
				$this->count = $this->db->count_all_results('post');

			}

			$this->data  = $query->result();

			return $this->data;
		
		}


		public function get_paginate_tag($p = null, $i = null,$tag){


			$query = $this->db->from('post_tag')
						  ->where('tag_id',$tag)
					  	  ->get();
			$r = $query->result();
			$count = sizeof($r);
			$list = "";

			if ($count > 0) {
				foreach ($r as $q) {
					 $list .= $q->post_id.",";
				}
			}
			$list = rtrim($list,",");
			$sql = "SELECT * FROM post WHERE id IN ('".$list."') ORDER BY titulo ASC";
			//$sql = "SELECT * FROM some_table WHERE id IN ? AND status = ? AND author = ? LIMI";
			//var_dump($list);
            $qu = $this->db->query($sql);
            $rr = $qu->result();
			$this->data  =  $rr;

			return $this->data;
		
		}

		public function get_paginate_cat($p = null, $i = null,$cat_id){

			$first = ($i*$p)-$i;
			
			$query = $this->db->where('categoria_id',$cat_id)
							  ->order_by('titulo', 'ASC')
						  	  ->get('post', $i, $first);

			$this->count = $this->db->where('categoria_id',$cat_id)
									->count_all_results('post');

			$this->data  = $query->result();

			return $this->data;
		
		}


		public function get_home($i = null){
				
			$query = $this->db->order_by('id', 'DESC')
							  ->get('post', $i);
			
			$this->data  = $query->result();

			return $this->data;		
		}


	}
?>