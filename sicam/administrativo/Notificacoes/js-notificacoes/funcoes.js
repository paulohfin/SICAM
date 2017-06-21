
//Função para o Tooltip das consultas na parte de informações
$(function () {
    $('[data-toggle="tooltip"]').tooltip(); 
});


//Função para o Data Table. Organiza a forma como a tabela ordena as consultas.
$(document).ready(function() {
    $('#tabela').DataTable({
    	"bPaginate": true,   //Paginas no rodapé da tabela habilitada
	    "bLengthChange": false,
	    "bFilter": false,
	    "bInfo": true,
	    "bAutoWidth": true,
	    "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json"
        }
    });    
});