import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card, Row, Col } from 'react-bootstrap';
import { Link, Button } from 'react-router-dom';
import { useHistory } from 'react-router';
// import { usuarioTienePermisos } from '../utils/roleUtils';

const apiRootPath = 'http://127.0.0.1:8000/';

const ListaArtistas = () => {
    const history = useHistory();

    const [lista, setLista] = useState([]);
    const [cargando, setCargando] = useState(false);
    const [listagenero, setListaGenero] = useState([]);

    useEffect(() => {
        obtenerListaArtista();
    }, []);

    // useEffect(() => {
    //     obtenerListaGeneroArtistas();
    // }, []);

    const obtenerListaArtista = () => {
        setCargando(true);
        axios.get(`${apiRootPath}api/artistas`, {  
            
        }).then(response => {
            console.log('response obtenerListaArtista', response.data);
            setLista(response.data);
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

    const eliminarArtista = (id) => {
        const confirmation = window.confirm('¿Está seguro que desea eliminar?');
        if (!confirmation) {
            return;
        }
        const urlDelete = apiRootPath + 'api/artistas/' + id + '/';
        axios.delete(urlDelete, {

        }).then((response) => {
            obtenerListaArtista();
        }).catch(error => {
            console.log(error);
        });

        setCargando(true);
    }

    return <div>
        {cargando === true && <h1>Cargando...</h1>}

        {cargando === false &&

            <Row xs={2} md={5} > 
            {lista.map(artista =>
                <Col >
                    <Card style={{ width: '12rem' }}>
                        <Card.Img variant="top" src={apiRootPath+artista.path_foto} alt={"artista_imagen"+artista.id} />
                        <Card.Body>
                            <Card.Text>{artista.nombre_artista}</Card.Text>
                            <Card.Text>Genero: {artista.genero_id}</Card.Text>

                            <Link className="btn btn-primary" to={`/artista/edit/${artista.id}`}>Editar</Link>
                            <button className="btn btn-danger" onClick={() => { eliminarArtista(artista.id) }}>Eliminar</button>

                        </Card.Body>
                    </Card>
                </Col>
)}
</Row>
        }
    </div >;
}

export default ListaArtistas;