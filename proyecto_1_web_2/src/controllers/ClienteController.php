<?php
namespace App\controllers;

use App\models\bll\ClienteBLL;

class ClienteController
{
    public static function list()
    {
        $clienteBLL = new ClienteBLL();
        $listaCliente = $clienteBLL->selectAll();
        include_once "src/views/clientes/ListarTablaClientes.php";
    }

    public static function create()
    {
        $objCliente = null;
        include_once "src/views/clientes/FormularioClientes.php";
    }

    public static function insert($request)
    {
        $clienteBLL = new ClienteBLL();

        if (isset($request['nombre_completo']) && isset($request['telefono']) && isset($request['carnet']) &&
            isset($request['edad']) && isset($request['sexo'])) {
            $nombres = $request['nombre_completo'];
            $telefono = $request['telefono'];
            $carnet = $request['carnet'];
            $edad = $request['edad'];
            $genero = $request['sexo'];
            $clienteBLL->insert($nombres, $telefono, $carnet, $genero, $edad);
        }
        ClienteController::list();
    }

    public static function edit($id)
    {
        $clienteBLL = new ClienteBLL();
        $objCliente = $clienteBLL->select($id);
        include_once "src/views/clientes/FormularioClientes.php";
    }

    public static function update($request)
    {

        $clienteBLL = new ClienteBLL();

        if (isset($request['nombre_completo']) && isset($request['telefono']) && isset($request['carnet']) &&
            isset($request['edad']) && isset($request['sexo'])){
            $nombres = $request['nombre_completo'];
            $telefono = $request['telefono'];
            $carnet = $request['carnet'];
            $edad = $request['edad'];
            $genero = $request['sexo'];
            $id = $request['id_cliente'];
            $clienteBLL->update($nombres, $telefono,$carnet,$genero,$edad, $id);
            ClienteController::list();
        }

    }

    public static function delete($id)
    {
        $clienteBLL = new ClienteBLL();;
        $clienteBLL->delete($id);
        ClienteController::list();
    }
    
}