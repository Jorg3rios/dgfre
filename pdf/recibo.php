<?php
require_once '../dompdf/autoload.inc.php';
 
use Dompdf\Dompdf; //para incluir el namespace de la librería
 

$dompdf = new Dompdf(); //crear el objeto de la clase Dompdf

$nombreImagen = "logo.png";
$imagenBase64 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen));
$nombreImagen2 = "footer.png";
$imagenBase642 = "data:image/png;base64," . base64_encode(file_get_contents($nombreImagen2));
$imagenMarcaAgua = 'fondo.png';
$imagenBase643=  "data:image/png;base64," . base64_encode(file_get_contents($imagenMarcaAgua));
$folio=$_POST['folio'];
$cantidad = $_POST['cantidad'];
$letra=$_POST['letra'];
$unidad = $_POST['unidad'];
$concepto=$_POST['concepto'];
$dia=$_POST['dia'];
$mes=$_POST['mes'];
$year=$_POST['year'];
$procedencia=$_POST['procedencia'];



if($_SERVER["REQUEST_METHOD"] == "POST"){
    $tiposPago = array();
    $cantidades = array();

    $tiposPago = array();
    $cantidades = array();

    for ($i = 1; isset($_POST["tipoPago" . $i]); $i++) {
        $tiposPago[] = $_POST["tipoPago" . $i];
        $cantidades[] = $_POST["cantidad" . $i];
    }

    $codigo = '';
    

    // Inicializa el contenido HTML del PDF
    $html = '<html>
              <head>
                <title>Recibo</title>
              </head>
              <style>
                @font-face{
                  font-family: GothamBook;
                  src: url(../fonts/GothamBook.ttf);
                }
                body{
                  font-family:arial, sans-serif;
                }
                .mini{
                  text-align:right;
                  margin-top:-2cm
                }
                .mini h3{
                  font-size:0.7em;
                }
                .frase{
                  margin-top:-0.3cm;
                  text-align:center;
                  font-size:0.9em;
                  font-weight:bold;
                }
                .principal{
                  font-size:2em;
                  text-align:center;
                }
                .folio{
                  font-size:2em; 
                  text-align:right;
                }
                .cantidad{
                  font-size:1.5em;
                }
                .parrafo{
                  text-align:justify; 
                  font-size: 1em;
                }
                .fecha{
                  text-align:right;
                }
                .recibi{
                  text-align:center;
                  font-size:1.2em;
                }
                .nombre{
                  font-size: .9em;
                  text-align:center;
                  margin-top:-0.5cm;
                }
                .footer{
                  text-align:center; 
                  font-size:0.7em;
                  margin-top:-0.2cm;
                }
                .logo{
                  width: 20cm;
                  margin-left:-5cm; 
                  height: auto;
                }
                table{
                  width: 10cm;
                  margin:0 auto; 
                  border: 1px solid #000;
                  font-size:0.8em;
                }
                th, td {
                  text-align: center;
                  vertical-align: top;
                  border: 1px solid #000;
                  border-collapse: collapse;
                  height: 0.5cm;
                  padding: 0.3em;
                }
                th{
                  background-color: #a6a6a6;
                }
              </style>
              <body>
                <img src="'.$imagenBase64.'" style="display:flex; width:11cm;">
                <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); opacity: 0.09; z-index: -1;">
                  <img src="'.$imagenBase643.'" class="logo">
                </div>
                <div class="mini">
                  <h3><strong>Subsecretaría de Administración y Finanzas</strong><br>Dirección General de Finanzas<br>Departamento de Recursos Financieros Estatales</h3>
                </div><br>
                  <h2 class="frase">"2023. Año del septuagésimo Aniversario del<br>Reconocimiento del Derecho al Voto de las Mujeres de México"</h2>
                  <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));"> 
                  <h1 class="principal">RECIBO</h1>
                  <h1 class="folio">Folio: <span style="color:red">'.$folio.'</span></h1><br>
                  <h1 class="cantidad">BUENO POR: <span style="color-text:red">$'.$cantidad.'</span></h1>
                  <p class="parrafo"> Recibimos de '.$unidad.' '.$procedencia.', la cantidad de $'.$cantidad.' ('.$letra.') por concepto de '.$concepto.'.</p>
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <th colspan="2">Desglose del reintegro:</th>
                    </tr>
                    <tr>
                      <th>Tipo de Pago</th>
                      <th>Cantidad</th>
                    </tr>';
                    $total = 0; // Inicializa la variable para almacenar el total
                    for ($i = 0; $i < count($tiposPago); $i++) {
                    $html .= '<tr>
                      <td>' . $tiposPago[$i] . '</td>
                      <td>$' .number_format($cantidades[$i], 2)  . '</td>
                    </tr>';
                    $total += floatval($cantidades[$i]); 
                    }
                    $html .= '<tr><td style="background-color:#e7e6e4;"><strong>Total:</strong></td><td> $' . number_format($total, 2) . '</td></tr>
                  </table><br>
                  <p class="fecha">Toluca, Estado de México, a '.$dia.' de '.$mes.' de '.$year.'<br><br></p>
                  <p class="recibi">R E C I B I</p><br>
                  <p style="text-align:center;">_______________________________________</p><br>
                  <p class="nombre">L.C. MARIA DEL PILAR SÁNCHEZ ESQUIVEL<br>
                  JEFA DEL DEPARTAMENTO DE RECURSOS FINANCIEROS<br> ESTATALES</p>
                  <br><br><br><br>
                  <h2 style="font-family: Arial, Helvetica, sans-serif; font-size: .9em; color:red;">USUARIO</h2>
                  <footer style="position: fixed; bottom: -0px; left: 0px; right: 0px; height: 70px;">
                    <img src="'.$imagenBase642.'" style="width:19cm; margin-left:-0.3cm;"><br>
                    <h4 class="footer">Lázaro Cárdenas No. 105, 2° piso, Col. La Magdalena San Mateo Otzacatipan, Toluca, Estado de México C.P. 50220. Tel. (722)2264300 ext. 48508 correo electrónico: deptorecursosfinancieros@edugem.gob.mx	</h4>
                  </footer>
                  <div style="page-break-before:always;">
                    <img src="'.$imagenBase64.'" style="display:flex; width:11cm;">
                    
                    <div class="mini">
                      <h3><strong>Subsecretaría de Administración y Finanzas</strong><br>Dirección General de Finanzas<br>Departamento de Recursos Financieros Estatales</h3>
                    </div><br>
                    <h2  class="frase">"2023. Año del septuagésimo Aniversario de<br>Reconocimiento del Derecho al Voto de las Mujeres de México"</h2>
                    <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));"> 
                    <h1 class="principal">RECIBO</h1>
                    <h1 class="folio">Folio: <span style="color:red">'.$folio.'</span></h1><br>
                    <h1 class="cantidad">BUENO POR: <span style="color-text:red">$'.$cantidad.'</span></h1>
                    <p class="parrafo"> Recibimos de '.$unidad.' '.$procedencia.', la cantidad de $'.$cantidad.' ('.$letra.') por concepto de '.$concepto.'.</p>    
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr >
                        <th style="border: 1px solid #000;border-spacing: 0;" colspan="2">Desglose del reintegro:</th>
                      </tr>
                      <tr>
                        <th >Tipo de Pago</th>
                        <th>Cantidad</th>
                      </tr>';
                      $total = 0; // Inicializa la variable para almacenar el total
                      for ($i = 0; $i < count($tiposPago); $i++) {
                      $html .= '<tr>
                        <td>' . $tiposPago[$i] . '</td>
                        <td>$' .number_format($cantidades[$i], 2)  . '</td>
                      </tr>';
                      $total += floatval($cantidades[$i]); 
                      }
                      $html .= '<tr><td style="background-color:#e7e6e4;"><strong>Total:</strong></td><td> $' . number_format($total, 2) . '</td></tr>
                    </table><br>
                    <p class="fecha">Toluca, Estado de México, a '.$dia.' de '.$mes.' de '.$year.'<br><br></p>
                    <p class="recibi">R E C I B I</p><br>
                    <p style="text-align:center;">_______________________________________</p><br>
                    <p class="nombre">L.C. MARIA DEL PILAR SÁNCHEZ ESQUIVEL<br>JEFA DEL DEPARTAMENTO DE RECURSOS FINANCIEROS<br> ESTATALES</p>
                    <br><br><br><br>
                    <h2 style="font-family: Arial, Helvetica, sans-serif; font-size: .9em; color:red;">EXPEDIENTE</h2>
                    
                  </div>
                  <div style="page-break-before:always;">
                  <img src="'.$imagenBase64.'" style="display:flex; width:11cm;">
                    <div class="mini">
                      <h3><strong>Subsecretaría de Administración y Finanzas</strong><br>Dirección General de Finanzas<br>Departamento de Recursos Financieros Estatales</h3>
                    </div><br>
                    <h2 class="frase">"2023. Año del septuagésimo Aniversario de<br>Reconocimiento del Derecho al Voto de las Mujeres de México"</h2>
                    <hr style="border: 0; height: 1px; background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));"> 
                    <h1 class="principal">RECIBO</h1>
                    <h1 class="folio">Folio: <span style="color:red">'.$folio.'</span></h1><br>
                    <h1 class="cantidad">BUENO POR: <span style="color-text:red">$'.$cantidad.'</span></h1>
                    <p class="parrafo"> Recibimos de '.$unidad.' '.$procedencia.', la cantidad de $'.$cantidad.' ('.$letra.') por concepto de '.$concepto.'.</p>
                    <table border="0" cellpadding="0" cellspacing="0">
                      <tr>
                        <th colspan="2">Desglose del reintegro:</th>
                      </tr>
                      <tr>
                        <th>Tipo de Pago</th>
                        <th>Cantidad</th>
                      </tr>';
                      $total = 0; // Inicializa la variable para almacenar el total
                      for ($i = 0; $i < count($tiposPago); $i++) {
                      $html .= '<tr>
                        <td>' . $tiposPago[$i] . '</td>
                        <td>$' .number_format($cantidades[$i], 2)  . '</td>
                      </tr>';
                      $total += floatval($cantidades[$i]); 
                      }
                      $html .= '<tr><td style="background-color:#e7e6e4;"><strong>Total:</strong></td><td> $' . number_format($total, 2) . '</td></tr>
                    </table><br>
                    <p class="fecha">Toluca, Estado de México, a '.$dia.' de '.$mes.' de '.$year.'<br><br></p>
                    <p class="recibi">R E C I B I</p>
                    <br>
                    <p style="text-align:center;">_______________________________________</p><br>
                    <p class="nombre">L.C. MARIA DEL PILAR SÁNCHEZ ESQUIVEL<br>JEFA DEL DEPARTAMENTO DE RECURSOS FINANCIEROS<br> ESTATALES</p>
                    <br><br><br><br>
                    <h2 style="font-family: Arial, Helvetica, sans-serif; font-size: .9em; color:red;">ARCHIVO</h2>
                    </div> 
              </body>
            </html>';
  }

 
// Añadir el HTML a dompdf
$dompdf->loadHtml($html);
        
//Establecer el tamaño de hoja en DOMPDF
$dompdf->setPaper('A4', 'ARIAL');
 
// Renderizar el PDF
$dompdf->render();
 
// Forzar descarga del PDF
$dompdf->stream("Recibo.pdf", array ("Attachment" => 0));
?>