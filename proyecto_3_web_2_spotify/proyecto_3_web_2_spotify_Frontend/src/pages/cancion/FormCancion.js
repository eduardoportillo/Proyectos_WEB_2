import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card, Col, Form, Row } from 'react-bootstrap';
import { useSelector } from 'react-redux';
import { useHistory, Match } from 'react-router';

const apiRootPath = 'http://127.0.0.1:8000/api/';

const FormCancion = (props) => {

    const { id } = props.match ? props.match.params : { id: 0 };
    const history = useHistory();
    
    const [nombreCancion, setNombre] = useState('');
    const [artista, setArtista] = useState('');
    const [archivoAudio, setArchivoAudio] = useState('');
    const [archivoImagen, setArchivoImagen] = useState('');

    const [listaArtistas, setListaArtistas] = useState([]);

    useEffect(() => {
        if (id === 0) {
            return;
        }
        fetchDatosCancion(id);
    }, [id]);

    useEffect(() => {
        getArtistas();
    }, []);

    const fetchDatosCancion = (id) => {
        axios.get(`${apiRootPath}canciones`, {})
        .then((response) => {
            console.log('fetchDatosCancion: ', response);
            const objPersona = response.data;
            setNombre(objPersona.nombre);
            setArtista(objPersona.artista_id);
        }).catch(error => {
            // console.log('error', error);
        });
    }

    const enviarDatos = () => {
        const dataCancion = new FormData();
        dataCancion.append("nombre",nombreCancion);
        dataCancion.append("artista_id", artista);
        dataCancion.append("path_audio", archivoAudio);
        dataCancion.append("path_imagen_cancion", archivoImagen);

        if (id === 0) {
            insertarPersona(dataCancion);
        } else {
            actualizarPersona(dataCancion);
        }
    }

    const insertarPersona = (dataCancion) => {
        axios.post(`${apiRootPath}canciones`, dataCancion, {})
        .then(response => {
            console.log('recibido', response.data);
            history.push('/canciones');
        }).catch(error => {
            console.log(error);
        });
    }

    const actualizarPersona = (dataCancion) => {
        axios.patch(`${apiRootPath}canciones/${id}`, dataCancion, {})
        .then(response => {
            console.log('recibido', response.data);
            history.push('/canciones');
        }).catch(error => {
            console.log(error);
        });
    }

    const getArtistas = () =>{
        axios.get(`${apiRootPath}artistas`,{})
        .then(response => {
            setListaArtistas(response.data);
        }).catch(error => {
            console.log(error);
        });
    }

    return (
        <Row className="mt-3">
            <Col md={{ span: 6, offset: 3 }}>
                <Card className="mt-3">

                    <Card.Body>
                        <Card.Title>Formulario de Cancion</Card.Title>

                        <div><label>Nombres Cancion:</label></div>
                        <div><input className="form-control" type="text" value={nombreCancion} onChange={(e) => {
                            setNombre(e.target.value);
                        }} /></div>
                        <div>
                        </div>

                        <div><label>Imagen Cancion:</label></div>
                        <input className="form-control" type="file" onChange={(e) => {
                            setArchivoImagen(e.target.files[0]);
                        }} accept="image/*"/>

                        <div><label>Audio Cancion:</label></div>
                        <input className="form-control" type="file" onChange={(e) => {
                            setArchivoAudio(e.target.files[0]);
                        }} accept="audio/*"/>

                        <div><label>Artista</label></div>{/* // [ ] falta completar Genero Artista  */}
                        <div>
                            <select className="form-select" value={artista} onChange={(e) => {
                                setArtista(e.currentTarget.value);
                            }}>
                                {listaArtistas.map(item =>
                                    <option value={item.id!="" ? item.id : 1}>{item.nombre_artista}</option>
                                )}
                            </select>

                        </div>
                        <button className="btn btn-primary mt-3" onClick={enviarDatos}>
                            Guardar
                        </button>
                    </Card.Body>
                </Card>
            </Col>
        </Row>
    );

}

export default FormCancion;