
function confirmacao(){

	return confirm('Você tem certeza?');

}

function categorias_departamento(url){
	var departamento = $('#departamento_id').val();

	console.log(departamento);
	if (departamento > 0) {

		// mostrar as categorias
		$('#div-categorias').show('slow');
		$('#categoria_id').load(url+'/anuncios/categorias_departamento?dep='+departamento);
		var caminho = $('#modal_cadastro_categoria').attr('href');

		caminho_limpo = caminho.split("?");
		caminho = caminho_limpo[0];
		$('#modal_cadastro_categoria').attr('href',caminho+'?dep='+departamento);

	}else{
		alert('Por favor selecione um departamento');

	}

}

function cadastrar_categoria (url){

	var departamento = $('#departamento_selecionado').val();
	var categoria = $('#nome_categoria').val();

	$.ajax({
	 	url: url+'/anuncios/cadastrar_categoria_departamento?dep='+departamento+'&cat='+categoria,
	 	success: function(result){
	 		//id
	 		var id = result;
	 		id = parseInt(id);

	 		//recaregar a categoria
	 		$('#categoria_id').load(url+'/anuncios/categorias_departamento?dep='+departamento);

			var caminho = $('#modal_cadastro_subcategoria').attr('href');
			caminho_limpo = caminho.split("?");
			caminho = caminho_limpo[0];
			$('#modal_cadastro_subcategoria').attr('href',caminho+'?cat='+id);

			$.fancybox.close();

			setTimeout(function(){
				$('#categoria_id').val(id);
			}, 1000);


			//busca as subcategorias da categoria
			$('#subcategoria_id').load(url+'/anuncios/subcategorias_categoria?cat='+id);
			$('#div-subcategorias').show('slow');



	    }
	});

}

function subcategorias_categoria(url){
	var categoria = $('#categoria_id').val();

	//console.log(departamento);
	if (categoria > 0) {

		var caminho = $('#modal_cadastro_subcategoria').attr('href');
		caminho_limpo = caminho.split("?");
		caminho = caminho_limpo[0];
		$('#modal_cadastro_subcategoria').attr('href',caminho+'?cat='+categoria);

		// mostrar as categorias
		$('#div-subcategorias').show('slow');
		$('#subcategoria_id').load(url+'/anuncios/subcategorias_categoria?cat='+categoria);
	
	}else{
		alert('Por favor selecione uma categoria');

	}

}

function cadastrar_subcategoria (url){

	var categoria = $('#categoria_selecionada').val();
	var subcategoria = $('#nome_subcategoria').val();

	$.ajax({
	 	url: url+'/anuncios/cadastrar_subcategoria_categoria?cat='+categoria+'&sub='+subcategoria,
	 	success: function(result){
	 		//id
	 		var id = result;
	 		id = parseInt(id);

	 		$('#subcategoria_id').load(url+'/anuncios/subcategorias_categoria?cat='+categoria);

	 		console.log(id);

			$.fancybox.close();

			setTimeout(function(){
				$('#subcategoria_id').val(id);
			}, 1000);

	    }
	});

}

function seleciona_promocao(value){
	if ($('#promocao').is(":checked")) {
		$('#mostrar_valor_promocao').show('slow');
	}else{
		$('#mostrar_valor_promocao').hide('slow');
	}
}


function cadastrar_editora (url){

	var editora = $('#nome_editora').val();

	$.ajax({
	 	url: url+'/anuncios/cadastrar_editora?edi='+editora,
	 	success: function(result){
	 		//id
	 		var id = result;
	 		id = parseInt(id);

	 		//recaregar a categoria
	 		$('#editora_id').load(url+'/anuncios/editoras');

			$.fancybox.close();

			setTimeout(function(){
				$('#editora_id').val(id);
			}, 1000);



	    }
	});

}


function excluir_foto(url,id,coluna) {


	var txt;
	var r = confirm("Deseja realmente excluir a foto?");
	if (r == true) {
	    $.ajax({
	 	url: url+'anuncios/excluirImg?id='+id+'&img='+coluna,
	 	success: function(result){
	 		$('#excluir-'+coluna).css('display','none');
	 		$('#imagem-'+coluna).css('display','none');
	 	}
	 	});
	 	
	} else {
	    txt = "Exclusão cancelada!";
	}

       
}


function botao_embalagem(url,pedido){

	 $.ajax({
	 	url: url+'pedidos/embalagem?id='+pedido,
	 	success: function(result){
	 		var retorno = result;

	 		if (retorno==0) {
	 			$('#botao-embalagem-'+pedido).removeClass('btn-success').addClass('btn-warning');
	 		}

	 		if (retorno==1) {
	 			$('#botao-embalagem-'+pedido).removeClass('btn-warning').addClass('btn-success');
	 		}
	 		
	 	}
	 	});

}

function botao_enviar_aguardando_pag(url,pedido){

	 $.ajax({
	 	url: url+'pedidos/aviso_aguard_pag?id='+pedido,
	 	success: function(result){
	 		var retorno = result;

	 		if (retorno==0) {
	 			$('#botao-aviso-pag-'+pedido).removeClass('btn-success').addClass('btn-default');
	 		}

	 		if (retorno==1) {
	 			$('#botao-aviso-pag-'+pedido).removeClass('btn-default').addClass('btn-success');
	 		}
	 		
	 	}
	 	});

}


