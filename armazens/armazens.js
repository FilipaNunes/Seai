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
  setTimeout(()=>{
    container.removeChild(notificationElement);
  },4500)
}

var evaluate_name;
var evaluate_coordinates;
var evaluate_submit;

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
					window.location.href='index.php';
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

function NomeArmazem(callback){
	evaluate_name = 0;
	var nome_armazem = document.getElementById('nome').value;

  	var xmlhttp = new XMLHttpRequest();

  	xmlhttp.onreadystatechange = function() {
  		if (this.readyState == 4 && this.status == 200) {
  			var response = JSON.parse(this.responseText);
  			if(response.status==="not_ok"){
  				document.getElementById("n_disponivel").innerHTML="Já existe um armazém com o nome inserido! Escolha outro!";
  				document.getElementById('nome').style.borderColor = "#f44336";
  				callback(false);
  			}else if(response.status==="ok"){
  					document.getElementById("n_disponivel").innerHTML='';
  					document.getElementById('nome').style.borderColor = "#ccc";
  					evaluate_name = 1;
  					callback(true);
  		}
  	};
  }
  	xmlhttp.open("POST", "nome_armazem.php", true);
  	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	var message = "nome=" + nome_armazem;
  	xmlhttp.send(message);
  	return;
}

function NomeArmazem2(callback){
	evaluate_name = 0;
	var nome_armazem = document.getElementById('nome').value;

  if(nome_armazem == '' ) document.getElementById('nome').value = document.getElementById('nome').placeholder;
  else{
  	var xmlhttp = new XMLHttpRequest();

  	xmlhttp.onreadystatechange = function() {
  		if (this.readyState == 4 && this.status == 200) {
  			var response = JSON.parse(this.responseText);
  			if(response.status==="not_ok"){
  				document.getElementById("n_disponivel").innerHTML="Já existe um armazém com o nome inserido! Escolha outro!";
  				document.getElementById('nome').style.borderColor = "#f44336";
  				callback(false);
  			}else if(response.status==="ok"){
  					document.getElementById("n_disponivel").innerHTML='';
  					document.getElementById('nome').style.borderColor = "#ccc";
  					evaluate_name = 1;
  					callback(true);
  		}
  	};
  }
  	xmlhttp.open("POST", "nome_armazem.php", true);
  	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	var message = "nome=" + nome_armazem;
  	xmlhttp.send(message);
  	return;
  }
}

function Coordenadas(callback){

	if( document.getElementById('latitude') !== null && document.getElementById('longitude') !== null){
		evaluate_coordinates = 0;
		var latitude = document.getElementById('latitude').value;
		var longitude = document.getElementById('longitude').value;

		var xmlhttp = new XMLHttpRequest();

		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				var response = JSON.parse(this.responseText);
				if(response.status==="not_ok"){
					document.getElementById("coordenadas").innerHTML="Já existe um armazém com as coordenadas inseridas!";
					document.getElementById('latitude').style.borderColor = "#f44336";
					document.getElementById('longitude').style.borderColor = "#f44336";
					callback(false);
				}else if(response.status==="ok"){
					document.getElementById("coordenadas").innerHTML='';
					document.getElementById('latitude').style.borderColor = "#ccc";
					document.getElementById('longitude').style.borderColor = "#ccc";
					evaluate_coordinates = 1;
					callback(true);
			}
		};
	}

		xmlhttp.open("POST", "coordenadas.php", true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		var message = "latitude=" + latitude + "&" + "longitude=" + longitude;
		xmlhttp.send(message);
		return;
	}
}

