	
	<h3 class="legenda"> Lista de clientes</h3>

		<div class="col-md-12">
			<p>Há <?php echo $total;?> cadastrados</p>

		<div class="padding">

			<!-- BUSCA -->
			<form name="form-gerenciador" id="form-gerenciador" method="get" autocomplete="off" action="<?php echo site_url($this->router->class."/listar"); ?>">

				<div class="form-group">
					<div class="col-xl-2 pull-left">
					<label for="q" class="label-form"> Nome/e-mail </label>
				</div>
				<div class="col-xl-4 pull-left">
					<input type="text" name="q" id="q" class="form-control" <?php if( $this->input->get("q") ){ ?> value="<?php echo $this->input->get("q"); ?>" <?php } ?> />
				</div>
				<div class=" pull-left">
					<a href="<?php echo site_url($this->router->class."/listar"); ?>" class="btn btn-default pull-right" style='margin-left: 15px'> Limpar </a>
					<input type="submit" value="Buscar" class="btn btn-success pull-left	" />
				</div>
			</div>
			<br class="clear" />
			<br class="clear" />

			</form>
			<!-- FIM BUSCA -->


			<table class="col-12 table table-bordered">
			    <thead>
			        <tr>
			            <th></th>
			            <th>Nome</th>
			            <th>E-mail</th>
			        </tr>
			    </thead>

			    <tbody>

			    	<?php foreach( $clientes AS $objeto ){ ?>
			    	
				        <tr>
				            <td class="area-acao"> 
				            	<a href="<?php echo site_url($this->router->class."/editar/$objeto->id"); ?>" title="Editar" class="pull-left btn btn-default">Editar</a>
				            	
				            </td>
				            <td><?php echo $objeto->nome.' '. $objeto->sobrenome; ?></u></td>
				            <td><?php echo $objeto->email; ?></td>
				        </tr>

			        <?php } ?>

			    </tbody>
			</table>

			<br class="clear" />

			<div id="paginacao">
				<?php
					echo $this->pagination->create_links();
				?>
			</div>
			
			<br class="clear" />

			<!-- <a href="<?php //echo site_url($this->router->class."/cadastrar"); ?>" class="botao botao-cadastrar float-left"> Cadastrar </a> -->


		</div>
	</div>