<?php

namespace APIP2WEB2\models\bll;

use APIP2WEB2\models\conn\Connection;
use APIP2WEB2\models\dto\Pregunta;
use PDO;

class PreguntaBLL
{
    public function selectAll(): array
    {
        $listaDatos = array();
        $objConnection = new Connection();
        $res = $objConnection->query("SELECT * FROM pregunta ORDER BY pregunta.id DESC");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $listaDatos[] = $obj;
        }
        return $listaDatos;
    }

    public function select($id): ?Pregunta
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams("SELECT * FROM pregunta WHERE pregunta.id = :varId",
            array(":varId" => $id));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objCliente = $this->rowToDto($row);

        return $objCliente;
    }


    public function insert(
        string $nombre_persona_que_pregunta,
        string $pregunta

    ): int
    {
        $objConnection = new Connection();

        $res = $objConnection->queryWithParams(
            "INSERT INTO pregunta (nombre_persona_que_pregunta, pregunta, fecha_publicacion)
            VALUES(:varNombrePersonaQuePregunta, :varpregunta, :date)",
            array(
                ":varNombrePersonaQuePregunta" => $nombre_persona_que_pregunta,
                ":varpregunta" => $pregunta,
                ":date" => date('Y-m-d H:i:s')
            )
        );

        if ($res->rowCount() == 0) {
            return 0;
        }

        return $objConnection->getLastInsertedId();
    }

    public function update($id ,$nombre_persona_que_pregunta, $pregunta)
    {
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            "
            UPDATE pregunta
            SET nombre_persona_que_pregunta = :varNombrePersonaQuePregunta,
            pregunta = :varpregunta
            WHERE pregunta.id = :varId",
            array(
                ":varId" => $id,
                ":varNombrePersonaQuePregunta" => $nombre_persona_que_pregunta,
                ":varpregunta" => $pregunta
            )
        );
    }

    public function delete($id)
    {
        $objConnection = new Connection();
        $objConnection->queryWithParams("DELETE FROM pregunta WHERE pregunta.id = :varId",
            array(":varId" => $id)
        );
    }

    private function rowToDto($row): Pregunta
    {
        $objPregunta = new Pregunta();
        $objPregunta->id = ($row['id']);
        $objPregunta->nombre_persona_que_pregunta = ($row['nombre_persona_que_pregunta']);
        $objPregunta->pregunta = ($row['pregunta']);
        $objPregunta->fecha_publicacion = ($row['fecha_publicacion']);
        return $objPregunta;
    }
}