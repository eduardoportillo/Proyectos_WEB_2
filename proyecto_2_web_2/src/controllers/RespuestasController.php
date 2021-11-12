<?php

namespace APIP2WEB2\controllers;

use APIP2WEB2\models\bll\PreguntaBLL;
use APIP2WEB2\models\bll\RespuestaBLL;
use APIP2WEB2\utils\ValidationUtils;

class RespuestasController
{
    // mostrar todas las Respuesta
    static function index()
    {
        $respuestaBLL = new RespuestaBLL();
        $lista = $respuestaBLL->selectAll();
        echo json_encode($lista);
    }

    // mostrar respuesta por id
    static function show($id)
    {
        $respuestaBLL = new RespuestaBLL();
        $objRespuesta = $respuestaBLL->select($id);
        if ($objRespuesta == null) {
            http_response_code(404);
            return;
        }
        echo json_encode($objRespuesta);
    }

    //mostrar relacion Pregutna - Respusta
    static  function indexRelation($id){
        $respuestaBLL = new RespuestaBLL();
        $lista = $respuestaBLL->selectRelation($id);
        echo json_encode($lista);
    }

    // Insertar respuesta

    static function store($request)
    {
        if ($request == null) {
            http_response_code(400);
            echo "request mal formado";
            return;
        }
        if (!ValidationUtils::validarRequest($request, 'nombre_persona_que_responde')) {
            return;
        }
        $nombre_persona_que_responde = $request->nombre_persona_que_responde;

        if (!ValidationUtils::validarRequest($request, 'respuesta')) {
            return;
        }
        $respuesta = $request->respuesta;

        if (!ValidationUtils::validarRequest($request, 'pregunta_a_la_que_pertenece')) {
            return;
        }
        $pregunta_a_la_que_pertenece = $request->pregunta_a_la_que_pertenece;

        $respuestaBLL = new RespuestaBLL;
        $id = $respuestaBLL->insert($nombre_persona_que_responde, $respuesta, $pregunta_a_la_que_pertenece);
        $objRespuesta = $respuestaBLL->select($id);
        echo json_encode($objRespuesta);
    }

    // PUT Actualizr todas las columnas de Respuesta
    static function updatePut($request, $id)
    {
        $respuestaBLL = new RespuestaBLL();
        $objRespuesta = $respuestaBLL->select($id);

        if ($objRespuesta == null) {
            http_response_code(404);
            return;
        }

        if ($request == null) {
            http_response_code(400);
            echo "request mal formado";
            return;
        }
        
        if (!ValidationUtils::validarRequest($request, 'nombre_persona_que_responde')) {
            return;
        }
        $nombre_persona_que_responde = $request->nombre_persona_que_responde;

        if (!ValidationUtils::validarRequest($request, 'respuesta')) {
            return;
        }
        $respuesta = $request->respuesta;

        if (!ValidationUtils::validarRequest($request, 'pregunta_a_la_que_pertenece')) {
            return;
        }
        $pregunta_a_la_que_pertenece = $request->pregunta_a_la_que_pertenece;
        
        
        $respuestaBLL->update($id, $nombre_persona_que_responde, $respuesta, $pregunta_a_la_que_pertenece);
        $objRespuesta = $respuestaBLL->select($id);
        echo json_encode($objRespuesta);
    }

    // PATCH Actualizar una columna o varias pero no todas (respuesta)
    static function updatePatch($request, $id)
    {
        $respuestaBLL = new RespuestaBLL();
        $objPregunta = $respuestaBLL->select($id);

        if ($objPregunta == null) {
            http_response_code(404);
            return;
        }

        if ($request == null) {
            http_response_code(400);
            echo "request mal formado";
            return;
        }

        $nombre_persona_que_responde = $objPregunta->nombre_persona_que_responde;

        $respuesta = $objPregunta->respuesta;

        $pregunta_a_la_que_pertenece = $objPregunta->pregunta_a_la_que_pertenece;

        if (property_exists($request, 'nombre_persona_que_responde')) {
            $nombre_persona_que_responde = $request->nombre_persona_que_responde;
        }

        if (property_exists($request, 'respuesta')) {
            $respuesta = $request->respuesta;
        }

        if (property_exists($request, 'pregunta_a_la_que_pertenece')) {
            $pregunta_a_la_que_pertenece = $request->pregunta_a_la_que_pertenece;
        }

        $respuestaBLL = new RespuestaBLL();
        $respuestaBLL->update($id, $nombre_persona_que_responde, $respuesta, $pregunta_a_la_que_pertenece);
        $objPregunta = $respuestaBLL->select($id);
        echo json_encode($objPregunta);
    }

    // Eliminar respuesta por id
    static function destroy($id)
    {
        $respuestaBLL = new RespuestaBLL();
        $obj = $respuestaBLL->select($id);
        if ($obj == null) {
            http_response_code(404);
            return;
        }
        $respuestaBLL->delete($id);
        $respuesta = array(
            "pregunta_data" => $obj,
            "res" => "delete success"
        );
        echo json_encode($respuesta);
    }
}