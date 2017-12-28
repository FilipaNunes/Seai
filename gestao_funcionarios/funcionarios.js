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

var evaluate_nif = 0;
var evaluate_email = 0;
var evaluate_submit = 0;


function CheckEmail(callback){
	var emailInput = document.getElementById('email').value;

	var xmlhttp = new XMLHttpRequest();

	if(emailInput==='' || emailInput===null) return;
  else if(evaluate_submit === 1)return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
        document.getElementById("email_indis").innerHTML="Email já está registado! Introduza outro!";
        document.getElementById('email').style.borderColor = "#f44336";
        evaluate_email=0;
        callback(false);
			}
		  else{
        document.getElementById("email_indis").innerHTML='';
        document.getElementById('email').style.borderColor = "#ccc";
		    evaluate_email = 1;
        callback(true);
	     }
	    }
	 };}

	xmlhttp.open("POST", "email.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "email=" + emailInput;
	xmlhttp.send(message);
	return;
}

function CheckNif(callback){
	var nif = document.getElementById('nif').value;

	var xmlhttp = new XMLHttpRequest();

	if(nif==='' || nif===null) return;
  else if(evaluate_submit === 1)return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
        document.getElementById("nif_indis").innerHTML="Nif já está registado! Introduza outro!";
        document.getElementById('nif').style.borderColor = "#f44336";
        evaluate_nif=0;
        callback(false);
			}
		  else{
        document.getElementById("nif_indis").innerHTML='';
        document.getElementById('nif').style.borderColor = "#ccc";
		    evaluate_nif = 1;
        callback(true);
	     }
	    }
	 };}

	xmlhttp.open("POST", "nif.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "nif=" + nif;
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
					text: 'Não é possível apagar este registo!',
					type: 'error',
					showConfirmButton: false,
					timer: 3500
				})
			} else if(response.status==='valid'){
				swal({
					title: 'Sucesso',
					text: 'O registo do funcionário foi apagado com sucesso!',
					type: 'success',
					showConfirmButton: false,
					timer: 3000
				})
				setTimeout(()=>{
					window.location.reload(true);
				},1500)
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

function AdicionarFuncionario(){
  CheckNif(function(result){
    if(result === true){
      CheckEmail(function(result){
        if(result === true){
          var nome_completo = document.getElementById('nome_completo').value;
          var morada = document.getElementById('morada').value;
          var email = document.getElementById('email').value;
          var telemovel = document.getElementById('telemovel').value;
          var nif = document.getElementById('nif').value;

          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              var response = JSON.parse(this.responseText);
              if(response.status==="ok"){
                evaluate_submit = 1;
                swal({
                  title: 'Registo Efetuado com Sucesso!',
                  type: 'success',
                  showConfirmButton: false
                })
                setTimeout(function(){window.location.href= 'index.php';},1500)
              }}};

          xmlhttp.open("POST", "regist_funcionario.php", true);
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          var message = "nome_completo=" + nome_completo + "&" + "email=" + email + "&" + "morada=" + morada
                        + "&" + "telemovel=" + telemovel + "&" + "nif=" + nif;
          xmlhttp.send(message);
          return;

        }
        else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
      })
    } else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
  });
}

var evaluate_faltas_injus = 0;
var evaluate_faltas_jus = 0;
var evaluate_faltas_atrasos = 0;
var evaluate_num_func = 0;
var evaluate_submit_dados = 0;


function FaltasInjustificadas(callback){
	var faltas_injus = document.getElementById('falta_injus').value;

	if( (faltas_injus.length > 0)  &&  (faltas_injus > 31) ){
		document.getElementById("falta_injus_in").innerHTML="O número de faltas não pode ser superior a 31!";
		document.getElementById('falta_injus').style.borderColor = "#f44336";
		evaluate_faltas_injus = 0;
    callback(false);
	}
	else{
		document.getElementById("falta_injus_in").innerHTML='';
		document.getElementById('falta_injus').style.borderColor = "#ccc";
		evaluate_faltas_injus = 1;
    callback(true);
	}

	return;

}

