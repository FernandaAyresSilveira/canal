<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Painel Hostche 4.0 BETA</title>
	<link rel="shortcut icon" href="<?php echo base_url('./assets/img/favicon.ico'); ?>" />
	<!-- META TAGS -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- CSS -->
	<?php 
		echo link_tag('./assets/css/botoes.css');
		echo link_tag('./assets/css/estrutura.css');
		echo link_tag('./assets/css/formularios.css');
		echo link_tag('./assets/css/listas.css');
		echo link_tag('./assets/css/menu-topo.css');
		echo link_tag('./assets/css/menu-lateral.css');
		echo link_tag('./assets/css/padrao.css');
		echo link_tag('./assets/css/fancybox.css');
		echo link_tag('./assets/css/switchery.css');
		echo link_tag('./assets/css/validationEngine.jquery.css');
    	echo link_tag('./assets/css/jquery-ui.css');
    	echo link_tag('./assets/css/uploadify.css');
    ?>
   <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Open+Sans:300,400" rel="stylesheet">
	<!-- JS -->
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery-ui.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/filestyle.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/fancybox.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/smoothscroll.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/switchery.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/tinymce.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.validationEngine.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.validationEngine-pt_BR.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/mascaras.js'); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.uploadify.min.js')."?t=".microtime(true); ?>"></script>
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/funcoes.js'); ?>"></script>
	<script>
		$(document).ready( function(){
			
			/* ===== Multiupload ===== */
			$('#file_upload').uploadify({
		        'swf'      : '../../assets/swf/uploadify.swf',
		        'uploader' : '<?php echo $this->dados_globais['multiupload']; ?>',
		        'auto': false,
		        'onQueueComplete' : function(queueData) {
		           document.getElementById("botao-upload").style.display = "block";
		        }
		    });


			$(".fancybox").fancybox();
			$(".fancybox_ajax").fancybox({type: 'ajax'});
			$(".fancybox-iframe").fancybox({
		        'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});

			$("form").validationEngine();

			/* ===== Foca no primeiro input da página ===== */
			$("input").first().focus();

			/* ===== Calendario ===== */
			$(".datepicker").datepicker();

			/* ===== Efeito após o login ===== */
			<?php if( $this->session->userdata('efeito') ){  $this->session->set_userdata('efeito', false);  ?>
				$("#barra-topo, #barra-lateral, #caminho-pao, #conteudo").hide();

				$("#barra-topo").toggle("slide", { direction: "up" }, function(){
					$("#barra-lateral").toggle("slide", { direction: "left" }, function(){
						$("#caminho-pao").toggle("slide", { direction: "right" }, function(){
							$("#conteudo").fadeIn(500);
						});
					});
				});

			<?php } ?>

			
			/* ===== Editor web textarea ===== */
			tinymce.init({
			    mode : "textareas",
			    language : 'pt_BR',
			    editor_selector : "textarea-form",
			    forced_root_block : 'p',
			    height : 200,
			    menubar: "false",
			    relative_urls: false,
			    remove_script_host : false,
				document_base_url : "",				    
			    plugins: [
			        "advlist autolink lists link image charmap preview anchor",
			        "searchreplace visualblocks code fullscreen",
			        "insertdatetime media table contextmenu paste"
			    ],
			    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link"
			});


			/* ===== Mascaras ===== */
			$('.mascara-data').mask('00/00/0000');
			$('.mascara-hora').mask('00:00:00');
			$('.mascara-data-hora').mask('00/00/0000 00:00:00');
			$('.mascara-cep').mask('00000-000');
			$('.mascara-telefone-simples').mask('0000-0000');
			$('.mascara-telefone').mask('(00) 0000-0000');
			$('.mascara-celular').mask('(00) 0000-00000');
			$('.mascara-cpf').mask('000.000.000-00', {reverse: true});
			$('.mascara-cnpj').mask('00.000.000/0000-00', {reverse: true});
			$('.mascara-dinheiro').mask('000.000.000.000.000,00', {reverse: true});
			//$('.money2').mask("#.##0,00", {reverse: true, maxlength: false});
			$('.mascara-ip').mask('099.099.099.099');
			$('.mascara-percentual').mask('##0,00%', {reverse: true});


			/* ===== Exibe a opção de editar a notícia/artigo ===== */
			$("#botao-editar").click( function(event){
				$("#area-editar").slideToggle(600);
			});

			/* ===== Exibe o código fonte ===== */
			$("#mostrar-codigo").click( function(event){
				event.preventDefault();
				$(".textarea-codigo").slideToggle(600);
			});

			/* ===== Esconde os avisos ===== */
			$(".aviso-sucesso, .aviso-erro, .aviso-neutro").delay(200).slideDown(200).delay(3000).slideUp(200);

			/* ===== Exibe-Esconde a lista de usuários, no topo ===== */
			$(".item-usuarios").click( function(){
				$("#area-configuracoes").slideUp(100, function(){
					$("#usuarios-topo").slideToggle(200);
				})
			});

			/* ===== Exibe/Esconde as configurações do site, no topo ===== */
			$(".item-configuracoes").click( function(){
				$("#usuarios-topo").slideUp(100, function(){
					$("#area-configuracoes").slideToggle(200);
				})
			});

			/* ===== Input file customizado ===== */
			$("input[type=file]").nicefileinput({ 
				label : 'Selecionar...' // Spanish label
			});


			/* ===== Exibe Botão Topo ===== */
			$(window).scroll(function(){
				//var h = $('#wrap').height();
				var y = $(window).scrollTop();

				if( y > 200 ){
					$("#botao-topo").fadeIn();
			  	} else {
					$('#botao-topo').fadeOut();
				}
			});


			/* ===== Checkbox estilo iOS 7 MANTER SEMPRE POR ULTIMO!!! ===== */
			var elems = document.querySelectorAll('.checkbox-form');

			for (var i = 0; i < elems.length; i++) {
				var switchery = new Switchery(elems[i]);
			}

			/* ===== MENU ===== */
			$('.item-menu span').click( function(){
				
				if( $(this).parent('.item-menu').children('.nivel1').is(':visible') ){//Item já aberto
					$(this).parent('.item-menu').children('.nivel1').slideUp(200);
				}
				else {
					$('.nivel1, .nivel2').slideUp(200);
					$(this).parent('.item-menu').children('.nivel1').slideDown(200);
					
				}

			});

			$('.nivel1 .item-menu').click( function(){
				$(this).children('.nivel2').toggle('blind');

				// if( $(this).children('.nivel2').children('.nivel2').is(':visible') ){//Item já aberto
				// 	$(this).children('.nivel2').children('.nivel2').slideUp(200);
				// }
				// else {
				// 	$(this).children('.nivel2').slideUp(200);
				// 	$(this).children('.nivel2').children('.nivel1').slideDown(200);
					
				// }

			});


		});

	
		$(function(){
			$("#sortable").sortable({

				update: function() {
					var order   = $('#sortable').sortable('serialize');
					var url = $("#url_ordenar").val();

					$.ajax({ type: "GET",   
					 		url: url+'?'+order,   
					        async: false
					});//FIM AJAX

					//$("#lista_ordenada").load(url+'?'+order);
				}
			});
			$("#sortable").disableSelection();
		});

	</script>
</head>
<body>

	

	<!-- TOPO -->
	<div id="barra-topo">

		<a href="<?php echo site_url(); ?>" id="logo-topo">
			<img src="<?php echo base_url('./assets/img/logo.png'); ?>" title="Hostche Interatividade Digital, www.hostche.com.br" alt="Hostche Interatividade Digital" />
		</a>


		<!-- MENU TOPO -->
		<ul id="menu-topo">

			<li class="item-menu-topo item-usuarios">
				<div class="icone"></div> Usuários <div class="marcador-submenu-topo"></div>
			</li>

			<li class="item-menu-topo item-configuracoes">
				<div class="icone"></div> Configurações <div class="marcador-submenu-topo"></div>
			</li>

			<!-- <li class="item-menu-topo item-documentacao">
				<a href="<?php echo site_url('documentacao'); ?>">
					<div class="icone"></div> &nbsp;&nbsp;&nbsp;  Documentação 
				</a>
			</li> -->

		</ul>
		<!-- FIM MENU TOPO -->


			
			<div id="usuario-topo">

				<img src="<?php echo $this->session->userdata('foto'); ?>" class="imagem-usuario" title="<?php echo $this->session->userdata('nome'); ?>" />

				<div class="nome-usuario"> <?php echo $this->session->userdata('nome'); ?> </div>
				<div class="marcador-submenu-topo"></div>

				<br class="clear" />

				<ul id="opcoes-topo">
					<li class="item-opcao editar-perfil"> <div></div> <a href="<?php echo site_url('administradores/editar/'.$this->session->userdata('id')); ?>"> Editar perfil </a> </li>
					<li class="item-opcao logout"> <div></div> <a href="<?php echo site_url('administradores/logout'); ?>"> Sair </a> </li>
				</ul>


			</div>



			<div id="area-alerta-topo">

				<ul id="alerta-topo">

				

					<li class="item-alerta" title="<?php echo $this->dados_globais['candidatos']; ?> novos candidatos para trabalhar em sua empresa">

						<a href="<?php echo site_url('trabalhes/listar'); ?>" class="icone-alerta icone-campainha">
							<?php if( $this->dados_globais['candidatos'] != 0 ){ ?>
								<div class="numero-alerta"> <?php echo $this->dados_globais['candidatos']; ?> </div>
							<?php } ?>
						</a>

					</li>

				</ul>

		</div>



	</div>
	<!-- FIM TOPO -->




	<!-- LISTA USUÁRIOS TOPO -->
	<ul id="usuarios-topo">

		<li class="item-lista-usuarios">

			<img src="<?php echo base_url('./assets/img/icone-config.png'); ?>" class="imagem-usuario" />

			<p class="nome-usuario-lista"> Usuários </p><br class="clear" />
			<a href="<?php echo site_url('administradores/cadastrar'); ?>" class="botao botao-cadastrar botao-pequeno botao-inline"> Cadastrar </a>
			<a href="<?php echo site_url('administradores/listar'); ?>" class="botao botao-editar botao-pequeno botao-inline"> Listar </a>
		</li>

		<?php
			foreach( $this->dados_globais['administradores'] AS $admin ){
				$img = empty($admin->foto) ? 'avatar-padrao.png' : $admin->foto;
		?>

		<li class="item-lista-usuarios">

			<img src="<?php echo base_url('./assets/upload/administradores/'.$img); ?>" class="imagem-usuario" title="<?php echo $admin->nome; ?>" />

			<p class="nome-usuario-lista"> <?php echo $admin->nome; ?> </p><br class="clear" />
			<a href="<?php echo site_url("administradores/editar/$admin->id"); ?>" class="botao botao-editar centro botao-pequeno"> Editar </a>

		</li>
		<?php } ?>

	</ul>
	<!-- FIM LISTA USUÁRIOS TOPO -->




	<!-- CONFIGURAÇÕES TOPO -->
	<ul id="area-configuracoes">
		
		<li class="item-configuracao item-analytics" title="Configuração para gerenciar as estatísticas de acesso do site">
			<a href="<?php echo site_url('configuracoes/analytics'); ?>">
				<div>Google Analytics</div>
			</a>
		</li>

		<li class="item-configuracao item-config" title="Configurações gerais do site">
			<a href="<?php echo site_url('configuracoes/gerais'); ?>">
				<div>Gerais</div>
			</a>
		</li>

		<li class="item-configuracao item-contato" title="Informações de contato do site: e-mail, telefone, endereço, etc...">
			<a href="<?php echo site_url('configuracoes/contato'); ?>">
				<div>Informações de Contato</div>
			</a>
		</li>

	</ul>
	<!-- FIM CONFIGURAÇÕES TOPO -->



	<!-- MENU LATERAL -->
	<div id="barra-lateral">
		<ul id="menu-lateral">
			<li class="nome-gerenciador item-menu"> Gerenciador 4.0 BETA </li>


			<li class="item-menu subitem <?php if( $this->router->class == 'acontecimentos' ){ echo 'menu-ativo'; } ?>"> 
				<span>Acontecimento</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('acontecimentos/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('acontecimentos/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>
			<li class="item-menu subitem <?php if( $this->router->class == 'arquivos' ){ echo 'menu-ativo'; } ?>"> 
				<span>Arquivos</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('arquivos/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('arquivos/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>
			<li class="item-menu subitem <?php if( $this->router->class == 'banners' ){ echo 'menu-ativo'; } ?>"> 
				<span>Banners</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('banners/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('banners/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'categorias' ){ echo 'menu-ativo'; } ?>"> 
				<span>Categorias</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('categorias/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('categorias/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'cases' ){ echo 'menu-ativo'; } ?>"> 
				<span>Cases/Sistemas</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('cases/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('cases/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'clientes' ){ echo 'menu-ativo'; } ?>"> 
				<span>Clientes</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('clientes/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('clientes/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'depoimentos' ){ echo 'menu-ativo'; } ?>"> 
				<span>Depoimentos</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('depoimentos/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('depoimentos/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>


			<li class="item-menu subitem <?php if( $this->router->class == 'designs' ){ echo 'menu-ativo'; } ?>"> 
				<span>Design</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('designs/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('designs/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu <?php if( $this->router->class == 'empresas' ){ echo 'menu-ativo'; } ?>"> 
				<a href="<?php echo site_url('empresas'); ?>">
				<span>Empresa</span>
				</a>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'funcionalidades' ){ echo 'menu-ativo'; } ?>"> 
				<span>Funcionalidades</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('funcionalidades/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('funcionalidades/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'midias_sociais' ){ echo 'menu-ativo'; } ?>"> 
				<span>Mídias sociais</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('midias_sociais/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('midias_sociais/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'newsletters' ){ echo 'menu-ativo'; } ?>"> 
				<span>Newsletters</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('newsletters/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('newsletters/listar'); ?>"> Listar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('newsletters/historico'); ?>"> Histórico</a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('newsletters/emails'); ?>"> Listar emails</a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu subitem <?php if( $this->router->class == 'noticias' ){ echo 'menu-ativo'; } ?>"> 
				<span>Novidades</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('noticias/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('noticias/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<!--========================================-->
			<li class="item-menu subitem <?php if( $this->router->class == 'popups' ){ echo 'menu-ativo'; } ?>"> 
				<span>Pop-up</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('popups/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('popups/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<!--========================================-->
			<li class="item-menu subitem <?php if( $this->router->class == 'portfolios' ){ echo 'menu-ativo'; } ?>"> 
				<span>Portfólios</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('portfolios/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('portfolios/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>
			
			<li class="item-menu subitem <?php if( $this->router->class == 'servicos' ){ echo 'menu-ativo'; } ?>"> 
				<span>Serviços</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('servicos/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('servicos/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<!--========================================-->
			<?php $textos = array('textos_home','textos_contatos','textos_orcamentos','textos_trabalhe_conosco','textos_depoimentos','textos_novidades','textos_portfolios','textos_midias_sociais','textos_cases','textos_designs'); ?>
			<li class="item-menu subitem <?php if( in_array($this->router->class, $textos)){ echo 'menu-ativo'; } ?>"> 
				<span>Textos e conteúdos</span>
				<!--========================================-->
				<ul class="submenu subitem nivel1">
					<li class="item-menu "><div class="subitem2"> <b>Home</b> </div>
						<ul class="submenu nivel2" style="display: none;">
							<li class="item-menu"> <a href="<?php echo site_url('textos_home/depoimentos'); ?>"> Depoimentos </a> </li>
							<li class="item-menu"> <a href="<?php echo site_url('textos_home/novidades'); ?>"> Novidades </a> </li>
							<li class="item-menu"> <a href="<?php echo site_url('textos_home/portfolio'); ?>"> Portfolio - Parallax </a> </li>
							<li class="item-menu"> <a href="<?php echo site_url('textos_home/previa_portfolio'); ?>"> Prévia do Portfolio </a> </li>
							<li class="item-menu"> <a href="<?php echo site_url('textos_home/servicos'); ?>"> Serviços </a> </li>
						</ul>
					</li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_cases'); ?>"> Cases (Sistemas) </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_contatos'); ?>"> Contatos </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_designs'); ?>"> Designs </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_depoimentos'); ?>"> Depoimentos </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_midias_sociais'); ?>"> Mídias sociais </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_novidades'); ?>"> Novidades </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_orcamentos'); ?>"> Orçamentos </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_portfolios'); ?>"> Portfólios </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('textos_trabalhe_conosco'); ?>"> Trabalhe conosco </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<!--========================================-->
			<li class="item-menu subitem <?php if( $this->router->class == 'videos' ){ echo 'menu-ativo'; } ?>"> 
				<span>Vídeos</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('videos/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('videos/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>


			<?php /*
			<li class="item-menu subitem <?php if( $this->router->class == 'banners' ){ echo 'menu-ativo'; } ?>"> 
				<span>Banner</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('banners/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('banners/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>


			<li class="item-menu subitem <?php if( $this->router->class == 'conteudos_home' ){ echo 'menu-ativo'; } ?>"> 
				<span>Conteúdo da home</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('conteudos_home/editar_espaco'); ?>"> Área de espaço da empresa </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('conteudos_home/editar_servico_beleza'); ?>"> Área de serviços de beleza </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('conteudos_home/editar_servico_estetica'); ?>"> Área de serviços de estética </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('conteudos_home/editar_area_link'); ?>"> Área com link </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('conteudos_home/editar_novidade'); ?>"> Área de novidades</a> </li>
				</ul>
				<!--========================================-->
			</li>
			<!--========================================
			
			<li class="item-menu subitem <?php if( $this->router->class == 'destaques' ){ echo 'menu-ativo'; } ?>"> 
				<span>Destaques</span>
				<!--========================================
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('destaques/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('destaques/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================
			</li>
			<!--========================================-->
			<li class="item-menu subitem <?php if( $this->router->class == 'destinatarios' ){ echo 'menu-ativo'; } ?>"> 
				<span>Destinatários</span>
				========================================
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('destinatarios/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('destinatarios/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu <?php if( $this->router->class == 'empresas' ){ echo 'menu-ativo'; } ?>"> <a href="<?php echo site_url('empresas/editar'); ?>"> Sobre a empresa </a> </li>
			

			
			<li class="item-menu subitem <?php if( $this->router->class == 'noticias' ){ echo 'menu-ativo'; } ?>"> 
				<span>Notícias</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('noticias/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('noticias/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>
			
			
			
			
			<li class="item-menu subitem <?php if( $this->router->class == 'servicos' ){ echo 'menu-ativo'; } ?>"> 
				<span>Serviços</span>
				<!--========================================-->
				<ul class="submenu nivel1">
					<li class="item-menu"> <a href="<?php echo site_url('servicos/cadastrar'); ?>"> Cadastrar </a> </li>
					<li class="item-menu"> <a href="<?php echo site_url('servicos/listar'); ?>"> Listar </a> </li>
				</ul>
				<!--========================================-->
			</li>

			<li class="item-menu <?php if( $this->router->class == 'empresas' ){ echo 'menu-ativo'; } ?>"> <a href="<?php echo site_url('empresas/editar'); ?>"> Vale presente </a> </li> */?>

		
		</ul>
	</div>
	<!-- FIM MENU LATERAL -->

	<!-- CAMINHO DE PÃO -->
	<ul id="caminho-pao">
		<li class="home"> </li>

		<li> <a href="<?php echo site_url(); ?>"> Home </a> </li>

		<?php if( $this->router->class != 'home' ){ ?>
			<li class="separador"></li>
			<li> <a href="<?php echo site_url($this->router->class); ?>"> <?php echo ucfirst(str_replace('_', ' ',  $this->router->class)); ?> </a> </li>
		<?php } ?>

		<?php if( $this->router->method != 'index' && $this->router->method != 'editar' && $this->router->method != 'excluir'  ){ ?>
			<li class="separador"></li>
			<li> <a href="<?php echo site_url($this->router->class.'/'.$this->router->method); ?>"> <?php echo ucfirst(str_replace('_', ' ',  $this->router->method)); ?> </a> </li>
		<?php } ?>

	</ul>
	<!-- FIM CAMINHO DE PÃO -->



	<!-- AREA AVISOS -->
	<?php
		if( $this->session->flashdata('mensagem') ){
			$tipo 	  = $this->session->flashdata('tipo');
			$mensagem = $this->session->flashdata('mensagem');
	?>

		<div id="aviso" class="aviso-<?php echo $tipo; ?>">  <div></div> <?php echo $mensagem; ?> </div>

	<?php } ?>
	<!-- FIM AREA AVISOS -->
		

	<!-- CONTEUDO -->
	<div id="conteudo">