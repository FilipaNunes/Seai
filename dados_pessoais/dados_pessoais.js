function UpdateDados(){
		var name = document.getElementById('name').value;
		var email = document.getElementById('email').value;
		var nif = document.getElementById('nif').value;
		var morada = document.getElementById('morada').value;
		var telephone = document.getElementById('telephone').value;
		var usernameInput = document.getElementById('user').value;
	  var passInput = document.getElementById('pass').value;

		var update = 1;

		var new_pass = null;
		var cnew_pass = null;

		if(document.getElementById('n_pass') !== null) new_pass = document.getElementById('n_pass').value;
		if(document.getElementById('cn_pass') !== null) cnew_pass = document.getElementById('cn_pass').value;

		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var response = JSON.parse(this.responseText);
				if(response.status==='not_ok2') window.location.href = 'update_dados2.php';
				else if(response.status==='ok')window.location.href = 'dados_pessoais.php';
				else if(response.status==='not_ok3') window.location.href = 'update_dados3.php';
				else if(response.status==='not_ok4') window.location.href = 'update_dados4.php';
				}
			};

		xmlhttp.open("POST", "action_update.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

		var message = "username=" + usernameInput + "&" + "password=" + passInput + "&" + "name=" + name + "&" +
									"email=" + email + "&" + "nif=" + nif + "&" + "address=" + morada + "&" + "update=" + update + "&" +
									"telephone=" + telephone + "&" + "new_password=" + new_pass + "&" + "confirm_new_password=" + cnew_pass ;

		xmlhttp.send(message);
		return;
}

function Delete(id){

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response.status==='not_ok'){
				swal({
					title: 'Erro',
					text: 'A encomenda já foi enviada, não pode ser apagada!',
					type: 'error',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(()=>{
					window.location.href='dados_pessoais2.php';
				},3000);
			} else if(response.status==='ok'){
				swal({
					title: 'Sucesso',
					text: 'A encomenda foi apagada com sucesso!',
					type: 'success',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(()=>{
					window.location.href='dados_pessoais2.php';
				},3000);
			} else if (response.status==='not_ok2'){
				swal({
					title: 'Erro',
					text: 'Não foi possível apagar a encomenda! Tente outra vez!',
					type: 'error',
					showConfirmButton: false,
					timer: 2500
				})
				setTimeout(()=>{
					window.location.href='dados_pessoais2.php';
				},2500);
			}
		};
	}

	xmlhttp.open("POST", "delete.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

	var message = "id=" + id;
	xmlhttp.send(message);
	return;

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
  if (result.value) Delete(id);
  else if (result.dismiss === 'cancel') {
			swal({
				title: 'Erro',
				text: 'A operação foi cancelada!',
				type: 'error',
				showConfirmButton: false,
				timer: 2000
			})
			return false;
		}
})
}
