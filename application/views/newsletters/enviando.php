	<style>
		#status, #statuss {
			text-align: center;
			font: normal 12px 'Verdana';
			width: 100%;
			line-height: 24px;
		}
	</style>

	<script type="text/javascript">

		function enviar(total,tempo,id){

			document.getElementById('status').innerHTML=' Enviando. Não feche essa janela, isso pode levar algumas horas, dependendo do número de destinatários.';
			alert('Aguarde, ignore os avisos do seu navegador');

			/* É o maximo de envios q serão feitos por bloco de email, após pára pelo tempo determinado no segundo parâmetro da funcao enviar no onload */
			var y = 250;

			/* numero de blocos de envio com y emails em cada um deles, essa funcao arrendonda o numero para cima */
			var blocos = Math.ceil(total/y); 

			/* for com seu limite no numero total de blocos de envio. chama a funcao enviar e dá o tempo determinado entre o envio de cada bloco */
			for (var b=1; b <= blocos; b++) {
				funcao_enviar(y,id);
				if (b < blocos) {
					sleep(tempo);
				}
			}



			//após finalizado o envio, verifica quantos status estão =1 para saber quantos foram enviados com sucesso.
			var url2 = "<?php echo site_url('newsletters/busca_enviados_newsletter'); ?>";
			var queryString = url2 + '?id=' + id;
			$.ajax({ type: "GET",   
				url: queryString,
				async: false,
				success : function(text) {
					resultado = text;
					var total_sucesso = resultado;
					document.getElementById('status').innerHTML =  resultado +'/'+ total + ' e-mails enviados com sucesso!';
				}
			});





			
		}

		function funcao_enviar(y,id){	
			/* função ajax que chama uma função no php que realiza o envio dos emails */
			var url2 = "<?php echo site_url('newsletters/enviar'); ?>";
			var queryString = url2 + '?id=' + id + '&y=' + y;

			$.ajax({ 
				type: "GET",   
		        url: queryString,   
		        async: false
		        // complete: function() {
		        // 	$("#loader").css("display", "none");
		        // }
			});
		}

		function sleep(milliseconds) {
		 	var start = new Date().getTime();
		  	for (var i = 1; i > 0; i++) {
				if ((new Date().getTime() - start) > milliseconds){
					break;
				}
		    }
		}
	</script>

<!-- primeiro parâmetro é o total de e-mails que foram selecionados para envio -->
<!-- segundo parâmetro é o tempo entre cada bloco de envio, em milisegundos -->
<!-- terceiro parâmetro é o ID da newsletter, que está na URL atual -->
<!-- 1h = 3600000 ms -->
<body onload="enviar('<?php echo $total; ?>','3600000','<?php echo $this->uri->segment(3); ?>')"> 

	<p id="status"></p>
	<!-- <img src="<?php //echo base_url('assets/img/loading.gif'); ?>" id="loader"> -->

</body>
