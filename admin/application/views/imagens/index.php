<html>
<head>
	<title>Painel Hostche 4.0 BETA</title>
	<link rel="shortcut icon" href="<?php echo base_url('./assets/img/favicon.ico'); ?>" />
	<!-- META TAGS -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- CSS -->
	<?php 
		echo link_tag('./assets/multiupload/css/style.css');
    ?>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
	<form id="upload" method="post" action="<?php echo base_url('imagens/funcao_upload'); ?>" enctype="multipart/form-data">
		<div id="drop">
			Arraste e solte as imagens aqui
			<a>Buscar</a>
			<input type="file" name="imagem" multiple />
			<input type="hidden" name="tipo" value="<?php echo $tipoImagem;?>">
			<input type="hidden" name="idTipo" value="<?php echo $idTipoImagem;?>">
		</div>

		<ul>
			<!-- The file uploads will be shown here -->
		</ul>
	</form>
	<h1>Imagens</h1>
	<div id="images-conteiner">
		<?php foreach($imagens as $imagem){
			$url = base_url_upload($imagem->tipo."/".$imagem->nome);
			list($width, $height, $type, $attr) = getimagesize($url);
			$size = ($width > $height) ? "height": "width";
		?>

			<div class="box-imagem">
				<div class="imagem-<?php echo $size;?>">
					<img src="<?php echo $url;?>" />
					<a data-id="<?php echo $imagem->id;?>" class="excluir-img">X</a>
				</div>
				<p><small><?php echo $imagem->nome;?></small><p>
				<div class="box-legenda">
					<input type="text" class="legenda-imagem" data-id="<?php echo $imagem->id;?>" value="<?php echo $imagem->titulo;?>" />
					<img src="<?php echo base_url('./assets/img/throbber.gif'); ?>" width="20">
				</div>
			</div>

		<?php }?>
	</div>
	
	<!-- JavaScript Includes -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="<?php echo base_url('assets/multiupload/js/jquery.knob.js'); ?>"></script>

		<!-- jQuery File Upload Dependencies -->
		<script src="<?php echo base_url('assets/multiupload/js/jquery.ui.widget.js'); ?>"></script>
		<script src="<?php echo base_url('assets/multiupload/js/jquery.iframe-transport.js'); ?>"></script>
		<script src="<?php echo base_url('assets/multiupload/js/jquery.fileupload.js'); ?>"></script>
		
		<!-- Our main JS file -->
		<?php //Seta o caminho base no javascript, usado para manipulação da pasta de imagens ?>
		<script>baseUrl = "<?php echo base_url();?>"</script>

		<script src="<?php echo base_url('assets/multiupload/js/script.js'); ?>"></script>
</body>
</html>