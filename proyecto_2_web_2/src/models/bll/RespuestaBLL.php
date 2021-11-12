<?php

namespace APIP2WEB2\models\bll;

use APIP2WEB2\models\conn\Connection;
use APIP2WEB2\models\dto\Respuestas;
use PDO;

class RespuestaBLL
{
    public function selectAll(): array
    {
        $listaDatos = array();
        $objConnection = new Connection();
        $res = $objConnection->query("SELECT * FROM respuestas ORDER BY respuestas.id DESC");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $listaDatos[] = $obj;
        }
        return $listaDatos;
    }

    public function select($id): ?Respuestas
    {
        $objConnection = new Connection();
        $res = $objConnection->queryWithParams("SELECT * FROM respuestas WHERE respuestas.id = :varId",
            array(":varId" => $id));
        if ($res->rowCount() == 0) {
            return null;
        }
        $row = $res->fetch(PDO::FETCH_ASSOC);
        $objRespuestas = $this->rowToDto($row);

        return $objRespuestas;
    }

    public function selectRelation($idPregunta): array{

        $listaDatos = array();
        $objConnection = new Connection();
            $res = $objConnection->query("SELECT r.id, nombre_persona_que_responde, respuesta, pregunta_a_la_que_pertenece, r.fecha_publicacion FROM pregunta join respuestas r on pregunta.id = r.pregunta_a_la_que_pertenece where pregunta.id = $idPregunta");
        while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
            $obj = $this->rowToDto($row);
            $listaDatos[] = $obj;
        }
        return $listaDatos;
    }

    public function insert(
        string $nombre_persona_que_responde,
        string $respuestas,
        int $pregunta_a_la_que_pertenece

    ): int
    {
        $objConnection = new Connection();

        $res = $objConnection->queryWithParams(
            "INSERT INTO respuestas (nombre_persona_que_responde,respuesta, pregunta_a_la_que_pertenece, fecha_publicacion)
            VALUES(:varnombre_persona_que_responde, :varrespuestas, :varpregunta_a_la_que_pertenece, :date)",
            array(
                ":varnombre_persona_que_responde" => $nombre_persona_que_responde,
                ":varrespuestas" => $respuestas,
                ":varpregunta_a_la_que_pertenece" => $pregunta_a_la_que_pertenece,
                ":date" => date('Y-m-d H:i:s')
            )
        );

        if ($res->rowCount() == 0) {
            return 0;
        }

        return $objConnection->getLastInsertedId();
    }

    public function update($id ,$nombre_persona_que_responde, $respuesta, $pregunta_a_la_que_pertenece)
    {
        $objConnection = new Connection();
        $objConnection->queryWithParams(
            "
            UPDATE respuestas
            SET nombre_persona_que_responde = :varnombre_persona_que_responde,
            respuesta = :varrespuestas,
            pregunta_a_la_que_pertenece = :pregunta_a_la_que_pertenece
            WHERE respuestas.id = :varId",
            array(
                ":varId" => $id,
                ":varnombre_persona_que_responde" => $nombre_persona_que_responde,
                ":varrespuestas" => $respuesta,
                ":pregunta_a_la_que_pertenece" => $pregunta_a_la_que_pertenece

            )
        );
    }

    public function delete($id)
    {
        $objConnection = new Connection();
        $objConnection->queryWithParams("DELETE FROM respuestas WHERE respuestas.id = :varId",
            array(":varId" => $id)
        );
    }

    private function rowToDto($row): Respuestas
    {
        $objRespuestas = new Respuestas();
        $objRespuestas->id = ($row['id']);
        $objRespuestas->nombre_persona_que_responde = ($row['nombre_persona_que_responde']);
        $objRespuestas->respuesta = ($row['respuesta']);
        $objRespuestas->pregunta_a_la_que_pertenece = ($row['pregunta_a_la_que_pertenece']);
        $objRespuestas->fecha_publicacion = ($row['fecha_publicacion']);
        return $objRespuestas;
    }
}