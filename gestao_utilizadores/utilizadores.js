function Delete(id){

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response.status==='not_ok'){
				swal({
					title: 'Erro',
					text: 'O cliente tem encomendas em processamento ou a serem enviadas no momento!',
					type: 'error',
					showConfirmButton: false,
					timer: 2500
				})
			} else if(response.status==='ok'){
				swal({
					title: 'Sucesso',
					text: 'O registo do cliente foi apagado com sucesso!',
					type: 'success',
					showConfirmButton: false,
					timer: 2000
				})
				setTimeout(()=>{
					window.location.reload(true);
				},2000)
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
		title: 'Tem a certeza que quer apagar este registo?',
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
		if (result.value) Delete(id)
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

function RetirarPrivilegios(id){
	var retirar_privilegios = 1;
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response.status==='not_ok'){
				swal({
					title: 'Erro',
					text: 'Não foi possível retirar os privilégios de administrador!',
					type: 'error',
					showConfirmButton: false,
					timer: 2500
				})
			} else if(response.status==='ok'){
				swal({
					title: 'Sucesso',
					text: 'O utilizador selecionado deixou de ter privilégios de administrador!',
					type: 'success',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(()=>{
					window.location.reload(true);
				},3000)
			}
		};
	}

	xmlhttp.open("POST", "privilegios.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

	message = "retirar_privilegios=" + retirar_privilegios + "&" + "id=" + id;
	xmlhttp.send(message);
	return;
}

function DarPrivilegios(id){
	var dar_privilegios = 1;
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response.status==='not_ok'){
				swal({
					title: 'Erro',
					text: 'Não foi possível conceder os privilégios de administrador!',
					type: 'error',
					showConfirmButton: false,
					timer: 2500
				})
			} else if(response.status==='ok'){
				swal({
					title: 'Sucesso',
					text: 'O utilizador selecionado tem agora privilégios de administrador!',
					type: 'success',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(()=>{
					window.location.reload(true);
				},3000)
			}
		};
	}

	xmlhttp.open("POST", "privilegios.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

	message = "conceder_privilegios=" + dar_privilegios + "&" + "id=" + id;
	xmlhttp.send(message);
	return;
}

function Privilegios(id){
	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response.status==='admin'){
				swal({
					title: 'Este utilizador já é administrador',
					text: "Quer retirar os privilégios?",
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
					if (result.value) RetirarPrivilegios(id);
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
			} else if(response.status==='not_admin'){
				swal({
					title: 'Este utilizador não é administrador',
					text: "Quer conceder os privilégios?",
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
					if (result.value) DarPrivilegios(id);
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
		};
	}

	xmlhttp.open("POST", "admin.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

	message = "id=" + id;
	xmlhttp.send(message);
	return;
}
