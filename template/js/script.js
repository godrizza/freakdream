$(document).ready(function(){
	'use strict';

	//fechar todos os caixa
 	$('.chat_aviso').hide();
	$('.chat_aberto').hide();
	$('.amigo_sub').hide();
	$('.amigo_sub_configuracao').hide();
	$('.notificacao_sub').hide();
	$('.chat_sub').hide();
	$('.painel').hide();
	$('.configuracao_sub').hide();
	$('.busca_pesquisa').hide();
	$('.uplode_foto').hide();
	$('.escurecer').hide();
	$('.box_conteudo_opcao').hide();
	$('.aviso_geral').hide();


		//fechar todas as caixa ao click fora
		$('.corpo').click(function(event){
			event.preventDefault();
						
			 	$('.chat_aviso').hide();
				$('.chat_aberto').hide();
				$('.amigo_sub').hide();
				$('.amigo_sub_configuracao').hide();
				$('.notificacao_sub').hide();
				$('.chat_sub').hide();
				$('.painel').hide();
				$('.configuracao_sub').hide();
			
 		});

		// abrir chat no menu
		$('.usuario_online').click(function(event){
			event.preventDefault();
			
				$(".chat_aberto").show();
				$(".chat_aviso").hide();
			
 		});

		//chat lateral
		$('.chat_topo_icon').click(function(event){
			event.preventDefault();
			
 			$(".chat_aberto").hide();
			$(".chat_aviso").show();
			
 		});
		
		$('.chat_aviso_icon').click(function(event){
			event.preventDefault();
			
			$(".chat_aviso").hide();
			$(".chat_aberto").show();
		});
	
		$('.chat_topo_fechar').click(function(event){
			event.preventDefault();
			
			$(".chat_aberto").hide();
			$(".chat_aviso").hide();
		});
	
		//amigo
		$('.amigo').click(function(event){
			event.preventDefault();
			
			$('.amigo_sub').toggle();
			$('.notificacao_sub').hide();
			$('.chat_sub').hide();
		});
		
		$('.close_amizade').click(function(event){
			event.preventDefault();

			$(".amigo_sub").hide();
			$(".amigo_sub_configuracao").hide();
		});
		
		$('.configuracao_amizade').click(function(event){
			event.preventDefault();			
			$(".amigo_sub_configuracao").toggle();
		});

		//notificacao
		$('.notificacao').click(function(event){
			event.preventDefault();
			$('.notificacao_sub').toggle();
			$('.amigo_sub').hide();
			$('.amigo_sub_configuracao').hide();
			$('.chat_sub').hide();
		});

		$('.close_notificao').click(function(event){
			event.preventDefault();
			$('.notificacao_sub').hide();
		});

		//chat_sub
		$('.chat').click(function(event){
			event.preventDefault();
			$('.chat_sub').toggle();
			$('.notificacao_sub').hide();
			$('.amigo_sub').hide();
			$('.amigo_sub_configuracao').hide();
		});

		$('.close_chat').click(function(event){
			event.preventDefault();
			$('.chat_sub').hide();
		});

		//Painel
		$('.aviso').click(function(event){
			event.preventDefault();
			$('.painel').toggle();
			$('.configuracao_sub').hide();
		});

		$('.close_painel').click(function(event){
			event.preventDefault();
			$('.painel').hide();
		});

		//botao negado
		$('.negado').click(function(event){
			event.preventDefault();
			$('.escurecer').hide();
			$('.aviso_geral').hide();
			$('.box_conteudo_opcao').hide();
		});

		//configuracao
		$('.configuracao').click(function(event){
			event.preventDefault();
			$('.configuracao_sub').toggle();
			$('.painel').hide();
		});
		$('.close_configuracao').click(function(event){
			event.preventDefault();
			$('.configuracao_sub').hide();
		});

		//abrir uplode foto
		$('.camera').click(function(event){
			event.preventDefault();
			$('.escurecer').show();
			$('.uplode_foto').show();
		});

		//fecha foto
		$('.close_foto').click(function(event){
			event.preventDefault();
			$('.escurecer').hide();
			$('.uplode_foto').hide();
		});
		
		//formulario de enviar dados
		$(".textarea_post").keyup(function(e) {
    		$(this).height(50);
    		$(this).height(this.scrollHeight + parseFloat($(this).css("borderTopWidth")) + parseFloat($(this).css("borderBottomWidth")));
		});
		$('.textarea_post').on('mouseleave', function(){
    		$(this).height(10);
		});

		//fechar menu lateral
		$('.inicial').click(function(event){
			event.preventDefault();

			$(".menu").toggle();

			if($(".corpo").css("marginLeft") === '150px'){

				$('.corpo').css({margin: "65px 0 10px 7%" });

			}else{

				$('.corpo').css({margin: "65px 0 10px 150px" });
			}
			
		});
 });
//postagem cofiguração
function conf_opcao(id_conf){
	$('#conf_'+id_conf+'_id').toggle();
}

function aviso(id_aviso){
		$('.escurecer').show();
		$('.aviso_geral').show();
		$(".aviso_geral2").html("<a href='javascript:deletar_post("+id_aviso+");' class='aceito'>Excluir</a> ");
}

//postagem de compartilhamento de texto
function postagem(post_id){
	alert("a id e"+post_id);
	document.querySelector("[name='id_post_respostagem']").value = post_id;
	document.compartilhar_texto.submit();
}

//enviar formulario para ser deletado
function deletar_post(id_aviso){ 
	document.querySelector("[name='aviso_post_form_id']").value = id_aviso;
   	document.deletar_post.submit();
} 

//buscar 
	var req;

	function buscar(valor) {
	     $('.busca_pesquisa').show();
	     $('.painel').hide();
	     $('.configuracao_sub').hide();

	if(window.XMLHttpRequest) {
	   req = new XMLHttpRequest();
	}
	else if(window.ActiveXObject) {
	   req = new ActiveXObject("Microsoft.XMLHTTP");
	}

	var url = "../../class/pesquisar.php?valor="+valor;

	req.open("Get", url, true); 

	req.onreadystatechange = function() {
	 
	    if(req.readyState == 1) {
	        document.getElementById('busca_pesquisa').innerHTML = '<h1>Buscando Usuario ...</h1>';
	    }

	    if(req.readyState == 4 && req.status == 200) {
	 
	    var resposta = req.responseText;

	    if(resposta == false){

	        $('.busca_pesquisa').hide();
	            
	    }else{
	    document.getElementById('busca_pesquisa').innerHTML = resposta;
	    } 

	    }

	}
	req.send(null);
	}

//pre upload
	$(function() {
	// Pré-visualização de várias imagens no navegador
	var visualizacaoImagens = function(input, lugarParaInserirVisualizacaoDeImagem) {

	    if (input.files) {
	        var quantImagens = input.files.length;

	        for (i = 0; i <= quantImagens; i++) {
	            var reader = new FileReader();

	            reader.onload = function(event) {
	                $($.parseHTML('<img class="miniatura">')).attr('src', event.target.result).appendTo(lugarParaInserirVisualizacaoDeImagem);
	            }

	            reader.readAsDataURL(input.files[i]);
	        }
	    }

	};

	$('#imagem').on('change', function() {
	    visualizacaoImagens(this, 'div.pre_foto');
	});
	});






