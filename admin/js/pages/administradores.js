$(document).ready(function(){

/*=============================================
=    ACCIONES AL SUBIR LA FOTO DEL USUARIO    =
=============================================*/
$(".nuevaFoto").change(function() {
	var imagen = this.files[0];

	/*=============================================
	=    VALIDACION DE IMAGEN A SUBIR(JPG, PNG)   =
	=============================================*/
	if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
		$(".nuevaFoto").val("");
		Swal.fire({
			type: 'error',
			title: 'Error al subir la imagen',
			text: 'La imagen debe estar en formato JPG o PNG!',
			confirmButtonText: 'Cerrar'
		})
	}else if(imagen["size"] > 2000000){
		$(".nuevaFoto").val("");
		Swal.fire({
			type: 'error',
			title: 'Error al subir la imagen',
			text: 'La imagen no debe pesar de los 2 megabytes !',
			confirmButtonText: 'Cerrar'
		})
	}else {
		var datosImagen = new FileReader;
		datosImagen.readAsDataURL(imagen);
		$(datosImagen).on("load", function(event) {
			var rutaImagen = event.target.result;
			$(".previsualizar").attr("src", rutaImagen);
		});
	}

});

/* -------------------------------------------------------------------------- */
/*                            GUARDAR ADMINISTRADOR                           */
/* -------------------------------------------------------------------------- */
if (document.querySelector('#crear-admin')) {
	let formulario = document.querySelector('#crear-admin');
	formulario.addEventListener('submit', function(e){
		e.preventDefault();
		let datos = new FormData(formulario);
		funcionAdmin(datos);
	})
}

/* -------------------------------------------------------------------------- */
/*                             VALIDAR CONTRASEÑA                             */
/* -------------------------------------------------------------------------- */
if (document.querySelector('#repetirContrasena')) {
	let contrasena = document.querySelector('#nuevoContrasena');
	let repetirContrasena = document.querySelector('#repetirContrasena');
	repetirContrasena.addEventListener('keyup', function(){
		if (repetirContrasena.value == contrasena.value) {
			document.querySelector('#resultado-contrasena').innerHTML = "Las contraseñas coinciden correctamente";
			document.querySelector('#resultado-contrasena').parentNode.classList.remove('has-error');
			document.querySelector('#resultado-contrasena').parentNode.classList.add('has-success');
			document.querySelector('.validar-pass').classList.remove('has-error');
			document.querySelector('.validar-pass').classList.add('has-success');
		} else{
			document.querySelector('#resultado-contrasena').innerHTML = "Las contraseñas no coinciden";
			document.querySelector('#resultado-contrasena').parentNode.classList.add('has-error');
			document.querySelector('#resultado-contrasena').parentNode.classList.remove('has-success');
			document.querySelector('.validar-pass').classList.add('has-error');
			document.querySelector('.validar-pass').classList.remove('has-success');
		}
	})
}

/* -------------------------------------------------------------------------- */
/*                            INGRESO ADMINISTRADOR                           */
/* -------------------------------------------------------------------------- */
if (document.querySelector('#login-admin')) {
	let loginFormulario = document.querySelector('#login-admin');
	loginFormulario.addEventListener('submit', function(e){
		e.preventDefault();
		let datosLog = new FormData(loginFormulario);
		funcionAdmin(datosLog);
	})
}

/* -------------------------------------------------------------------------- */
/*                                EDITAR ADMIN                                */
/* -------------------------------------------------------------------------- */
if (document.querySelector('#editar-admin')) {
	let editformulario = document.querySelector('#editar-admin');
	editformulario.addEventListener('submit', function(e){
		e.preventDefault();
		let datos = new FormData(editformulario);
		funcionAdmin(datos);
	})
}

/* -------------------------------------------------------------------------- */
/*                          DATATABLE ADMINISTRADORES                         */
/* -------------------------------------------------------------------------- */
if (document.querySelector('#registros')){
	let tablaAdmin = $('#registros').DataTable({
		"ajax": "ajax/admin.ajax.php",
		"processing": true,
		"language": DataTable_Es
	});
}

/* -------------------------------------------------------------------------- */
/*                                BORRAR ADMIN                                */
/* -------------------------------------------------------------------------- */
if (document.querySelector('#registros')) {
	$('#registros').on('click', '.borrar-registro', function(e){
		e.preventDefault();
		let idAdmin = this.getAttribute('data-id');
		let datos = new FormData();
		datos.append("formulario-admin", "borrar");
		datos.append("idAdmin", idAdmin);

		Swal.fire({
			title: '¿Estas seguro de borrar el administrador?',
			text: "¡No podras revertir esta acción!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '¡Si, eliminar!',
			cancelButtonText: 'Cancelar'
			}).then((result) => {
			if (result.value) {
				funcionAdmin(datos);
			}
			})
	});
}

/* -------------------------------------------------------------------------- */
/*                           FUNCION FETCH PARA CRUD                          */
/* -------------------------------------------------------------------------- */
const funcionAdmin = async (datos) =>{
	try {
		const respPost = await fetch("modelo-admin.php", {method: 'POST', body: datos})
		const resp = await respPost.json()
		switch (resp.respuesta) {
			case "exito":
				Swal.fire(
					'Correcto',
					'¡El usuario se guardó correctamente!',
					'success'
				  )
				break;
			case "logExito":
				window.location.href = "admin-area.php";
				break;
			case "logError":
				Swal.fire({
					icon: 'error',
					title: 'Error',
					text: 'Usuario o ocontraseña incorrectos',
				  })
				break;
			case "editExito":
				Swal.fire(
					'Correcto',
					'¡El usuario se editó correctamente!',
					'success'
					)
				break;
			case "borrarExito":
				listarDataTable();
				Swal.fire(
					'Correcto',
					'¡El usuario se elimino correctamente!',
					'success'
					);
				break;
			default:
				Swal.fire({
					icon: 'error',
					title: 'Oops...',
					text: '¡Algo salió mal!',
				  })
				break;
		}
	} catch (error) {
		console.log(error);
	}
}

// FUNCION BORRAR REGISTRO DE TABLA
let listarDataTable = () => {
	// En caso se tenga que recargar la tabla
	// $('#registros').DataTable({
	// 	"destroy": true,
	// 	"ajax": "ajax/admin.ajax.php",
	// 	"processing": true,
	// 	"language": DataTable_Es
	// });
	tablaAdmin.draw();
}

})
