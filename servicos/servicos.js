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
	
	var pattern = new RegExp("^([0-9]+[,.]+[0-9])$");
	var pattern2 = new RegExp("^([0-9])$");
	var teste = pattern.test(peso);
	var teste2 = pattern2.test(peso);
	
	if( teste !== true && teste2 !== true){
		displayNotification("O peso não está no formato correto. Por favor insira neste formato 2 ou 2,3 ou 2.3");
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
		if (quant >= 100) displayNotification("Para mais de 100 encomendas, por favor utiliza o formulário de contacto!");
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
	
	if((avaliar_peso === 1) && (avaliar_dim === 1) && (avaliar_quant === 1)) document.getElementById('btnSubmit').disabled = false;
	return;
}

function Custo(){
	var custo='...';
	var quant = document.getElementById('quant').value;
	var categorias = document.getElementById('limite_peso').value;

	var xmlhttp = new XMLHttpRequest();
	
	if(quant==='' || quant===null) return;
	else{
	xmlhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			if(categorias == 1) custo = quant*(19.99);
			else if (categorias == 2) custo = quant*(29.99);
			else if (categorias == 3) custo = quant*(39.99);
			else custo = quant*(49.99);
			
			if(quant>3) custo = custo - custo*0.15;

		}
		
		document.getElementById("custo").innerHTML=custo;

	};}
	xmlhttp.open("POST", "encomenda.php", true);
	xmlhttp.send();
	return;
}

function Adicionado(){
	swal({
		title: 'Adicionado ao Carrinho Com Sucesso!',
		text: 'Vai ser redirecionado para o carrinho para completar a compra!',
		timer: 1500,
		onOpen: function () {
			swal.showLoading()
		}
	})
	setTimeout(()=>{
		document.getElementById("form").submit();
	},2500)
}