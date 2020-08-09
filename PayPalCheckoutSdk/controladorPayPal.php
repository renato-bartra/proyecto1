<?php

namespace Sample1;

require __DIR__ . '/vendor/autoload.php';
//1. Import the PayPal SDK client that was created in `Set up Server-Side SDK`.
include 'clientePayPal.php';
use Sample1\PayPalClient;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;

class CreateOrder
{

// 2. Set up your server to receive a call from the client
  /**
   *This is the sample function to create an order. It uses the
   *JSON body returned by buildRequestBody() to create an order.
   */
  public static function createOrder($debug=false)
  {
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = self::buildRequestBody();
   // 3. Call PayPal to set up a transaction
    $client = PayPalClient::client();
    $response = $client->execute($request);
    if ($debug)
    {
      print "Status Code: {$response->statusCode}\n";
      print "Status: {$response->result->status}\n";
      print "Order ID: {$response->result->id}\n";
      print "Intent: {$response->result->intent}\n";
      print "Links:\n";
      foreach($response->result->links as $link)
      {
        print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}\n";
      }

      // To print the whole response body, uncomment the following line
      // echo json_encode($response->result, JSON_PRETTY_PRINT);
    }

    // 4. Return a successful response to the client.
    return $response;
  }

  /**
     * Setting up the JSON request body for creating the order with minimum request body. The intent in the
     * request body should be "AUTHORIZE" for authorize intent flow.
     *
     */
    private static function buildRequestBody()
    {
        return array(
            'intent' => 'CAPTURE',
            'application_context' =>
                array(
                    'return_url' => 'http://localhost/proyecto1/modulos/validar-registro.php?estado=true',
                    'cancel_url' => 'http://localhost/proyecto1/modulos/validar-registro.php?estado=false'
                ),
            'purchase_units' =>
                array(
                    0 =>
                        array(
                            'amount' =>
                                array(
                                    'currency_code' => 'USD',
                                    'value' => '220.00'
                                )
                        )
                )
        );
    }
}


/**
 *This is the driver function that invokes the createOrder function to create
 *a sample order.
 */
if (!count(debug_backtrace()))
{
  CreateOrder::createOrder(true);
}

// if(isset($_POST['submit'])){
//     $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
//     $apellido = filter_var($_POST['apellido'], FILTER_SANITIZE_STRING);
//     $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
//     $regalo = filter_var($_POST['regalo'], FILTER_SANITIZE_NUMBER_INT);
//     $total = filter_var($_POST['total_pedido'], FILTER_SANITIZE_STRING);
//     $fecha = date('Y-m-d H:i:s');
//     include_once "../includes/funciones/funciones.php";
//     // Pedidos
//     $camisas = $_POST['pedido_exra']['camisas']['cantidad'];
//     $precioCamisa = $_POST['pedido_exra']['camisas']['precio'];
//     $etiquetas = $_POST['pedido_extra']['etiquetas']['cantidad'];
//     $precioEtiquetas = $_POST['pedido_exra']['etiquetas']['precio'];
//     $boletos = $_POST['boletos'];
//     $pedidos = productos_json($boletos, $camisas, $etiquetas);
//     // Eventos
//     $eventos = $_POST['registro'];
//     $registro = eventos_json($eventos);
//     try {
//         require_once('../includes/funciones/conexion.php');
//         $stmt = $conexion->prepare("INSERT INTO registrados (nomb_registrado, apelli_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, id_regalo, total_pagado) VALUES (?,?,?,?,?,?,?,?)");
//         $stmt->bind_param("ssssssis", $nombre, $apellido, $email, $fecha, $pedidos, $registro, $regalo, $total);
//         $stmt->execute();
//         // echo $stmt->errno . " " . $stmt->error; en caso ocurra un problema
//         $stmt->close();
//         $conexion->close();
//         header('Location: validar-registro.php?done=1');
//     } catch (Exception $e){
//         echo $e->getMessaje();
//     }
    
// }