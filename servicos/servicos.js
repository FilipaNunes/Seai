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

var avaliar_peso;
var avaliar_dim;
var avaliar_quant;

function TransformaPeso(peso){

	var pattern = new RegExp("^([0-9]+[.]+[0-9])$");
	var pattern2 = new RegExp("^([0-9])$");
	var teste = pattern.test(peso);
	var teste2 = pattern2.test(peso);

	if( teste !== true && teste2 !== true){
		displayNotification("O peso não está no formato correto. Por favor insira neste formato 2 ou 2.3");
		document.getElementById('btnSubmit').disabled = true;
		return -1;
	}
	else{
		var  n = peso.search(',');

		if(n !== -1){
		var partes_peso = peso.split(',');
		peso = partes_peso[0].concat('.', partes_peso[1]);
	}
		return peso;
	}
}

function VerificaCategoria(){
	var peso = document.getElementById('peso').value;

	if(peso !== ''){
		peso = TransformaPeso(peso);
		if(peso === -1)return;
		else if(peso == 0) displayNotification("O peso não pode ser 0!Por favor insira um valor maior que 0!");
		else{
			displayNotification("Peso inserido não está no intervalo da categoria escolhida. Por favor reajuste o peso!");
			var peso_reaj = Math.ceil(peso);
			document.getElementById('limite_peso').value = peso_reaj;
		}
	}
	Custo();

}

function VerificaPeso(){
	var peso_limite = document.getElementById('limite_peso').value;
	var peso_limite_inf = peso_limite - 1;
	var peso = document.getElementById('peso').value;
	avaliar_peso = 0;

	if(peso !== ''){
		document.getElementById('btnSubmit').disabled = true;
		peso = TransformaPeso(peso);

		if(peso === -1)return;
		else if(peso == 0)displayNotification("O peso não pode ser 0! Por favor insira um valor maior que 0!");
		else if(peso > 4) displayNotification("O drone não tem capacidade de transportar encomendas com peso maior a 4 kg!");
		else if( peso > peso_limite){
			displayNotification("Peso inserido é maior que o permitido para a categoria selecionada! A categoria foi reajustada!");

			var peso_reaj = Math.ceil(peso);
			document.getElementById('limite_peso').value = peso_reaj;

			avaliar_peso = 1;
			ActivateSubmit();
			Custo();

		}
		else if( peso <= peso_limite_inf){
			displayNotification("Peso inserido é inferior ao limite da categoria selecionada! A categoria foi reajustada!");

			var peso_reaj = Math.ceil(peso);
			document.getElementById('limite_peso').value = peso_reaj;

			avaliar_peso = 1;
			ActivateSubmit();
			Custo();
		}
		else{
			avaliar_peso = 1;
			ActivateSubmit();
			Custo();
		}
	}

}

function VerificarDimensao(){
	var dim = document.getElementById('dim').value;
	var pattern = new RegExp("^([0-9]{1,2})+[x]+([0-9]{1,2})+[x]+([0-9]{1,2})$");
	var teste = pattern.test(dim);
	var comprimento_max = 30;
	var largura_max= 30;
	var altura_max = 30;
	avaliar_dim = 0;

	if( teste !== true ){
		displayNotification("A dimensão não está no formato correto. Por favor insira neste formato 30x30x30!");
		document.getElementById('btnSubmit').disabled = true;
	}
	else{
		document.getElementById('btnSubmit').disabled = true;
		var partes_dim = dim.split('x');
		if(partes_dim[0] > comprimento_max)displayNotification("O comprimento inserido é maior do que a máximo(30 cm)!");
		else if (partes_dim[1] > largura_max)displayNotification("A largura inserida é maior do que a máxima(30 cm)!");
		else if (partes_dim[2] > altura_max)displayNotification("A altura inserida é maior do que a máxima(30 cm)!");
		else if(partes_dim[0] == 0)displayNotification("O comprimento inserido tem de ser maior que 0 cm!");
		else if (partes_dim[1] == 0)displayNotification("A largura inserida tem de ser maior que 0 cm!");
		else if (partes_dim[2] == 0)displayNotification("A altura inserida tem de ser maior que 0 cm!");
		else{
			avaliar_dim = 1;
			ActivateSubmit();
		}
	}
}