function AdicionarArmazem(){

	var nome_armazem = document.getElementById('nome').value;
	var morada_arm = document.getElementById('morada_arm').value;
	var lotacao_max = document.getElementById('lotacao_max').value;
	var latitude = document.getElementById('latitude').value;
	var longitude = document.getElementById('longitude').value;

	Coordenadas(function(result){
		if(result === true){
			NomeArmazem(function(result){
				if(result === true){
					var xmlhttp = new XMLHttpRequest();

					xmlhttp.onreadystatechange = function() {
						if (this.readyState == 4 && this.status == 200) {
						  var response = JSON.parse(this.responseText);
						  if(response.status==="not_ok"){
								swal({
									title: 'Erro',
									text: 'Não foi possível concluir a ação! Tente outra vez!',
									type: 'error',
									showConfirmButton: false,
									timer: 2500
								})
								setTimeout(()=>{
									window.location.href='index.php';
								},2500)
							}else if(response.status==="ok"){
								swal({
									title: 'Sucesso',
									text: 'O armazém foi adicionado com sucesso!',
									type: 'success',
									showConfirmButton: false,
									timer: 2500
								})
								setTimeout(()=>{
									window.location.href='index.php';
								},2500)
						}
					};
				}
					xmlhttp.open("POST", "regist_arm.php", true);
					xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					var message = "nome=" + nome_armazem + "&" + "morada_arm=" + morada_arm + "&" + "lotacao_max=" + lotacao_max +
												"&" + "latitude=" + latitude + "&" + "longitude=" + longitude ;
					xmlhttp.send(message);
					return;
				} else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
			})
		}
		else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
	});
}

function Preencher(){
  var nome_armazem = document.getElementById('nome').placeholder;
  var lotacao = document.getElementById('lotacao_max').placeholder;

  if( document.getElementById('nome').value == '' )document.getElementById('nome').value = document.getElementById('nome').placeholder;

  if(document.getElementById('lotacao_max').value == '') document.getElementById('lotacao_max').value = document.getElementById('lotacao_max').placeholder;
}

function EditarArmazem(){

	var nome_armazem = document.getElementById('nome').value;
  var nome_armazem_2 = document.getElementById('nome').placeholder;
	var lotacao_max = document.getElementById('lotacao_max').value;
  var armazem = document.getElementById('armazem').value;

  if(nome_armazem === nome_armazem_2){
    var flag = 1;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if(response.status==="not_ok"){
          swal({
            title: 'Erro',
            text: 'Não foi possível concluir a ação! Tente outra vez!',
            type: 'error',
            showConfirmButton: false,
            timer: 2500
          })
          setTimeout(()=>{
            window.location.href='index.php';
          },2500)
        }else if(response.status==="ok"){
          swal({
            title: 'Sucesso',
            text: 'O armazém foi atualizado com sucesso!',
            type: 'success',
            showConfirmButton: false,
            timer: 2500
          })
          setTimeout(()=>{
            window.location.href='index.php';
          },2500)
      }
    };
  }
    xmlhttp.open("POST", "editar_arm.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    var message = "nome=" + nome_armazem + "&" + "lotacao_max=" + lotacao_max + "&" + "armazem=" + armazem + "&" + "flag=" + flag ;
    xmlhttp.send(message);
    return;
  }
  else{
    NomeArmazem(function(result){
      if(result === true){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);
            if(response.status==="not_ok"){
              swal({
                title: 'Erro',
                text: 'Não foi possível concluir a ação! Tente outra vez!',
                type: 'error',
                showConfirmButton: false,
                timer: 2500
              })
              setTimeout(()=>{
                window.location.href='index.php';
              },2500)
            }else if(response.status==="ok"){
              swal({
                title: 'Sucesso',
                text: 'O armazém foi atualizado com sucesso!',
                type: 'success',
                showConfirmButton: false,
                timer: 2500
              })
              setTimeout(()=>{
                window.location.href='index.php';
              },2500)
          }
        };
      }
        xmlhttp.open("POST", "editar_arm.php", true);
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var message = "nome=" + nome_armazem + "&" + "lotacao_max=" + lotacao_max + "&" + "armazem=" + armazem ;
        xmlhttp.send(message);
        return;
  }
  else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
  });
}
}
