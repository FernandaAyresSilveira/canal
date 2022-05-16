<?php
class MY_Controller extends CI_Controller {

    public $dados_globais;


    function __construct() {

        parent::__construct();
        $this->load->helper('funcoes_helper');

		$this->load->model('Categoria_model', 'categoria');
		$this->load->model('Tag_model', 'tag');
		$this->load->model('Post_tag_model', 'post_tag');

        $this->dados_globais['tags_posts'] = $this->post_tag->get_posts();
        $this->dados_globais['categorias'] = $this->categoria->get();

    }

}