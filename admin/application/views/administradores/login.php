<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Painel Login - Ponto do Gibi</title>
	<link rel="shortcut icon" href="<?php echo base_url('./assets/img/favicon.ico'); ?>" />
	<!-- META TAGS -->
	<?php 
		echo link_tag('./assets/css/bootstrap.css');
		echo link_tag('./assets/css/sb-admin.css');
		?>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/bootstrap.js'); ?>"></script>

	
</head>
<body onload="javascript: document.getElementById('email').focus();">

	<?php if($this->session->flashdata('mensagem') != ""){ ?>
			<div id="alerta-erro"> Login não encontrado! </div>
	<?php }?>

	<?php 
		$url = $this->session->flashdata('redirecionar') ? $this->session->flashdata('redirecionar') : site_url();
	?>

	<!-- <form name="form-login" id="form-login" method="post" action="<?php echo base_url('Administradores/login');?>">
		<fieldset id="login">
			<legend> Login </legend>


			<label for="email" class="label-login"> E-mail </label>
			<br class="clear" />
			<input type="text" name="email" id="email" class="input-login validate[required, custom[email]]" />
			<br class="clear" />

			<label for="senha" class="label-login"> Senha </label>
			<br class="clear" />
			<input type="password" name="senha" id="senha" class="input-login validate[required]" />
			<br class="clear" />

			<input type="submit" value="Enviar" class="botao-login" />

		</fieldset>
	</form>
 -->
	<body class="bg-dark">
  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input class="form-control" id="exampleInputEmail1" type="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input class="form-control" id="exampleInputPassword1" type="password" placeholder="Password">
          </div>
          <div class="form-group">
            <div class="form-check">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox"> Remember Password</label>
            </div>
          </div>
          <a class="btn btn-primary btn-block" href="index.html">Login</a>
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="register.html">Register an Account</a>
          <a class="d-block small" href="forgot-password.html">Forgot Password?</a>
        </div>
      </div>
    </div>
  </div>




</body>
</html>