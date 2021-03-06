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

var evaluate_username = 0;
var evaluate_email = 0;
var evaluate_pass = 0;
var evaluate_submit = 0;


function CheckUsername(callback){
	var usernameInput = document.getElementById('user').value;
	var xmlhttp = new XMLHttpRequest();
  evaluate_username = 0;

	if(usernameInput==='' || usernameInput===null) return;
  else if(evaluate_submit === 1)return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
        document.getElementById("username_indis").innerHTML="O username não está disponível! Escolha outro!";
        document.getElementById('user').style.borderColor = "#f44336";
        evaluate_username = 0;
  			callback(false);
			}
		  else {
        document.getElementById("username_indis").innerHTML=null;
        document.getElementById('user').style.borderColor = "#ccc";
			  evaluate_username = 1;
        callback(true);
		  }
		}
	};}
	xmlhttp.open("POST", "user.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	var message = "username=" + usernameInput;
	xmlhttp.send(message);
	return;
}

function ValidatePassword(callback){
  evaluate_pass = 0;

  if(evaluate_submit === 1)return;
	else if(document.getElementById('pass').value != '' && document.getElementById('c_pass').value != '' ){
		if (document.getElementById('pass').value != document.getElementById('c_pass').value) {
      document.getElementById("pass_match").innerHTML="Passwords inseridas não coincidem!";
      document.getElementById('pass').style.borderColor = "#f44336";
      document.getElementById('c_pass').style.borderColor = "#f44336";
      evaluate_pass = 0;
			callback(false);
		}
		else{
      document.getElementById("pass_match").innerHTML=null;
      document.getElementById('pass').style.borderColor = "#ccc";
      document.getElementById('c_pass').style.borderColor = "#ccc";
      evaluate_pass = 1;
      callback(true);
		}
	}
}

function CheckEmail(callback){
	var emailInput = document.getElementById('email').value;
  evaluate_email=0;

	var xmlhttp = new XMLHttpRequest();

	if(emailInput==='' || emailInput===null) return;
  else if(evaluate_submit === 1)return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
		  var response = JSON.parse(this.responseText);
		  if(response.status==="not_ok"){
        document.getElementById("email_indis").innerHTML="Email já está registado! Escolha outro!";
        document.getElementById('email').style.borderColor = "#f44336";
        evaluate_email=0;
        callback(false);
			}
		  else{
        document.getElementById("email_indis").innerHTML=null;
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

function LoginAutomatico(){
  var usernameInput = document.getElementById('user').value;
  var passInput = document.getElementById('pass').value;
  var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var response = JSON.parse(this.responseText);
        if(response.status==="ok")window.location.href = '../dados_pessoais/update_dados.php';
        else if(response.status==="not_ok"){
        swal({
          title: 'ERRO!',
          text: 'Tente outra vez!',
          type: 'error',
          showConfirmButton: false,
          timer: 2000
        });
      }
      }
    };

  xmlhttp.open("POST", "login.php", true);
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var message = "user=" + usernameInput + "&" + "pass=" + passInput;
  xmlhttp.send(message);
  return;
}


function ActivateSubmit(){
  CheckUsername();
  CheckEmail();
  ValidatePassword();

  setTimeout(function(){
    if((evaluate_username === 1) && (evaluate_pass === 1) && (evaluate_email === 1)){evaluate_submit = 1; return true;}
    else return false;
  },300);

}


function RegistoFeito(){

  CheckUsername(function(result){
    if(result===true) {
      CheckEmail(function(result){
        if(result===true){
          ValidatePassword(function(result){
            if(result===true){
              var usernameInput = document.getElementById('user').value;
              var emailInput = document.getElementById('email').value;
              var passInput = document.getElementById('pass').value;
              var xmlhttp = new XMLHttpRequest();

              xmlhttp.onreadystatechange = function() {
            		if (this.readyState == 4 && this.status == 200) {
            		  var response = JSON.parse(this.responseText);
            		  if(response.status==="ok"){
                    swal({
                      title: 'Registo Efetuado com Sucesso!',
                      text: 'Vai ser redirecionado para a página para completar os seus dados pessoais',
                      type: 'success',
                      showConfirmButton: false,
                      timer: 2500
                    });
                    evaluate_submit = 1;
                    setTimeout(()=>{LoginAutomatico();},2300);
            			}else if (response.status==="not_ok") {
                    setTimeout(()=>{window.location.reload(true);},1000)
                    swal({
                      title: 'ERRO!',
                      text: 'Tente outra vez!',
                      type: 'error',
                      showConfirmButton: false,
                      timer: 2000
                    })
                  }
                }
              };
              xmlhttp.open("POST", "registo.php", true);
             	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
             	var message = "user=" + usernameInput + "&" + "email=" + emailInput + "&" + "pass=" + passInput;
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
  });
}
