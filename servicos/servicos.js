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
  },5500)
}

var evaluate_username;
var evaluate_pass;
var evaluate_email;


function VerificaPeso(){
	var peso_limite = document.getElementById('limite_peso').value;
	
	var peso_limite_inf = peso_limite - 1;
	
	var peso = document.getElementById('peso').value;
	
	var  n = peso.search(',');
	
	if(n !== -1){
		var partes_peso = peso.split(',');
		peso = partes_peso[0].concat('.', partes_peso[1]);
	}
	
	var comp = peso.length;
	n = peso.search('\.');
	
	console.log(peso);
	console.log(n);
	
	if(comp > 1 && n === -1){
		displayNotification("O peso não está no formato correto. Por favor insira neste formato 2 ou 2,3 ou 2.3");
		document.getElementById('btnSubmit').disabled = true;
	}
	else if(peso > 4) displayNotification("O drone não tem capacidade de transportar encomendas com peso maior a 4 kg!");
	else if( peso > peso_limite){
		displayNotification("Peso inserido é maior que o permitido para a categoria selecionada! A categoria foi reajustada!");
		
		var peso_reaj = Math.ceil(peso);
		
		document.getElementById('limite_peso').value = peso_reaj;
	
	}
	else if( peso <= peso_limite_inf){
		displayNotification("Peso inserido é inferior ao limite da categoria selecionada! A categoria foi reajustada!");
		
		var peso_reaj = Math.ceil(peso);
		
		document.getElementById('limite_peso').value = peso_reaj;
	}

}

function ValidatePassword(){
	evaluate_pass=0;
	
    if (document.getElementById('pass').value != document.getElementById('c_pass').value) {
		document.getElementById('btnSubmit').disabled = true;
		displayNotification("Password inseridas não correspondem! Tente outra vez");
        return false;
	}
	else{
		  evaluate_pass = 1;
		  ActivateSubmit();
	}
}

function CheckEmail(){
	evaluate_email=0;
	var emailInput = document.getElementById('email').value;

	var xmlhttp = new XMLHttpRequest();
	
	if(emailInput==='' || emailInput===null) return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
				document.getElementById('btnSubmit').disabled = true;
				displayNotification("Email já existe! Por favor tente outro!");
			}
		  else{
		  evaluate_email = 1;
		  ActivateSubmit();
	}
		}
	};}
	xmlhttp.open("POST", "email.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "email=" + emailInput;
	xmlhttp.send(message);
	return;
}

function ActivateSubmit(){

	if((evaluate_username === 1) && (evaluate_pass === 1) && (evaluate_email === 1)) document.getElementById('btnSubmit').disabled = false;

}

function RegistoFeito(){
	swal({
		title: 'Registo Efetuado com Sucesso!',
		text: 'Vai ser rederecionado para a página para completar os seus dados pessoais',
		timer: 1500,
		onOpen: function () {
			swal.showLoading()
		}
	})
	document.getElementById("form").submit();
}
