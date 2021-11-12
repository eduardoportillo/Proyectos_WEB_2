import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card,Button, Row, Col} from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { useHistory } from 'react-router';

const apiRootPath = 'http://127.0.0.1:8000';

const ListarGeneroArtista = () => {
    const history = useHistory();

    const [listaGeneroArtista, setListaGeneroArtista] = useState([]);
    const [cargando, setCargando] = useState(false);
    // const [listagenero, setListaGeneroArtista] = useState([]);

    useEffect(() => {
        obtenerListaGenero();
    }, []);


    const obtenerListaGenero = () => {
        setCargando(true);
        axios.get(`${apiRootPath}/api/generos`, {  
            
        }).then(response => {
            console.log('response obtenerListaGenero', response.data);
            setListaGeneroArtista(response.data);
            setCargando(false);
        }).catch(error => {
            console.log('error', error);
        });
    }

    return <div>
        {cargando === true && <h1>Cargando...</h1>}

        {cargando === false &&

    <Row xs={2} md={5} > 
        {listaGeneroArtista.map(item =>
        <Col >
            <Card style={{ width: '12rem' }}>
                <Card.Img variant="top" src={apiRootPath+item.path_foto} alt={"artista_imagen"+item.id} />
                <Card.Body>
                <Card.Text>{item.nombre_artista}</Card.Text>
                <Card.Text>Genero: {item.genero_id}</Card.Text>

                {/* <Link className="btn btn-primary" to={`/item/edit/${item.id}`}>Editar</Link> */}
                {/* <button className="btn btn-danger" onClick={() => { eliminarArtista(item.id) }}>Eliminar</button> */}

                </Card.Body>
            </Card>
        </Col>
        )}
    </Row>
        }
    </div >;
}

export default ListarGeneroArtista;