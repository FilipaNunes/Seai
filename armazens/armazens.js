function Delete(id){

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			if(response.status==='not_ok'){
				swal({
					title: 'Erro',
					text: 'O armazém tem encomendas que não foram entregues!',
					type: 'error',
					showConfirmButton: false,
					timer: 3500
				})
			} else if(response.status==='valid'){
				swal({
					title: 'Sucesso',
					text: 'O armazém foi apagado com sucesso!',
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

function AdicionarArmazem(){
	var nome_armazem = document.getElementById('nome').value;
	var morada_arm = document.getElementById('morada_arm').value;
	var lotacao_max = document.getElementById('lotacao_max').value;

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_valid"){
				document.getElementById("n_disponivel").innerHTML="Já existe um armazém com o nome inserido! Escolha outro!";
				document.getElementById('nome').style.borderColor = "#f44336";
			}else if(response.status==="valid"){
					document.getElementById("n_disponivel").innerHTML=null;
					document.getElementById('nome').style.borderColor = "#ccc";
				swal({
					title: 'Sucesso',
					text: 'O armazém foi adicionado com sucesso!',
					type: 'success',
					showConfirmButton: false,
					timer: 2500
				})
				setTimeout(()=>{
					window.location.reload(true);
				},2500)
		  }
		}
	};

	xmlhttp.open("POST", "regist_arm.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "nome=" + nome_armazem + "&" + "morada_arm=" + morada_arm + "&" + "lotacao_max=" + lotacao_max;
	xmlhttp.send(message);
	return;


}
