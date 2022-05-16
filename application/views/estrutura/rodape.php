</div>
<footer>
	<div class="msg">
		<center>
			 <h2>Seja bem-vinda!</h2><br>
			 <p>
				Fique à vontade, pegue seu bloquinho de notas e sua caneta! Esse é o Devas Conectadas, ou seu comecinho (rs)!<br>
			    Ele é pensado com todo carinho, 
				para você <b>Deva.</b><br>
				Você quer saber mais sobre tecnologia? 
				Quer me contar a sua <b>experiência?</b> 
				Ou quem sabe <b>trocar ideias?</b> 
				<br> Me encontre pelo <a href="https://www.linkedin.com/in/fernanda-ayres-silveira/">Linkedin</a></p>
		</center>
		
	</div>
	<div class="line">@Todos direitos reservados | <?php echo date('Y'); ?></div>
</footer>
  
</body>
    <!-- Bootstrap core JavaScript-->
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/script.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/popper.min.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/bootstrap.min.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/jquery.easing.min.js'); ?>"></script>
     <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/mascaras.js'); ?>"></script>
      <script type="text/javascript" language="javascript" src="<?php echo base_url('./assets/js/fancybox.js'); ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){
	$('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
		$(this).toggleClass('open');

		//aqui verificar se está aberto para mostrar então o menu mobile
		if ($(this).hasClass( "open" )) {
			$('#menu-mobile').show("slow");
		}else{
			$('#menu-mobile').hide("slow");
		}
	});
});
</script>
</html>
