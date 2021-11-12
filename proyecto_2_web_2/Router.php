<?php
use APIP2WEB2\controllers\PreguntaController;
use APIP2WEB2\controllers\RespuestasController;

$controller = "pregunta";
if (isset($_REQUEST['controller'])) {
    $controller = $_REQUEST['controller'];
}

$action = "index";
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
}

switch ($controller) {
    case "pregunta":
        switch ($action) {
            case "index":
                if ($_SERVER["REQUEST_METHOD"] !== "GET") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                PreguntaController::index();
                break;
            case "show":
                if ($_SERVER["REQUEST_METHOD"] !== "GET") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                PreguntaController::show($_GET['id']);
                break;
            case "store":
                if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                $body = json_decode(file_get_contents("php://input"));
                PreguntaController::store($body);
                break;
            case "update":
                $body = json_decode(file_get_contents("php://input"));
                if ($_SERVER["REQUEST_METHOD"] === "PUT") {
                    PreguntaController::updatePut($body, $_GET['id']);
                    return;
                }
                if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
                    PreguntaController::updatePatch($body, $_GET['id']);
                    return;
                }
                http_response_code(405);
                echo "bad method";
                break;
            case "destroy":
                if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                PreguntaController::destroy($_GET['id']);
                break;
        }
        break;
    case "respuesta":
        switch ($action) {
            case "index":
                if ($_SERVER["REQUEST_METHOD"] !== "GET") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                RespuestasController::index();
                break;
            case "show":
                if ($_SERVER["REQUEST_METHOD"] !== "GET") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                RespuestasController::show($_GET['id']);
                break;
            case "showbyrelation":
                if ($_SERVER["REQUEST_METHOD"] !== "GET") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                RespuestasController::indexRelation($_GET['pregunta_a_la_que_pertenece']);
                break;
            case "store":
                if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                $body = json_decode(file_get_contents("php://input"));
                RespuestasController::store($body);
                break;
            case "update":
                $body = json_decode(file_get_contents("php://input"));
                if ($_SERVER["REQUEST_METHOD"] === "PUT") {
                    RespuestasController::updatePut($body, $_GET['id']);
                    return;
                }
                if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
                    RespuestasController::updatePatch($body, $_GET['id']);
                    return;
                }
                http_response_code(405);
                echo "bad method";
                break;
            case "destroy":
                if ($_SERVER["REQUEST_METHOD"] !== "DELETE") {
                    http_response_code(405);
                    echo "bad method";
                    return;
                }
                RespuestasController::destroy($_GET['id']);
                break;
        }
        break;
}

