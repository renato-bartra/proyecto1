$(document).ready(function(){

/* -------------------------------------------------------------------------- */
/*                          DATATABLE ADMINISTRADORES                         */
/* -------------------------------------------------------------------------- */
$.ajax({
	url: "ajax/eventos.ajax.php",
	success:function(respuesta){
		console.log("respuesta" , respuesta);
	}
})
if (document.querySelector('#registros-eventos')){
	let tablaEventos = $('#registros-eventos').DataTable({
		"ajax": "ajax/eventos.ajax.php",
		"processing": true,
		"language": DataTable_Es
	});
}
})