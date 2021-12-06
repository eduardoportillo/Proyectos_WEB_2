import axios from "axios";
import React, { useEffect, useState } from "react";
import { Card, Col, Container, Row } from "react-bootstrap";
import { Link} from "react-router-dom";

const ListaPelicula = () => {
  const [lista, setLista] = useState([]);

  useEffect(() => {
    obtenerListaPelicula();
  }, []);


  const obtenerListaPelicula = () => {
    axios
      .get("http://127.0.0.1:8000/api/peliculas/")
      .then((response) => {
        console.log("response", response.data);
        setLista(response.data);
      })
      .catch((error) => {
        console.log("error", error);
      });
  };

  return (
    <div>
      {
        <Container>
        <Row md={5}>    
         {lista.map((item) => (         
          <Col key={"item-" + item.id}>
            <Card className="mt-3 border-0">
              <Link to={"/peliculas/"+item.id}> 
                <Card.Img variant="top" src={"http://127.0.0.1:8000/storage/img/peliculas/"+ item.id+".jpg"} />
              </Link>
              <Card.Body>
                <Card.Title className="d-flex justify-content-center">{item.nombre}</Card.Title>     
              </Card.Body>
            </Card>
          </Col>
        ))}
      </Row>
      </Container>
      }
    </div>
  );
};

export default ListaPelicula;
