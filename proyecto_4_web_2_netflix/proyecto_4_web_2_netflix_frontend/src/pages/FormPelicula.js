import axios from "axios";
import React, { useState, useEffect } from "react";
import { Card, Col, Row } from "react-bootstrap";
import { useHistory } from "react-router";

const FormPelicula = (props) => {
  const { id } = props.match ? props.match.params : { id: 0 };
  const history = useHistory();
  const [nombre, setNombre] = useState("");
  const [año, setAño] = useState(0);
  const [calificacionRotten, setCalificacionRotten] = useState("");
  const [calificacionIMDB, setCalificacionIMDB] = useState("");
  const [director, setDirector] = useState("");
  const [trailer, setTrailer] = useState("");
  const [sinopsis, setSinopsis] = useState("");
  const [imagen, setImagen] = useState("");
  const [listaCalidad,setListaCalidad] = useState([]);
  const [calidadPelicula] = useState([]);


  useEffect(() => {
    if (id === 0) {
      fetchCalidades()
      return;
    }
    fetchDatosPelicula(id);
  },[id]);

  const fetchDatosPelicula = (id) => {
    const url = "http://localhost:8000/api/peliculas/" + id + "/";
    axios
      .get(url)
      .then((response) => {
        var objPelicula = response.data[0];
        setNombre(objPelicula.nombre);
        setAño(objPelicula.año);
        setCalificacionRotten(objPelicula.calificacionRotten);
        setCalificacionIMDB(objPelicula.calificacionIMDB);
        setDirector(objPelicula.director);
        setTrailer(objPelicula.trailer);
        setSinopsis(objPelicula.sinopsis);
        fetchCalidades()
      })
      .catch((error) => {
        console.log("error", error);
      });
  };

  const fetchCalidades =()=>{
    const url = "http://localhost:8000/api/calidades/";
    axios
      .get(url)
      .then((response) => {
        setListaCalidad(response.data);
      })
      .catch((error) => {
        console.log("error", error);
      });
  }

  const enviarDatos = () => {
    const params = {
      nombre: nombre,
      año: año,
      calificacionRotten: calificacionRotten,
      calificacionIMDB:calificacionIMDB,
      director:director,
      trailer: trailer,
      sinopsis: sinopsis,
    };
    if (id === 0) {
      insertarPelicula(params);
    } else {
      actualizarPelicula(params);
    }
    history.push("/peliculas");
  };
  const insertarPelicula = (params) => {
    const url = "http://localhost:8000/api/peliculas/";
    axios
      .post(url, params)
      .then((response) => {
        enviarImagen(response.data.id);
      })
      .catch((error) => {
        console.log(error);
      });
  };
  const actualizarPelicula = (params) => {
    const url = "http://localhost:8000/api/peliculas/" + id + "/";
    axios
      .put(url, params)
      .then((response) => {
        enviarImagen(response.data.id);
      })
      .catch((error) => {
        console.log(error);
      });
  };

  const enviarImagen = (idPelicula) => {
    const url = "http://localhost:8000/api/peliculas/" + idPelicula + "/imagen";
    const data = new FormData();
    data.append("image", imagen);
    axios
      .post(url, data)
      .then((res) => {
      })
      .catch((error) => {
        console.log(error);
      });
  };


  function onChangeFavorite(event){
    if(event.target.checked){
    calidadPelicula.push(event.target.name)
    }else{
      const index = calidadPelicula.indexOf(event.target.name);
      calidadPelicula.splice(index, 1);
    }
    console.log(calidadPelicula)
  };
  return (
    <Row className="mt-3">
      <Col md={{ span: 6, offset: 3 }}>
        <Card className="mt-3">
          <Card.Body>
            <Card.Title>Formulario de Peliculas</Card.Title>
            <div>
              <label>Nombre:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="text"
                value={nombre}
                onChange={(e) => {
                  setNombre(e.target.value);
                }}
              />
            </div>
            <div className="mt-3">
              <label>Año:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="number"
                value={año}
                onChange={(e) => {
                  setAño(e.target.value);
                }}
              />
            </div>
            <div className="mt-3">
              <label>Rotten Tomatoes:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="text"
                value={calificacionRotten}
                onChange={(e) => {
                  setCalificacionRotten(e.target.value);
                }}
              />
            </div>
            <div className="mt-3">
              <label>IMDB:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="text"
                value={calificacionIMDB}
                onChange={(e) => {
                  setCalificacionIMDB(e.target.value);
                }}
              />
            </div>
            <div className="mt-3">
              <label>Director:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="text"
                value={director}
                onChange={(e) => {
                  setDirector(e.target.value);
                }}
              />
            </div>
            <div className="mt-3">
              <label>Enlace Trailer:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="text"
                value={trailer}
                onChange={(e) => {
                  setTrailer(e.target.value);
                }}
              />
            </div>
            <div className="mt-3">
              <label>Sinopsis:</label>
            </div>
            <div>
              <textarea
                className="form-control"
                value={sinopsis}
                onChange={(e) => {
                  setSinopsis(e.target.value);
                }}
              />
            </div>          
            <div className="mt-3">
              <label>Imagen:</label>
            </div>
            <div>
              <input
                className="form-control"
                type="file"
                onChange={(e) => {
                  setImagen(e.target.files[0]);
                }}
              />
            </div>
            <div className="mt-3">
              <label>Calidad:</label>
            </div>
            <div>
              {listaCalidad.map((itemLista)=>
                  <div  key={"item-" + itemLista.id} className="form-check">
                      <input
                          type="checkbox"
                          className="form-check-input"
                          name={itemLista.id}
                          onChange={onChangeFavorite}
                      />
                      <label className="form-check-label">{itemLista.calidad}</label>
                  </div>
              )}
            </div>
            <button className="btn btn-primary mt-3" onClick={enviarDatos}>
              Guardar
            </button>
          </Card.Body>
        </Card>
      </Col>
    </Row>
  );
};

export default FormPelicula;
