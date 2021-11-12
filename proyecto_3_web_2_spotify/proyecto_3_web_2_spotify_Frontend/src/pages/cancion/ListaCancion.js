import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card, Row, Col } from 'react-bootstrap';
import { Link, Button } from 'react-router-dom';
import { useHistory } from 'react-router';
// import { usuarioTienePermisos } from '../utils/roleUtils';

const apiRootPath = 'http://127.0.0.1:8000';

const ListaCancion = () => {
    const history = useHistory();

    const [listaCancion, setListaCancion] = useState([]);
    const [cargando, setCargando] = useState(false);
    // const [listagenero, setListaGenero] = useState([]);

    useEffect(() => {
        obtenerListaCancion();
    }, []);

    // useEffect(() => {
    //     obtenerListaGeneroArtistas();
    // }, []);

    const obtenerListaCancion = () => {
        setCargando(true);
        axios.get(`${apiRootPath}/api/canciones`, {  
            
        }).then(response => {
            console.log('response obtenerListaCancion', response.data);
            setListaCancion(response.data);
            setCargando(false);
        }).catch(error => {
            console.log('error', error);
        });
    }

    // const obtenerListaGeneroArtistas = (id_artista) => { // [ ] Falta implementar obtenerListaGeneroArtistas
    //     setCargando(true);

    //     axios.get(`${apiRootPathapi/}artistas/relacionartistagenero/${id_artista}`, {   
    //     }).then(response => {
    //         console.log('response obtenerListaGeneroArtistas', response.data);
    //         setListaGenero(response.data);
    //         setCargando(false);
    //     }).catch(error => {
    //         // console.log('error', error);
    //     });

    //     listagenero.map(genero =>console.log(genero))
    // }

    const eliminarCancion = (id) => {
        const confirmation = window.confirm('¿Está seguro que desea eliminar?');
        if (!confirmation) {
            return;
        }
        const urlDelete = apiRootPath + '/api/canciones/' + id + '/';
        axios.delete(urlDelete, {

        }).then((response) => {
            obtenerListaCancion();
        }).catch(error => {
            console.log(error);
        });
        
        setCargando(true);
    }

    return <div>
        {cargando === true && <h1>Cargando...</h1>}

        {cargando === false &&

            <Row xs={3} md={10} > 
            {listaCancion.map(cancion =>
                <Col >
                    <Card style={{ width: '20rem' }}>
                        <Card.Img variant="top" src={apiRootPath+"/"+cancion.path_imagen_cancion} alt={"cancion_imagen"+cancion.id} />
                        <Card.Body>
                            <Card.Text>{cancion.nombre}</Card.Text>
                            <Card.Text>Artista: {cancion.artista_id}</Card.Text>
                            <audio src={apiRootPath+"/"+cancion.path_audio} controls/>
                            <Link className="btn btn-primary" to={`/artista/edit/${cancion.id}`}>Editar</Link>
                            <button className="btn btn-danger" onClick={() => { eliminarCancion(cancion.id) }}>Eliminar</button>

                        </Card.Body>
                    </Card>
                </Col>
)}
</Row>
        }
    </div >;
}

export default ListaCancion;