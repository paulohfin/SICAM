$(document).ready( function () {
        $("#dataInicioEstagio").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        });       
});

$(document).ready( function () {
        $("#dataFimEstagio").datepicker({
                dateFormat: 'dd/mm/yy',
                dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
                dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
                dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
                monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
                monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
        });       
});


$(document).ready( function($) {

        $("#celular").mask("(999) 9 9999-9999");
        $("#tel1").mask("(999) 9999-9999");  
        $("#cpf").mask("999.999.999-99");
        $("#cep").mask("99.999-999"); 
        $("#uf").mask("aa");
        $("#valor").maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});

});

var inputs = $('input');

function verificarInputsIndex() {
        var preenchidos = true;  
        inputs.each(function () {

                if ($("#cpf").val() == false || $("#nome").val() == false || $("#cep").val() == false || $("#endereco").val() == false || 
                    $("#bairro").val() == false || $("#cidade").val() == false || $("#uf").val() == false || $("#curso").val() == false || 
                    $("#instituicao").val() == false || $("#lotacao").val() == false || $("#valor").val() == false || 
                    $("#supervisor").val() == false || $("#dataInicioEstagio").val() == false || $("#dataInicioFim").val() == false||
                    $("#banco").val() == false || $("#agencia").val() == false || $("#operacao").val() == false || 
                    $("#conta").val() == false) {
                        
                        preenchidos = false;
                        return false;
                }
        });
}
