<?php


@include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

 
require 'vendor/autoload.php';

// SDK de Mercado Pago
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Resources\Preference;


$access_token = "TEST-748222802926196-101921-365baac5538b96b9213220455e1ff56a-453665710";

// Agrega credenciales
MercadoPagoConfig::setAccessToken($access_token);
$client = new PreferenceClient();
$preference = new Preference();

$carrito_products = array(); // Inicializa un arreglo para los productos

$resultados = mysqli_query($conn, "SELECT * FROM `ordenes` WHERE user_id = '$user_id' AND estado = 'pendiente'") or die('La consulta falló');

while ($row = mysqli_fetch_assoc($resultados)) {
  $total_productos = $row['total_productos'];

  // Utiliza expresiones regulares para extraer los nombres de los productos y las cantidades
  preg_match_all('/(\w+)\s\((\d+)\)\s\((\d+)\)/', $total_productos, $matches, PREG_SET_ORDER);
 
  $precio = $row["precio_total"];

  foreach ($matches as $match) {
    $nombre = $match[1];
    $cantidad = $match[2];
    $precio_unitario = $match[3];

    // Crea un arreglo asociativo con los datos del producto
    $producto = array(
      "nombre" => $nombre,
      "cantidad" => $cantidad,
      "precio"=>$precio_unitario
    );

    $carrito_products[] = $producto; // Agrega cada producto al arreglo de productos
  }
}

$items = array(); // Inicializa un arreglo para los items

foreach ($carrito_products as $producto) {
  $nombre_producto = $producto['nombre'];
  $cantidad_producto = $producto['cantidad'];
  $precio_unitario = $producto['precio'];

  // Crea un arreglo para el item
  $item = array(
    "title" => $nombre_producto,
    "quantity" => intval($cantidad_producto),
    "currency_id" => "ARS",
    // Puedes ajustar la moneda según tus necesidades
    "unit_price" => intval($precio_unitario) // Puedes ajustar el precio unitario según tus necesidades
  );

  $items[] = $item; // Agrega cada producto al arreglo de items
}

$back_urls = array(
  'success' => 'http://localhost/GGFree/ordenes.php',
  'failure' => 'http://localhost/GGFree/ordenes.php',
  'pending' => 'http://localhost/GGFree/ordenes.php'
);


// Crea la preferencia de pago con los items y otros datos
$preference = $client->create([
  "external_reference" => "teste",
  "items" => $items,
  "back_urls" => $back_urls,
  "auto_return" => "approved"
]);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <script src="https://sdk.mercadopago.com/js/v2"></script>
  <title>Página de redireccionamiento</title>
  <style>
    body {
      background-color: #ffffff;
      font-family: sans-serif;
      font-size: 16px;
    }

    h1 {
      text-align: center;
      font-size: 24px;
    }

    p {
      text-align: center;
    }
  </style>
</head>

<body>
  <h1>TE ESTAMOS REDIRIGIENDO A MERCADO PAGO</h1>
  <p>
    CONFIRMA LA COMPRA
  </p>
  <div id="wallet_container">
  </div>
  <script>
    const mp = new MercadoPago('TEST-c8e81243-0181-4011-8fd1-7bc60f4fa1b7', {
      locale: 'es-AR'
    });

    mp.bricks().create("wallet", "wallet_container", {
      initialization: {
        preferenceId: "<?php echo $preference->id?>",
      },
    });
  </script>



</body>

</html>