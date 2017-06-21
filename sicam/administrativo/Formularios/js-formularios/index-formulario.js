function verificar(){
	if(document.getElementById('cpf').value == ''){
		document.getElementById('cpf').style.borderColor = 'red';
		return false;
	}
}

