<?php
class MY_Controller extends CI_Controller {

    public $dados_globais;


    function __construct() {

        parent::__construct();

        /* Ler do banco tudo que for necessário em TODAS as views, e salvar em $this->dados_globais EX: $this->dados_globais['administradores'] */

    
        /* ==================== VERIFICAÇÃO LOGIN ==================== */
        if( !$this->session->userdata('logado') && $this->uri->segment(2) != 'login' ){//Libera a opção de login para o usuário não logado

            //Salva qual página o usuário tentou acessar, para redirecionar após o login
            $this->session->set_flashdata('redirecionar', current_url());
           redirect('usuarios/login');

        }
        /* ==================== FIM VERIFICAÇÃO LOGIN ==================== */
    
        $this->load->model("Estado_model", "estado");

        $this->load->model("Configuracao_model", "configuracao");
        $this->dados_globais['configuracao'] =  $this->configuracao->getOne() ;

         $this->load->helper('funcoes_helper');



        /* ===== Lista os administradores do painel, NÃO É NECESSÁRIO REFAZER ESTA LEITURA EM NENHUMA CONTROLLER ===== */
        // $a = new Administrador();
        // $a->order_by('nome');
        // $this->dados_globais['administradores'] = $a->get();

        $this->load->model('Usuario_model', 'usuario');
        $this->dados_globais['usuarios'] = $this->usuario->get();

        $this->load->model('Anuncio_model', 'anuncio');
        $this->dados_globais['total_anuncios'] = $this->anuncio->total_anuncios();
        $this->dados_globais['pedido_aguardando'] = $this->anuncio->pedidos_aguardando();
        $this->dados_globais['pedido_pago'] = $this->anuncio->pedidos_pagos();
        $this->dados_globais['pedido_enviado'] = $this->anuncio->pedidos_enviados();
        $this->dados_globais['pedido_revistaria'] = $this->anuncio->pedido_revistaria();

        $this->dados_globais['lista_aguardando'] = $this->anuncio->lista_pedidos_aguardando();

        $this->load->model('Avaliacao_model', 'avaliacao');        
        $this->dados_globais['avaliacoes'] = $this->avaliacao->novas();

        //var_dump($this->dados_globais['lista_aguardando']);
        //echo "<pre>";

       // $data1 = new DateTime( '2013-12-11' ); 
        


       
      


        /* ===== URL para o multiupload, ENVIA PARA A FUNÇÃO MULTIUPLOAD DA CONTROLADORA ATUAL, ONDE O MULTIUPLOAD ESTA SENDO CHAMADO ===== */
        /* ===== EXEMPLO: CONTROLADOR_ATUAL/funcao_multiupload ===== */
        $con = $this->router->class.'/funcao_multiupload';
        $this->dados_globais['multiupload'] = site_url($con);


    
        


       

    }

}