$(document).ready(function(){
$("#cbComputador").change(function(){
if($(this).is(':checked')) {
	$("#Computador").append("<td><input id=numeroComp name='quantidade' placeholder='Quantidade'></td>");
}else{ 
	$("#numeroComp").remove();
}
});
});