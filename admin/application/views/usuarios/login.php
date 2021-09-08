<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Login - Ponto do Gibi</title>
	<link rel="shortcut icon" href="<?php echo base_url('./assets/img/favicon.ico'); ?>" />
	<!-- META TAGS -->
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- CSS -->
		<!-- META TAGS -->
	<?php 
		echo link_tag('./assets/css/bootstrap.css');
		echo link_tag('./assets/css/sb-admin.css');
		?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/bootstrap.js'); ?>"></script>
	
</head>
<body onload="javascript: document.getElementById('email').focus();">

	


	<body class="bg-dark">
  <div class="container">
  <?php

   if($this->session->flashdata('mensagem') != ""){ ?>
			<div class="alert alert-warning" role="alert">Login não encontrado!</div>
	<?php }?>
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form  method="post" action="<?php echo site_url('usuarios/login');?>">
          <div class="form-group">
            <label for="exampleInputEmail1">Email </label>
            <input class="form-control" id="exampleInputEmail1" type="email" name="email" placeholder="E-mail">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Senha</label>
            <input class="form-control" id="exampleInputPassword1" type="password" name="senha" placeholder="Senha">
          </div>
          <input type="submit"  value="Login" class="btn btn-primary btn-block">
         
        </form>
       
      </div>
    </div>
  </div>




</body>
</html>