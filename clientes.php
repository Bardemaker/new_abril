<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Abril</title>

<?php
include "bootstrap.php";
?>

<script>
$(document).ready(function() {
    $('#tab_clientes').DataTable({
    paging: false,
    searching: false,
    "columnDefs": [{targets: [ 3 ], orderSequence: [ "desc", "asc" ]  }],
    "order": [],
    "aoColumns": [{
            "bSortable": true
        },
        {
            "bSortable": true
 
        },
        {
            "bSortable": true
        }
         
        ],
        "bInfo": false
});
} );
</script>

</head>

<body>
<?php
include "conexao.php";

$busca = "SELECT * from cliente ORDER BY idcliente DESC";
$retorna_busca = mysqli_query($db, $busca);

$section = "customers";
include "menu.php";
?>

<div class="container">


<div class="jumbotron">
        <h1>Stoke Control</h1>
        <p>Customers list</p>
      </div>


<button type="button" class="btn btn-primary" onclick="location.href='novo_cliente.php'">New customer</button>



<div class="row">


        <div class="col-md-12">
          <table id="tab_clientes" class="table table-striped">
            <thead>
              <tr>
                <th>Name <span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                <th>email <span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                <th>Phone <span class="glyphicon glyphicon-sort-by-attributes"></span></th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              
<?php

while($retorno = mysqli_fetch_object($retorna_busca))
{		
	echo "<tr><td>" . $retorno->nome . "</td>";
	echo "<td><a href=\"mailto:" . $retorno->email . "\">" . $retorno->email . "</td>";
	echo "<td><span class=\"telefone\">" . $retorno->telefone . "</span></td>";
	echo "<td><a href=\"edit_cliente.php?id=" . $retorno->idcliente . "\" title=\"Edit\"><span class=\"glyphicon glyphicon-edit\"></span></a> | <a href=\"apagar_cliente.php?id=" . $retorno->idcliente . "\" onclick=\"return confirm('Are you sure you want to delete this customer?')\" title=\"Delete\"><span class=\"glyphicon glyphicon-trash\"></span></a></td></tr>";
}
	
	?>
	</tbody>
    </table>
    </div>
        <?php
	

mysqli_free_result($retorna_busca);

?>

</div>
<?php include "footer.php"; ?>
</div>

<script>
  $(document).ready(function(){
  $(".telefone").mask("(99) 99999-9999");

$(".telefone").on("blur", function() {
    var last = $(this).val();

    if( last.length == 11 ) {
        //var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = $(this).val().substr(7, 4);
        var first = $(this).val().substr( 0, 6);

        $(this).val( first + '-' + lastfour );
    }
    if( last.length == 10 ) {
        //var move = $(this).val().substr( $(this).val().indexOf("-") - 1, 1 );
        var lastfour = $(this).val().substr(6, 4);
        var first = $(this).val().substr( 0, 5);

        $(this).val( first + '-' + lastfour );
    }
});
});
</script>
</body>
</html>