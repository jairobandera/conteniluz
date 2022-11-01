//alert('Hola mundo');

//alertas
function alertaLogin() {
    Swal.fire({
        title: 'Error!',
        text: 'Usuario y/o contraseña incorrectos',
        icon: 'error',
        confirmButtonText: 'Aceptar'
      })
}

function alertaCrearCuentas($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Cuenta creada!',
            text: 'Cuenta creada correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al crear la cuenta',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}

function alertaCrearEmpresas($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Cuenta creada!',
            text: 'Cuenta creada correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al crear la cuenta',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}

function alertaEditarEmpresas($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Cuenta editada!',
            text: 'Cuenta editada correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al editar la cuenta',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}

function alertaEliminarEmpresas($estado) {
    
    if($estado == 3) {
        document.addEventListener("DOMContentLoaded", () => {
            document.querySelector("#eliminarEmpresas").addEventListener("click", evento => {
                // Prevenir sólo si el usuario dice que no
                if (!confirm("¿Realmente quieres ir a mi sitio web?")) {
                    evento.preventDefault()
                }
            });
        });
    }else if($estado == 1) {
        Swal.fire({
            title: 'Cuenta eliminada!',
            text: 'Cuenta eliminada correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    }else{
        Swal.fire({
            title: 'Error!',
            text: 'Error al eliminar la cuenta',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}

function alertaCrearCursos($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Curso agregado!',
            text: 'Curso agregado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al agregar el curso',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}

function alertaEditarCursos($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Curso editado!',
            text: 'Curso editado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al editar el curso',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}

function alertaAgregarVideos($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Video agregado!',
            text: 'Video agregado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al agregar el video',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}


function alertaEditarVideos($estado) {
    if ($estado == 1) {
        Swal.fire({
            title: 'Video editado!',
            text: 'Video editado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
          })
    } else {
        Swal.fire({
            title: 'Error!',
            text: 'Error al editar el video',
            icon: 'error',
            confirmButtonText: 'Aceptar'
          })
    }
}
