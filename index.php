<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RECIBOS SECRETARÍA DE EDUCACIÓN</title>
    <link rel="shortcut icon" href="pdf/favicon.ico">
    <title>recibos</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var maxCampos = 10; // Cambia esto según tus necesidades
            var campos = 1; // Inicializamos con un campo

            $("#agregarCampo").click(function () {
                if (campos < maxCampos) {
                    campos++;
                    $("#campos").append('<div class="input-group mb-3"><label for="tipoPago' + campos + '"  class="input-group-text">Tipo de Pago ' + campos + ': </label>&nbsp;<input class="form-control" type="text" id="tipoPago' + campos + '" name="tipoPago' + campos + '" required>&nbsp;<label  class="input-group-text" for="cantidad' + campos + '">Cantidad ' + campos + ':</label>&nbsp;<input class="form-control" type="text" id="cantidad' + campos + '" name="cantidad' + campos + '"required></div>');
                }
            });

            $("#quitarCampo").click(function () {
                if (campos > 1) {
                    $("#tipoPago" + campos).parent().remove();
                    campos--;
                }
            });
        });
    </script>
</head>
<body>
    <header>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="../recibos"> <img src="pdf/logo.png" width="450px"  alt=""></a>
   
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="../recibos">Inicio</a>
        </li>
     
       

      </ul>
      
    </div>
  </div>
</nav>
</header>

  
    <br> 
<div class="container-xl">

<div class="card">
<div class="card-header"><h2 class="card-title text-center">RECIBOS</h2></div>
<div class="line"></div>
  <div class="card-body">
  
    
    <p>Llena cada uno de los campos </p>
    <form action="./pdf/recibo.php" method="post" target="_blank">
        
    <div class="input-group mb-3">
   
   <span class="input-group-text">Folio</span>
   <input type="number" class="form-control" placeholder="Folio" id="folio" name="folio" required>
   <span class="input-group-text">Dia</span>
   <input type="number" id="dia" min="1" max="31" class="form-control" placeholder="Día" aria-label="dia" name="dia" required>
   <span class="input-group-text">Mes</span>
       <select id="mes" class="form-control" name="mes" required>
       
       <option value="enero">Enero</option>
       <option value="febrero">Febrero</option>
       <option value="marzo">Marzo</option>
       <option value="abril">Abril</option>
       <option value="mayo">Mayo</option>
       <option value="junio">Junio</option>
       <option value="julio">Julio</option>
       <option value="agosto">Agosto</option>
       <option value="septiembre">Septiembre</option>
       <option value="octubre">Octubre</option>
       <option value="noviembre" selected>Noviembre</option>
       <option value="diciembre">Diciembre</option>
   </select>
   
   <span class="input-group-text">Año</span>
   <select id="year" class="form-control" name="year" required>
       <?php
       // Genera opciones para años (por ejemplo, desde 1900 hasta el año actual)
       $anio_actual = date("Y");
       for ($i = 2000; $i <= $anio_actual; $i++) {
           echo "<option value='$i'>$i</option>";
       }
       ?>
   </select>
  
</div>
    
    <div class="input-group mb-3">
        <label for="unidad" class="input-group-text">Recibimos de:</label>
        <input type="text" class="form-control" class="form-control" placeholder="Ingresar nombre" id="unidad" name="unidad" required >
    </div>
    <div class="input-group mb-3">
        <label for="procedencia" class="input-group-text">Lugar de procedencia:</label>
        <input type="text" class="form-control" class="form-control" placeholder="Ingresar lugar de procedencia" id="procedencia" name="procedencia" required>
    </div>
    <div class=" input-group mb-3">
        <label for="cantidad" class="input-group-text">La cantidad de: $</label>
        <input type="text" class="form-control" class="form-control" placeholder="$0,000" id="cantidad" name="cantidad" required>
    </div>
    <div class=" input-group mb-3">
        <label for="letra" class="input-group-text">La cantidad en letra:</label>
        <input type="text" class="form-control" class="form-control" placeholder="Ingresar monto en letra" id="letra" name="letra" required>
    </div>
    <div class="input-group mb-3">
        <label for="concepto" class="input-group-text">Por concepto de:</label>
        <input type="textarea" class="form-control" class="form-control" placeholder="Ingresar el concepto" id="concepto" name="concepto" required >
    </div>
    <label for="campos" class="form-label">Desglose del Reintegro:</label>
    <div id="campos">
            <div class="input-group mb-3">
                <label for="tipoPago1" class="input-group-text">Tipo de Pago 1:</label>
                <input type="text" id="tipoPago1"  class="form-control" name="tipoPago1" required>
                <label for="cantidad1" class="input-group-text">Cantidad 1:</label>
                <input type="text" id="cantidad1"  class="form-control" name="cantidad1" required>
            </div>
        </div>

        <button type="button" id="agregarCampo">Agregar Campo</button>
        <button type="button" id="quitarCampo">Quitar Campo</button><br><br>


   

    </div>
</div><br>
        <input class="btn btn-primary" type="submit" value="GENERAR RECIBO">
        <a href="/recibos" class="btn btn-danger">limpiar</a>
    </form>
  
</div>
<br><br>
<footer class="bg-light text-center text-lg-start">
  <!-- Copyright -->
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
    © 2023 Copyright:
    <a class="text-dark" <a href="/recibos"">DEPARTAMENTO DE RECURSOS ESTATALES</a>
  </div>
  <!-- Copyright -->
</footer>
</body>
</html>