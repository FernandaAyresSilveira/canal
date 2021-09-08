<div class="area-padrao azul">
	<h1 class="legenda"> Lista de usuários </h1>

	<div class="padding">

		<table class="table table-bordered">
		    <thead>
		        <tr>
		            <th style="width:5%"></th>
		            <th>Nome</th>
		            <th>Email</th>
		        </tr>
		    </thead>

		    <tbody>

		    	<?php 
		    		foreach( $this->dados_globais['usuarios'] AS $admin ){
		    			
		    	?>
		    	
		        <tr>
		            <td> 
		            	<a href="<?php echo site_url("usuarios/editar/$admin->id"); ?>" title="Editar" class="btn btn-xs btn-primary">
		            		<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		            		Editar</a>
		            </td>
		            <td><?php echo $admin->nome; ?></td>
		            <td><?php echo $admin->email; ?></td>
		           
		        </tr>

		        <?php } ?>

		    </tbody>
		</table>

		<br class="clear" />

		<a href="<?php echo site_url('usuarios/cadastrar'); ?>" class="btn btn-info btn-xs pull-right"> Cadastrar </a>


	</div>
</div>