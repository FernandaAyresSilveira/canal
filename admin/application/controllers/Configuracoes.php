<?php 

	class Configuracoes extends MY_Controller {

		function __construct() {
        
	        parent::__construct();
	        $this->load->model('Configuracao_model', 'configuracao');

	    }

		public function index()
		{
			redirect('configuracoes/contato');
		}



		/* ==================== GERAIS ==================== */
		public function gerais()
		{	

			$data['configuracoes'] = $this->configuracao->getOne();

			$this->load->view('estrutura/topo');
			$this->load->view('configuracoes/gerais', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM GERAIS ==================== */




		/* ==================== FUNÇÃO SALVAR GERAIS ==================== */
		public function funcao_salvar_gerais()
		{	
			$conf = $this->configuracao->getOne();
			$id = $conf->id;

			$this->configuracao->salvarGerais($id);

			$this->session->set_flashdata('mensagem', 'Configurações gerais salvas com sucesso!');
			$this->session->set_flashdata('tipo', 'sucesso');

			redirect('configuracoes/gerais');
		}
		/* ==================== FIM FUNÇÃO SALVAR GERAIS ==================== */




		/* ==================== ANALYTICS ==================== */
		public function analytics()
		{	

			$data['configuracoes'] = $this->configuracao->getOne();


			$this->load->view('estrutura/topo');
			$this->load->view('configuracoes/analytics', $data);
			$this->load->view('estrutura/rodape');
		}
		/* ==================== FIM ANALYTICS ==================== */
		


		/* ==================== FUNÇÃO SALVAR ANALYTICS ==================== */
		public function funcao_salvar_analytics()
		{


			$conf = $this->configuracao->getOne();
			$id = $conf->id;

			$this->configuracao->salvarAnalytics($id);

			$this->session->set_flashdata('mensagem', 'Analytics salvo com sucesso!');
			$this->session->set_flashdata('tipo', 'sucesso');

			redirect('configuracoes/analytics');

		}
		/* ==================== FIM FUNÇÃO SALVAR ANALYTICS ==================== */



		/* ==================== CONTATO ==================== */
		public function contato()
		{
			$this->load->model("Configuracao_model", "configuracao");
			$data['configuracoes'] = $this->configuracao->getOne();

			$data['estados'] = $this->estado->get();

			$this->load->view('estrutura/topo');
			$this->load->view('configuracoes/contato', $data);
			$this->load->view('estrutura/rodape');

		}
		/* ==================== FIM CONTATO ==================== */



		/* ==================== FUNÇÃO SALVAR CONTATO ==================== */
		public function funcao_salvar_contato()
		{

			$conf = $this->configuracao->getOne();
			$id = $conf->id;

			$this->configuracao->salvarContato($id);

			$this->session->set_flashdata('mensagem', 'Configurações de contato salvas com sucesso!');
			$this->session->set_flashdata('tipo', 'sucesso');

			redirect('configuracoes/contato');
			

		}
		/* ==================== FIM FUNÇÃO SALVAR CONTATO ==================== */


}
