notificationNumber = 0;
function displayNotification(notification){
  var noteNumber = notificationNumber++;
  var container = document.getElementById("notification-container");
  var notificationElement = document.createElement("DIV");
  var txt = document.createTextNode(notification);
  notificationElement.appendChild(txt);
  notificationElement.setAttribute('class', 'notification');
  notificationElement.setAttribute('id', 'note'+noteNumber);
  notificationElement = container.appendChild(notificationElement);
  //notificationElement = document.getElementById('note'+noteNumber);
  setTimeout(()=>{ container.removeChild(notificationElement);},5500)
}

function Finalizar(){
	swal({
		title: 'Tem a certeza que prentende finalizar a encomenda?',
		type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#f44336',
			confirmButtonText: 'Submeter',
			cancelButtonText: 'Cancelar',
			confirmButtonClass: 'btn btn-success',
			cancelButtonClass: 'btn btn-danger',
			buttonsStyling: true
	}).then(function (result) {
		if (result.value){
      swal({
    		title: 'Submetido',
    		text: "A encomenda foi submetida com sucesso!",
    		type: 'success',
    		showConfirmButton: false,
    		timer: 1500
    	})
      setTimeout(function(){
        document.getElementById("finalizar").submit();
      }, 2500);
    }
		else if (result.dismiss === 'cancel') return false;
	})

}

function ConfirmarDelete(id){
	swal({
	  title: 'Tem a certeza que quer apagar esta encomenda?',
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
	swal({
		title: 'Apagado',
		text: "A encomenda foi apagado com sucesso!",
		type: 'success',
		showConfirmButton: false,
		timer: 1500
	})
  // result.dismiss can be 'cancel', 'overlay',
  // 'close', and 'timer'
  }
})
}
