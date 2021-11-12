
const urlBase = "http://localhost:8080/proyecto_2_web_2/";

function init(){
    

    fetch(urlBase + "index.php?controller=pregunta&action=index", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        }
        // body: JSON.stringify({ usuario_id: UserAuth.usuario_id })
    }).then((res) => res.json())
    .then((data) => {
        
        dataPreguna = data;
        let div_preguntas_principales = document.getElementById("preguntas-principales");

        for (let i = 0; i < dataPreguna.length; i++) {

            div_preguntas_principales.innerHTML += 
            `<div class="preguntas-users"> 
                <h2>
                <a onclick="redirectAnswerHtml(${dataPreguna[i].id})" 
                style=" 
                    cursor: pointer;
                    color: hsl(206,100%,40%);    
                ">${dataPreguna[i].pregunta}</a>
                </h2>
                <span>pregunta echa por: <strong>${dataPreguna[i].nombre_persona_que_pregunta}</strong></span>
                <span>| Fecha: ${dataPreguna[i].fecha_publicacion}</span>
                <br>
                <hr>
            </div>`
        }
    })
}
init();

function redirectAnswerHtml(id){
    window.location.href = "./components/answerPage.html?pregunta_a_la_que_pertenece=" + id;
}