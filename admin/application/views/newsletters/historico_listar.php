

	<div class="area-padrao azul">
		<h1 class="legenda"> Lista de newsletters enviadas </h1>

		<div class="padding">

			<table class="pure-table tamanho-100">
			    <thead>
			        <tr>
			            <th>Assunto</th>
			            <th>Tipo</th>
			            <th>Enviados/Total</th>
			            <th>Data</th>
			        </tr>
			    </thead>

			    <tbody>
			    <?php for($i=0, $size = sizeof($newsletters[0]); $i<$size; $i++) {
			    		if ($newsletters[0][$i]->tipo == 1)
		    				$tipo = 'Imagem';
		    			elseif($newsletters[0][$i]->tipo == 2)
		    				$tipo = 'HTML';
		    			elseif($newsletters[0][$i]->tipo == 3)
		    				$tipo = 'Produtos';
		    			else
		    				$tipo = 'N/D';
			    ?>

			    	<tr>
			            <td><?php echo $newsletters[0][$i]->assunto; ?></td>
			            <td><?php echo $tipo; ?></td>
			            <td><?php echo $newsletters[0][$i]->news_env." / ".$newsletters[1][$i]->news_total; ?></td>
			            <td><?php echo converter_data($newsletters[0][$i]->data); ?></td>
			        </tr>

				<?php }?>
				
			    </tbody>
			</table>

			<br class="clear" />


			<a href="<?php echo site_url('newsletters/cadastrar'); ?>" class="botao botao-cadastrar botao-inline float-left"> Cadastrar </a>
			<br class="clear" />

			<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>
			<br class="clear">

		</div>
	</div>