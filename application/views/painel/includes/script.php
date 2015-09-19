<?php echo $cat_json; ?>
<script type="text/javascript">
var url_     = "<?php echo base_url(); ?>",
	cat_json = <?php echo $cat_json; ?>

;


 function combo_subcategorias(value)
 {
 
 	var sub_cat = cat_json[value].subcategoria;

 	$.each(sub_cat, function(i, obj)
 	{

 		$('#subcategorias').append('<input type="checkbox" /><label>' + sub_cat[i].nome + '</label>');

 	});
 	/*console.log(cat_json.nome);*/
	/*cat_json[value].subcategoria*/
 	/*for(var i = 0; i < cat_json[value].subcategoria.length; i++) {
	    var obj = cat_json[value].subcategoria[i];

	    console.log(obj.nome);
	}*/
 	/*for (var i = cat_json.length - 1; i >= 0; i--) {
 		
 		console.log(cat_json[i].nome)
 	};*/
 	/*$.each(cat_json, function(i, obj){
 		console.log(obj.nome);
		//option[i] = document.createElement('option');//criando o option
		//$( option[i] ).attr( {value : obj.id} );//colocando o value no option
		//$( option[i] ).append( obj.nome );//colocando o 'label'

		$("select[name='combo2']").append( option[i] );//jogando um à um os options no próximo combo
	});*/

 }

function ajax(dados,destino,retorno)
{
	$.ajax({    
		//chama ajax				
		type: "POST", //método post
        url: destino, //url do arquivo que ele vai rodar
        
        data:dados,

        success: function(data)
        {           
            $(retorno).html(data);                   
        }
	});
}
</script>


<script type="text/javascript">
		
	/* função pronta para ser reaproveitada, caso queria adicionar mais combos dependentes */
	function resetaCombo( el )
	{
		$("select[name='"+el+"']").empty();//retira os elementos antigos
		var option = document.createElement('option');					
		$( option ).attr( {value : '0'} );
		$( option ).append( 'Escolha' );
		$("select[name='"+el+"']").append( option );
	}
	</script>