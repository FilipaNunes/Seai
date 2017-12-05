function ConfirmarDelete(id){
	console.log(id);
	swal({
	  title: 'Tem a certeza que quer apagar este armazém?',
	  text: "Esta ação não é reversível!",
	  type: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#f44336',
	  confirmButtonText: 'Confirmar',
	  cancelButtonText: 'Cancelar',
	  confirmButtonClass: 'btn btn-success',
	  cancelButtonClass: 'btn btn-danger',
	  buttonsStyling: true
	}).then(function (result) {
  if (result.value) {
	  setTimeout(function() {
      window.location.href = 'delete.php?id=' + id;
		}, 1500);
	swal(
      'Apagado',
      'O armazém foi apagado!',
      'success'
    )
  // result.dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  } else if (result.dismiss === 'cancel') {
    swal(
      'Cancelado',
      'O armazém não foi apagado!',
      'error'
    )
	return false;
  }
})
}