function Quantidade(){
	avaliar_quant = 0;
	var quant = document.getElementById('quant').value;
	var pattern = new RegExp("^([0-9]{1,2})$");
	var teste = pattern.test(quant);

	if(quant != ''){
		document.getElementById('btnSubmit').disabled = true;
		if (quant >= 100)document.getElementById('quant').style.borderColor = "red";

			//displayNotification("Para mais de 100 encomendas, por favor utiliza o formulário de contacto!");
		else if(teste !== true) displayNotification("Formato incorreto! A quantidade apenas pode ter números inteiros!");
		else if(quant == 0) displayNotification("A quantidade de encomendas tem de ser pelo menos 1!");
		else{
			Custo();
			avaliar_quant = 1;
			ActivateSubmit();

		}
	}
}


function ActivateSubmit(){

	if((avaliar_peso === 1) && (avaliar_dim === 1) && (avaliar_quant === 1)) return true;
	else return false;
}

function Custo(){
	var custo='...';
	var quant = document.getElementById('quant').value;
	var categorias = document.getElementById('limite_peso').value;
	var preco01 = 5;
	var preco12 = 8;
	var preco23 = 10;
	var preco34 = 12;

	var xmlhttp = new XMLHttpRequest();

	if(quant==='' || quant===null) return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(categorias == 1) custo = quant*(preco01);
			else if (categorias == 2) custo = quant*(preco12);
			else if (categorias == 3) custo = quant*(preco23);
			else custo = quant*(preco34);

			if(quant>3) custo = custo - custo*0.15;

			custo = custo.toFixed(2);
		}

		document.getElementById("custo").innerHTML=custo;

	};}
	xmlhttp.open("POST", "encomenda.php", true);
	xmlhttp.send();
	return;
}

function Adicionado(){
	var servico = document.getElementById('limite_peso').value;

	var produto_value = document.getElementById('produto').value;
	var produto = document.getElementById('produto');
	produto = produto.options[produto_value].text;

	var dimensoes = document.getElementById('dim').value;
	var peso = document.getElementById('peso').value;
	var quantidade = document.getElementById('quant').value;

	let ponto = document.getElementById('recolha').checked;
	let armazem =  document.getElementById('armazem').checked;

	let ponto_recolha = 0;

	if(armazem === true)   ponto_recolha = 1;
	else if (ponto === true)   ponto_recolha = 2;

	var recolha_value = document.getElementById('localrecolha').value;
	var recolha = document.getElementById('localrecolha')
	recolha = recolha.options[recolha_value].text;

	var destino_value = document.getElementById('destino').value;
	var destino = document.getElementById('destino')
	destino = destino.options[destino_value].text;


	var custo = document.getElementById("custo").innerHTML;

	var xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			swal({
				title: 'Encomenda adicionada ao carrinho com sucesso!',
				text: "Escolha a página para onde quer ser redirecionado:",
				type: 'success',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#f44336',
				confirmButtonText: 'Carrinho',
				cancelButtonText: 'Nova Encomenda',
				confirmButtonClass: 'btn btn-success',
				cancelButtonClass: 'btn btn-danger',
				buttonsStyling: true
			}).then(function (result) {
			if (result.value)window.location.href = '../carrinho/index.php';
			else if (result.dismiss === 'cancel') window.location.href = 'index.php';
			})
		};
	}

	xmlhttp.open("POST", "../carrinho/adicionar.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

	var message = "servico=" + servico + "&" + "produto=" + produto + "&" +"dimensoes=" + dimensoes + "&"+
				  "peso=" + peso + "&" + "quantidade=" + quantidade + "&" + "recolha=" + recolha + "&" +
				  "destino=" + destino + "&" + "custo=" + custo + "&" + "ponto_recolha=" + ponto_recolha;
	xmlhttp.send(message);
	return;
}

function Recolha(){
  let ponto = document.getElementById('recolha').checked;
  let armazem =  document.getElementById('armazem').checked;
	let xmlhttp = new XMLHttpRequest();

	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
      document.getElementById("ponto_recolha").innerHTML=this.responseText;
		};
	}

	xmlhttp.open("POST", "servicos.php", true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=utf-8");

  if(armazem === true) message = "recolha=" + 1;
  else if (ponto === true) message = "recolha=" + 2;

	xmlhttp.send(message);
	return;
}
