
<fieldset class="area-padrao verde tamanho-100 centro">
	
	<legend class="legenda"> Prévia da Newsletter </legend>
	<div class="padding">

		<?php 
			if($newsletter->tipo == 1 ) {
				
				$url = site_url();
				$url = str_replace('/admin', '', $url);
				$link = $newsletter->link_imagem;
				$assunto = $newsletter->assunto;
				$imagem = base_url("assets/upload/newsletters/$newsletter->imagem");

				$c = $this->dados_globais['configuracao'];
				$titulo = $c->titulo;

				$cancelar = site_url("newsletters/unsubscribe");
				$cancelar = str_replace('/admin', '', $cancelar);
				echo  "<html>
						    <head>
						    	<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />
   						   		<title>$assunto - $titulo</title>
						    </head>
						    <body>
							    <font face=\"Arial\" size=\"2\" color=\"#333333\">
							    <br />
								    <center>
								    	<a href=\"$url\"><b>$titulo</b></a><br /><br />
								    	<b>$assunto</b><br /><br />
								    	<a href=\"$link\" target=\"_blank\">
								   			<img src=\"$imagem\" style='max-width:600px;' />
								   		</a>
								   		<br/><br/>
								    	Caso a imagem não tenha sido carregada, <a href=\"$imagem\" target=\"blank\"><u>clique aqui.</u></a>
								   		<br><br>
								   		Caso não queira mais receber nossos e-mails, <a href=\"$cancelar\" target=\"blank\"><u>clique aqui.</u></a>
								   		<font face=\"Arial\" size=\"1\" color=\"#333333\">
								   		</font>
								    </center>
							    </font>
						    </body>
					    </html>";
			} 
			elseif($newsletter->tipo == 2) {
				
				echo $newsletter->html;

			} 
			elseif($newsletter->tipo == 3) {

				echo $this->dados_globais['configuracao']->topo_email;
				echo "<br style=\"clear:both;\" />";
				echo "<br style=\"clear:both;\" />";
				echo "<div style=\"width:600px;height:auto;min-height:200px;\">";
				
				foreach($newsletters_produtos as $np) {

					$f = new Foto();
					$f->where("produto_id", $np->produto_id);
					$f->where("capa", 1)->get();
					$url = site_url("produtos/detalhe/$np->produto_amigavel/$np->produto_id");
					$url = str_replace('/admin', '', $url);
					?>

					<div style="width:190px;height:300px;float:left;border:solid 1px #EAEAEA;margin:4px;overflow:hidden;">
						<br style="clear:both;" />
						<a href="<?php echo $url; ?>" target="blank">
							<b><?php echo $np->produto_nome; ?></b><br><br>
							<img width="160" height="160" src="<?php echo base_url("assets/upload/produtos/$np->produto_id/$f->nome") ?>">
						</a>
						<br style="clear:both;" />
						<br style="clear:both;" />
						<b>
							<?php 
								if($np->produto_promocao) {
									echo "<strike>";
									echo 'De: R$ '. mostrar_valor($np->produto_valor).'<br>';
									echo "</strike>";
									echo "<span style=\"font-size:16px;\">";
									echo 'Por: R$ '. mostrar_valor($np->produto_promocao);
									echo "</span>";
								}
								else {
									echo 'R$'.mostrar_valor($np->produto_valor);
								}
							?>
						</b>
						<br style="clear:both;" />
						<br style="clear:both;" />
						<a href="<?php echo $url; ?>" target="blank" style="font-size:16px;color:red"><b>Compre agora</b></a>
					</div>

				<?php }

				echo "</div>";
				echo "<br style=\"clear:both;\" />";
				echo $this->dados_globais['configuracao']->rodape_email;				
			}
			else
				echo "nan";
		?>
	</div>
	<br class="clear">

	<a href="<?php echo site_url('newsletters/destinatarios/'.$this->uri->segment(3)); ?>" class="botao botao-cadastrar botao-inline float-right"> Avançar </a>
	<a href="<?php echo site_url('newsletters/editar/'.$this->uri->segment(3)); ?>" class="botao botao-editar botao-inline float-right"> Voltar </a>
</fieldset>
