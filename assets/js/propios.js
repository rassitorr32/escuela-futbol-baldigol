function cambiarEstado(){
    // alert("cambio de estado");
    Swal.fire({
        title: 'Estás seguro de eliminar este usuario?',
        showCancelButton: true,
        confirmButtonText: "Confirmar",
        denyButtonText: "Cancelar",
    }).then((result)=>{//captura el resultado 
        if(result.isConfirmed){
        }
    });
}