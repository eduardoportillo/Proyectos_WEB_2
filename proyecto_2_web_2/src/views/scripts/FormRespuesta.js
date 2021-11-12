const urlBase = "http://localhost:8080/proyecto_2_web_2/";

let params = new URLSearchParams(window.location.search);
let pregunta_pertenece = params.get("pregunta_a_la_que_pertenece");

pregunta_pertenece = parseInt(pregunta_pertenece);

function init(){
    
    
    fetch(`${urlBase}index.php?controller=pregunta&action=show&id=${pregunta_pertenece}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        }
    }).then((res) => res.json())
    .then((data) => {
        
        dataPregunta = data;
        let preguntaH1 = document.getElementById("pregunta");
        preguntaH1.innerHTML = `<h1>${dataPregunta.pregunta}</h1>`
    })

    fetch(`${urlBase}index.php?controller=respuesta&action=showbyrelation&pregunta_a_la_que_pertenece=${pregunta_pertenece}`, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        }
        // body: JSON.stringify({ usuario_id: UserAuth.usuario_id })
    }).then((res) => res.json())
    .then((data) => {
        
        dataRespuesta = data;
        let respuestas_div = document.getElementById("respuestas-div");
        let preguntaH1 = document.getElementById("pregunta");

        for (let i = 0; i < dataRespuesta.length; i++) {

            respuestas_div.innerHTML += 
            `<div class="respuesta-users"> 
                <hr>
                <p>${dataRespuesta[i].respuesta}</p>
                <span>pregunta echa por: <strong>${dataRespuesta[i].nombre_persona_que_responde}</strong></span>
                <span> | Fecha: ${dataRespuesta[i].fecha_publicacion}</span>
                <br>
                <br>
            </div>`
        }
    })
}
init();

function insertRespuesta(){
    let nombre = document.getElementById("nombre");
    let respuesta = document.getElementById("respuesta");
    let error = document.getElementById("error");
    error.style.color = "#ce1212";

    if (nombre.value === null || nombre.value === "") {
        error.innerHTML = "Ingresa un nombre";
        return;
    }
    
    if (respuesta.value === null || respuesta.value === "") {
        error.innerHTML = "Ingresa un respuesta";
        return;
    }

    fetch('http://localhost:8080/proyecto_2_web_2/index.php?controller=respuesta&action=store', {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
        'nombre_persona_que_responde': nombre.value,
        'respuesta': respuesta.value,
        'pregunta_a_la_que_pertenece': pregunta_pertenece
    }),
  })
    .then((res) => res.json())
    .then((data) => {
        window.location.reload();
    });

}
