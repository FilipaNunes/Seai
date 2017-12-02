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
		if (result.value)document.getElementById("finalizar").submit();
		else if (result.dismiss === 'cancel') return false;
	})
	
}
