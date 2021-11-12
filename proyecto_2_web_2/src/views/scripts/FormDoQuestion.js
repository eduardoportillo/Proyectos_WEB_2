
function insertQuestion(){
    let pregunta = document.getElementById("pregunta");
    let nombre = document.getElementById("nombre");
    let error = document.getElementById("error");
    error.style.color = "#ce1212";

    
    if (pregunta.value === null || pregunta.value === "") {
        error.innerHTML = "Ingresa un Pregunta";
        return;
    }

    if (nombre.value === null || nombre.value === "") {
        error.innerHTML = "Ingresa un nombre";
        return;
    }

    fetch("http://localhost:8080/proyecto_2_web_2/index.php?controller=pregunta&action=store", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
        "nombre_persona_que_pregunta": nombre.value,
        'pregunta': pregunta.value
    }),
  })
    .then((res) => res.json())
    .then((data) => {
      window.location.href = "./../index.html";
    });
      
}