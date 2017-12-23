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
var custo_certo = 0;
var avaliar_entrega;


function TransformaPeso(peso){

		var  n = peso.search(',');

		if(n !== -1){
		var partes_peso = peso.split(',');
		peso = partes_peso[0].concat('.', partes_peso[1]);
	}
		return peso;
	//}
}

function VerificaCategoria(){
	var peso = document.getElementById('peso').value;

	if(peso !== ''){
		peso = TransformaPeso(peso);
		if(peso === -1)return;
		else if(peso == 0) {
        document.getElementById("peso_errado").innerHTML="O peso tem de ser maior que 0!";
        document.getElementById('peso').style.borderColor = "#f44336";
    }
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
	var peso_limite_inf = peso_limite - 0.5;
	var peso = document.getElementById('peso').value;
  avaliar_peso = 0;

	if(peso !== ''){
		peso = TransformaPeso(peso);
		if(peso == 0){
        document.getElementById("peso_errado").innerHTML="O peso tem de ser maior que 0!";
        document.getElementById('peso').style.borderColor = "#f44336";
    }
		else if(peso > 2){
        document.getElementById("peso_errado").innerHTML="O peso máximo aceite é de 2kg!";
        document.getElementById('peso').style.borderColor = "#f44336";
    }
		else if( peso > peso_limite){
      document.getElementById("peso_errado").innerHTML=null;
      document.getElementById('peso').style.borderColor = "#ccc";
			displayNotification("Peso inserido é maior que o permitido para a categoria selecionada! O serviço foi reajustado automaticamente!");

			var peso_reaj = Math.round((peso*2)/2);
      if(peso>peso_reaj) peso_reaj = peso_reaj + 0.5;
			document.getElementById('limite_peso').value = peso_reaj;

			avaliar_peso = 1;
			Custo();

		}
		else if( peso <= peso_limite_inf){
      document.getElementById("peso_errado").innerHTML=null;
      document.getElementById('peso').style.borderColor = "#ccc";
			displayNotification("Peso inserido é inferior ao limite da categoria selecionada! O serviço foi reajustado automaticamente!");

			var peso_reaj = Math.round((peso*2)/2);
      if(peso>peso_reaj) peso_reaj = peso_reaj + 0.5;
			document.getElementById('limite_peso').value = peso_reaj;
			avaliar_peso = 1;
			Custo();
		}
		else{
      document.getElementById("peso_errado").innerHTML=null;
      document.getElementById('peso').style.borderColor = "#ccc";
			avaliar_peso = 1;
			Custo();
		}
	}

}

function VerificarDimensao(){
	var dim = document.getElementById('dim').value;
	//var pattern = new RegExp("^([0-9]{1,2})+[x]+([0-9]{1,2})+[x]+([0-9]{1,2})$");
	//var teste = pattern.test(dim);
	var comprimento_max = 22;
	var largura_max= 14;
	var altura_max = 4;
  avaliar_dim = 0;

		var partes_dim = dim.split('x');
		if(partes_dim[0] > comprimento_max){
      document.getElementById("dim_errada").innerHTML="O comprimento inserido é maior do que a máximo(22 cm)!";
      document.getElementById('dim').style.borderColor = "#f44336";
    }
		else if (partes_dim[1] > largura_max){
      document.getElementById("dim_errada").innerHTML="A largura inserida é maior do que a máximo(14 cm)!";
      document.getElementById('dim').style.borderColor = "#f44336";
    }
		else if (partes_dim[2] > altura_max){
      document.getElementById("dim_errada").innerHTML="A altura inserida é maior do que a máximo(4 cm)!";
      document.getElementById('dim').style.borderColor = "#f44336";
    }
		else if(partes_dim[0] == 0){
      document.getElementById("dim_errada").innerHTML="O comprimento inserido tem de ser maior que 0 cm!";
      document.getElementById('dim').style.borderColor = "#f44336";
    }
		else if (partes_dim[1] == 0){
      document.getElementById("dim_errada").innerHTML="A largura inserida tem de ser maior que 0 cm!";
      document.getElementById('dim').style.borderColor = "#f44336";
    }
		else if (partes_dim[2] == 0){
      document.getElementById("dim_errada").innerHTML="A altura inserida tem de ser maior que 0 cm!";
      document.getElementById('dim').style.borderColor = "#f44336";
    }
		else{
        document.getElementById("dim_errada").innerHTML=null;
        document.getElementById('dim').style.borderColor = "#ccc";
			avaliar_dim = 1;
		}
	//}
}

function Quantidade(){
	avaliar_quant = 0;
	var quant = document.getElementById('quant').value;
	var pattern = new RegExp("^([0-9]{1,2})$");
	var teste = pattern.test(quant);

	if(quant != ''){
		if (quant >= 100){
      document.getElementById("quant_errada").innerHTML="Não são permitidas quantidades maiores que 100 por categoria!";
      document.getElementById('quant').style.borderColor = "#f44336";
      avaliar_quant = 0;
    }
		else if(quant == 0){
      document.getElementById("quant_errada").innerHTML="A quantidade de encomendas tem de ser pelo menos 1!";
      document.getElementById('quant').style.borderColor = "#f44336";
      avaliar_quant = 0;
    }
		else{
      document.getElementById("quant_errada").innerHTML=null;
      document.getElementById('quant').style.borderColor = "#ccc";
			Custo();
			avaliar_quant = 1;
		}
	}
}


function MoradaEntrega(){
    avaliar_entrega = 0;

    var recolha_value = document.getElementById('localrecolha');
    var destino = document.getElementById('destino');

    if(recolha_value === null || destino === null) return ;
    else{
      let ponto = document.getElementById('recolha').checked;
    	let armazem =  document.getElementById('armazem').checked;

    	let ponto_recolha = 0;

    	if(armazem === true)   ponto_recolha = 1;
    	else if (ponto === true)   ponto_recolha = 2;

      var recolha_value = document.getElementById('localrecolha').value;
      var destino_value = document.getElementById('destino').value;

      if(recolha_value === '' || destino_value === '' )return;
      else{
      	var recolha = document.getElementById('localrecolha');
      	recolha = recolha.options[recolha_value].text;


      	var destino = document.getElementById('destino');
      	destino = destino.options[destino_value].text;

        if(destino == recolha && ponto_recolha == 2) {
            document.getElementById("morada_errada").innerHTML="O local de destino não pode ser igual ao de recolha!";
            document.getElementById('destino').style.borderColor = "#f44336";
            document.getElementById('localrecolha').style.borderColor = "#f44336";
            return false;
        } else{
            document.getElementById("morada_errada").innerHTML=null;
            document.getElementById('destino').style.borderColor = "#ccc";
            document.getElementById('localrecolha').style.borderColor = "#ccc";
            avaliar_entrega = 1;
            return true;
        }
      }
    }

}

function ActivateSubmit(){

	if((avaliar_peso === 1) && (avaliar_dim === 1) && (avaliar_quant === 1) && (custo_certo === 1 ) && (avaliar_entrega === 1)) return true;
	else return false;
}

function Custo(){
  custo_certo = 0;
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
			if(categorias == 0.5) custo = quant*(preco01);
			else if (categorias == 1) custo = quant*(preco12);
			else if (categorias == 1.5) custo = quant*(preco23);
			else custo = quant*(preco34);

			if(quant>3) custo = custo - custo*0.15;

			custo = custo.toFixed(2);
		}

		document.getElementById("custo").innerHTML=custo;
    custo_certo = 1;

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
	var recolha = document.getElementById('localrecolha');
	recolha = recolha.options[recolha_value].text;

	var destino_value = document.getElementById('destino').value;
	var destino = document.getElementById('destino');
	destino = destino.options[destino_value].text;


      var xmlhttp = new XMLHttpRequest();

      if(ActivateSubmit() === true){
        setTimeout(function(){
          var custo = document.getElementById("custo").innerHTML;
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
        	return;},500);
    } else {
        displayNotification("Por favor corrija os campos assinalados a vermelho!");
        return false;
      }

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
