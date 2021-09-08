<script type="text/javascript">
	$(function () {
	    $('.checkall').on('click', function () {
	        $(this).closest('fieldset').find(':checkbox').prop('checked', this.checked);
	    });
	});
</script>

	<div class="area-padrao azul">
		<h1 class="legenda"> Lista de destinatários </h1>

		<div class="padding">

			<form name="formdest" id="formdest" method="post" autocomplete="off" action="<?php echo site_url('newsletters/funcao_cadastrar_destinatarios/'.$this->uri->segment(3)); ?>">

					<table class="pure-table tamanho-100">
						    <thead>
						        <tr>
						            <th class="texto-centro">
						            	<input type="checkbox" id="todos" name="todos" value="todos" class="checkall" value="1"/>
						            </th>
						            <!-- <th>Nome</th> -->
						            <th>E-mail</th>
						        </tr>
						    </thead>

							    <tbody>

							    	<?php 
							    		foreach( $pessoas AS $p ){
							    	?>
							    	
							        <tr>
							            <td class="area-acao texto-centro"> 
							            	<input type="checkbox" name="dest[]" value="<?php echo $p->id; ?>">
							            </td>
							            <!-- <td><?php //echo $p->nome; ?></td> -->
							            <td><?php echo $p->email; ?></td>
							        </tr>

							        <?php } ?>
							    </tbody>
					</table>
					<br class="clear">
				<input type="submit" value="Finalizar" class="botao botao-cadastrar botao-inline float-right" />
			</form>

			<br class="clear" />
		</div>
	</div>
 <script>  
 $(function () {  
   $('.checkall').on('click', function () {  
     $(this).closest('table').find(':checkbox').prop('checked', this.checked);  
   });  
 });  
 </script> 