function FaltasJustificadas(callback){
	var faltas_jus = document.getElementById('falta_jus').value;

	if( (faltas_jus.length > 0)  &&  (faltas_jus > 31) ){
		document.getElementById("falta_jus_in").innerHTML="O número de faltas não pode ser superior a 31!";
		document.getElementById('falta_jus').style.borderColor = "#f44336";
		evaluate_faltas_jus = 0;
    callback(false);
	}
	else{
		document.getElementById("falta_jus_in").innerHTML='';
		document.getElementById('falta_jus').style.borderColor = "#ccc";
		evaluate_faltas_jus = 1;
    callback(true);
	}

	return;
}

function Atrasos(callback){
	var atrasos = document.getElementById('atrasos').value;

	if( (atrasos.length > 0)  &&  (atrasos > 31) ){
		document.getElementById("atrasos_in").innerHTML="O número de atrasos não pode ser superior a 31!";
		document.getElementById('atrasos').style.borderColor = "#f44336";
		evaluate_atrasos = 0;
    callback(false);
	}
	else{
		document.getElementById("atrasos_in").innerHTML='';
		document.getElementById('atrasos').style.borderColor = "#ccc";
		evaluate_atrasos = 1;
    callback(true);
	}

	return;
}

function NumFuncionario(callback){
	var numfunc = document.getElementById('func').value;
	var xmlhttp = new XMLHttpRequest();

	if(numfunc==='' || numfunc==='') return;
  else if(evaluate_submit_dados === 1)return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
        document.getElementById("num_indis").innerHTML="Não existe nenhum funcionário com o número inserido!";
        document.getElementById('func').style.borderColor = "#f44336";
        evaluate_num_func = 0;
  			callback(false);
			}
		  else {
        document.getElementById("num_indis").innerHTML='';
        document.getElementById('func').style.borderColor = "#ccc";
			  evaluate_num_func = 1;
        callback(true);
		  }
		}
	};}
	xmlhttp.open("POST", "numfunc.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "numfunc=" + numfunc;
	xmlhttp.send(message);
	return;
}

function AdicionarDados(){
  var salario = document.getElementById('salario').value;
	var numfunc = document.getElementById('func').value;
	var atrasos = document.getElementById('atrasos').value;
	var faltas_jus = document.getElementById('falta_jus').value;
	var faltas_injus = document.getElementById('falta_injus').value;
	var mes = document.getElementById('mes').value;

	var ano_value = document.getElementById('ano').value;
	var ano = document.getElementById('ano');
	ano = ano.options[ano_value].text;

  Atrasos(function(result){
    if(result===true){
      FaltasJustificadas(function(result){
        if(result===true){
          FaltasInjustificadas(function(result){
            if(result===true){
              NumFuncionario(function(result){
                if(result===true){
                  var xmlhttp = new XMLHttpRequest();

            			xmlhttp.onreadystatechange = function() {
            				if (this.readyState == 4 && this.status == 200) {
            					var response = JSON.parse(this.responseText);
            					if(response.status==="valid"){
            						evaluate_submit = 1;
            								swal({
            									 title: 'Dados Adicionados com Sucesso!',
            									 type: 'success',
            									 showConfirmButton: false
            								})
            									setTimeout(function(){window.location.href= 'index.php';},1500)
            								}}};

            						xmlhttp.open("POST", "inserirDados.php", true);
            						xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            						var message = "salario=" + salario + "&" + "ano=" + ano + "&" + "mes=" + mes
            													+ "&" + "atrasos=" + atrasos + "&" + "faltas_injus=" + faltas_injus
            													+ "&" + "numfunc=" + numfunc + "&" + "faltas_jus=" + faltas_jus;
            						xmlhttp.send(message);
            						return;
                }
                else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
              })
            }
            else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
          })
        }
        else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');
      })
    }
    else displayNotification('Por favor corrija os campos do formulário assinalados a vermelho!');

  });
}
