import axios from "axios";
import React, { useEffect, useState } from "react";
import { Card, Col, Row } from "react-bootstrap";
import { Link } from "react-router-dom";
import { useHistory } from "react-router";

const DetallePelicula = (props) => {
  const { id } = props.match ? props.match.params : { id: 0 };
  const history = useHistory();
  const [nombre, setNombre] = useState("");
  const [año, setAño] = useState(0);
  const [calificacionRotten, setCalificacionRotten] = useState("");
  const [calificacionIMDB, setCalificacionIMDB] = useState("");
  const [director, setDirector] = useState("");
  const [trailer, setTrailer] = useState("");
  const [sinopsis, setSinopsis] = useState("");
  const [calidad, setCalidad] = useState([]);
  const [similares, setSimilares] = useState([]);

  useEffect(() => {
    fetchDatosPelicula(id);
  }, [id]);

  const fetchDatosPelicula = (id) => {
    const url = "http://localhost:8000/api/peliculas/" + id + "/";
    axios
      .get(url)
      .then((response) => {
        const objPelicula = response.data[0];
        setNombre(objPelicula.nombre);
        setAño(objPelicula.año);
        setCalificacionRotten(objPelicula.calificacionRotten);
        setCalificacionIMDB(objPelicula.calificacionIMDB);
        setDirector(objPelicula.director);
        setTrailer(objPelicula.trailer);
        setSinopsis(objPelicula.sinopsis);
        setCalidad(objPelicula.calidad);
        setSimilares(objPelicula.similar);
        console.log(response.data)
      })
      .catch((error) => {
        console.log("error", error);
      });
  };

  const eliminarPelicula = (id) => {
    const confimation = window.confirm("Esta seguro que desea eliminar");
    if (!confimation) return;
    const url = "http://localhost:8000/api/peliculas/" + id + "/";
    axios
      .delete(url)
      .then((response) => {
        history.push("/peliculas")
      })
      .catch((error) => {
        console.log("error", error.response.status);
      });
  };

  return (
    <div>
      {
        <div className="container mt-5">
          <Row sm={3}>
            <div className="card border-0">
              <Card.Img src={"http://127.0.0.1:8000/storage/img/peliculas/" + id + ".jpg"}/>
              <div className="d-flex justify-content-center mt-2">
                <Link className="btn btn-primary" to={"/peliculas/edit/" + id}>
                  Editar
                </Link>
                <button className="btn btn-danger" onClick={() => {eliminarPelicula(id);}}>
                    Eliminar
                </button>
              </div>        
            </div>
            <div className="card border-top-0 border-bottom-0">
              <div className="card-body">
                <div className="card-text">
                  <div className="row mt-2">
                    <div className="col text-info"><p>Nombre:</p></div>
                    <div className="col-8"><p>{nombre}</p></div>
                  </div>
                  <div className="row mt-2">
                    <div className="col text-info"><p>Año:</p></div>
                    <div className="col-8"><p>{año}</p></div>
                  </div>
                  <div className="row mt-2">
                    <div className="col text-info"><p>Director:</p></div>
                    <div className="col-8"><p>{director}</p></div>
                  </div>
                  <div className="row mt-2">
                    <div className="col text-info"><p>IMDB:</p></div>
                    <div className="col-8"><p>{calificacionIMDB}</p></div>
                  </div>
                  <div className="row mt-2">
                    <div className="col text-info"><p>Rotten Tomatoes:</p></div>
                    <div className="col-7"><p>{calificacionRotten}</p></div>
                  </div>
                  <div className="row mt-2">
                    <div className="col text-info"><p>Sinopsis:</p></div>
                    <div className="col-8"><p>{sinopsis}</p></div>
                  </div>
                  <Row sm={2}>
                    {calidad.map((item) => (
                      <Col key={"item-" + item.id}>
                        <Card className="mt-3">                          
                          <Card.Body>
                            <Card.Text>{item.calidad}p</Card.Text>
                          </Card.Body>                      
                        </Card>
                      </Col>
                    ))}
                  </Row>
                </div>
              </div>
            </div>
            <div>
            <h4 className="d-flex justify-content-center text-info">Similares</h4>
            <Row sm={3}>
              {similares.map((item) => (
                <Col key={"item-" + item.id}>
                  <Card className="mt-3 border-5 border-info">
                    <Link to={"/peliculas/"+item.similar_id}>                          
                      <Card.Img src={"http://127.0.0.1:8000/storage/img/peliculas/" + item.similar_id+ ".jpg"}/>                     
                    </Link>
                  </Card>
                </Col>
              ))}
            </Row>
            </div>
          </Row>
          <div className="row">
            <div className="colum mt-5 mb-5">
              <iframe
                width="1350"
                height="528"
                src={trailer}
                title="YouTube video player"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowFullScreen
              ></iframe>
            </div>
          </div>
        </div>
      }
    </div>
  );
};

export default DetallePelicula;
