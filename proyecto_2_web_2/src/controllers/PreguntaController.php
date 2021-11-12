<?php

namespace APIP2WEB2\controllers;

use APIP2WEB2\models\bll\PreguntaBLL;
use APIP2WEB2\utils\ValidationUtils;

class PreguntaController
{
    // mostrar todas las preguntas
    static function index()
    {
        $preguntaBLL = new PreguntaBLL();
        $lista = $preguntaBLL->selectAll();
        echo json_encode($lista);
    }

    // mostrar pregunta por id
    static function show($id)
    {
        $preguntaBLL = new PreguntaBLL();
        $objPregunta = $preguntaBLL->select($id);
        if ($objPregunta == null) {
            http_response_code(404);
            return;
        }
        echo json_encode($objPregunta);
    }

    // Insertar pregunta

    static function store($request)
    {
        if ($request == null) {
            http_response_code(400);
            echo "request mal formado";
            return;
        }

        if (!ValidationUtils::validarRequest($request, 'nombre_persona_que_pregunta')) {
            return;
        }
        $nombre_persona_que_pregunta = $request->nombre_persona_que_pregunta;

        if (!ValidationUtils::validarRequest($request, 'pregunta')) {
            return;
        }
        $pregunta = $request->pregunta;

        $preguntaBLL = new PreguntaBLL();
        $id = $preguntaBLL->insert($nombre_persona_que_pregunta, $pregunta);
        $objPregunta = $preguntaBLL->select($id);
        echo json_encode($objPregunta);
    }

    // PUT Actualizr todas las columnas de preguntas
    static function updatePut($request, $id)
    {
        $preguntaBLL = new PreguntaBLL();
        $objPregunta = $preguntaBLL->select($id);

        if ($objPregunta == null) {
            http_response_code(404);
            return;
        }

        if ($request == null) {
            http_response_code(400);
            echo "request mal formado";
            return;
        }
        if (!ValidationUtils::validarRequest($request, 'nombre_persona_que_pregunta')) {
            return;
        }
        $nombre_persona_que_pregunta = $request->nombre_persona_que_pregunta;

        if (!ValidationUtils::validarRequest($request, 'pregunta')) {
            return;
        }
        $pregunta = $request->pregunta;

        $preguntaBLL = new PreguntaBLL();

        $preguntaBLL->update($id, $nombre_persona_que_pregunta, $pregunta);
        $objPregunta = $preguntaBLL->select($id);
        echo json_encode($objPregunta);
    }

    // PATCH Actualizar una columna o varias pero no todas de pregunta
    static function updatePatch($request, $id)
    {
        $preguntaBLL = new PreguntaBLL();
        $objPregunta = $preguntaBLL->select($id);

        if ($objPregunta == null) {
            http_response_code(404);
            return;
        }
        if ($request == null) {
            http_response_code(400);
            echo "request mal formado";
            return;
        }
        $nombre_persona_que_pregunta = $objPregunta->nombre_persona_que_pregunta;
        $pregunta = $objPregunta->pregunta;

        if (property_exists($request, 'nombre_persona_que_pregunta')) {
            $nombre_persona_que_pregunta = $request->nombre_persona_que_pregunta;
        }

        if (property_exists($request, 'pregunta')) {
            $pregunta = $request->pregunta;
        }

        $preguntaBLL = new PreguntaBLL();
        $preguntaBLL->update($id, $nombre_persona_que_pregunta, $pregunta);
        $objPregunta = $preguntaBLL->select($id);
        echo json_encode($objPregunta);
    }

    // Eliminar pregunta por id
    static function destroy($id)
    {
        $preguntaBLL = new PreguntaBLL();
        $obj = $preguntaBLL->select($id);
        if ($obj == null) {
            http_response_code(404);
            return;
        }
        $preguntaBLL->delete($id);
        $respuesta = array(
            "pregunta_data" => $obj,
            "res" => "success"
        );
        echo json_encode($respuesta);
    }

}