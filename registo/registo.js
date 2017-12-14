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

var evaluate_username;
var evaluate_pass;
var evaluate_email;


function CheckUsername(){
	evaluate_username=0;
	var usernameInput = document.getElementById('user').value;
	var xmlhttp = new XMLHttpRequest();
	
	if(usernameInput==='' || usernameInput===null) return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
				document.getElementById('btnSubmit').disabled = true;
				displayNotification("Nome de utilizador não disponível! Por favor tente outro!");
			}
		  else {
			  evaluate_username = 1;
			  ActivateSubmit();
		  }
		}
	};}
	xmlhttp.open("POST", "user.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "username=" + usernameInput;
	xmlhttp.send(message);
	return;
}

function ValidatePassword(){
	evaluate_pass=0;
	if(document.getElementById('pass').value != '' && document.getElementById('c_pass').value != '' ){
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
		text: 'Vai ser redirecionado para a página para completar os seus dados pessoais',
		timer: 4500,
		onOpen: function () {
		swal.showLoading()
		}
	})
	setTimeout(()=>{
		document.getElementById("form").submit();
	},2500)
	
	
}


function Disable(){
	
	document.getElementById('btnSubmit').disabled = true;

	
	
}
