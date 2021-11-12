
let id;

function init(){
    fetch("http://localhost:8080/proyecto_2_web_2/index.php?controller=pregunta&action=index", {
    method: "GET",
        headers: {
      "Content-Type": "application/json",
        }
    })
     .then((res) => res.json())
     .then((data) => {

      dataPreguntas = data;

      for (let i = 0; i < dataPreguntas.length; i++) {
        let contenido_moderador = document.getElementById('contenido-moderador');

        contenido_moderador.innerHTML +=
        `
        <TR>
		    <TD>${dataPreguntas[i].id}</TD>
            <TD>${dataPreguntas[i].nombre_persona_que_pregunta}</TD>
            <TD>${dataPreguntas[i].pregunta}</TD>
            <TD>${dataPreguntas[i].fecha_publicacion}</TD>
            <TD><a href="#" onclick="clickeliminar(${dataPreguntas[i].id})" class="button" style="cursor: pointer;">Eliminar</a></TD>
	    </TR>
        `;
      }

    })
  }

init();

function clickeliminar(key) {
    fetch("http://localhost:8080/proyecto_2_web_2/index.php?controller=pregunta&action=destroy&id="+key, {
      method: "DELETE",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        id: key
      }),
    })
      .then((res) => res.json())
      .then((data) => {
        window.location.reload();
      });
  }