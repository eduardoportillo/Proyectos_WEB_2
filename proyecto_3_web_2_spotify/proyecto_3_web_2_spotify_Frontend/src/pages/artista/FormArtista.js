import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card, Col, Form, Row } from 'react-bootstrap';
import { useSelector } from 'react-redux';
import { useHistory, Match } from 'react-router';

const apiRootPath = 'http://127.0.0.1:8000/api/';

const FormArtista = (props) => {

    const { id } = props.match ? props.match.params : { id: 0 };
    const history = useHistory();
    
    const [nombreArtista, setNombre] = useState('');
    const [genero, setGenero] = useState('');
    const [archivo, setArchivo] = useState('');

    const [listaGenero, setListaGenero] = useState([]);

    useEffect(() => {
        if (id === 0) {
            return;
        }
        fetchDatosArtistas(id);
    }, [id]);

    useEffect(() => {
        getGeneros();
    }, []);

    const fetchDatosArtistas = (id) => {
        axios.get(`${apiRootPath}artistas`, {})
        .then((response) => {
            console.log('fetchDatosPersona: ', response);
            const objPersona = response.data;
            setNombre(objPersona.nombre_artista);
            setGenero(objPersona.genero_id);
        }).catch(error => {
            // console.log('error', error);
        });
    }

    const enviarDatos = () => {
        const dataArtista = new FormData();
        dataArtista.append("nombre_artista",nombreArtista);
        dataArtista.append("genero_id", genero);
        dataArtista.append("imagen_artista", archivo);

        if (id === 0) {
            insertarPersona(dataArtista);
        } else {
            actualizarPersona(dataArtista);
        }
    }

    const insertarPersona = (dataArtista) => {
        axios.post(`${apiRootPath}artistas`, dataArtista, {})
        .then(response => {
            console.log('recibido', response.data);
            history.push('/artistas');
        }).catch(error => {
            console.log(error);
        });
    }

    const actualizarPersona = (dataArtista) => {
        axios.patch(`${apiRootPath}artistas/${id}`, dataArtista, {})
        .then(response => {
            console.log('recibido', response.data);
            history.push('/artistas');
        }).catch(error => {
            console.log(error);
        });
    }

    const getGeneros = () =>{
        axios.get(`${apiRootPath}generos`,{})
        .then(response => {
            setListaGenero(response.data);
        }).catch(error => {
            console.log(error);
        });
    }

    return (
        <Row className="mt-3">
            <Col md={{ span: 6, offset: 3 }}>
                <Card className="mt-3">

                    <Card.Body>
                        <Card.Title>Formulario de Personas</Card.Title>

                        <div><label>Nombres Artista:</label></div>
                        <div><input className="form-control" type="text" value={nombreArtista} onChange={(e) => {
                            setNombre(e.target.value);
                        }} /></div>
                        <div>
                        </div>

                        <div><label>Imagen Artista:</label></div>
                        <input className="form-control" type="file" onChange={(e) => {
                            setArchivo(e.target.files[0]);
                        }} />

                        <div><label>Género Musical:</label></div>{/* // [ ] falta completar Genero musical  */}
                        <div>
                            <select className="form-select" value={genero} onChange={(e) => {
                                setGenero(e.currentTarget.value);
                            }}>
                                {listaGenero.map(item =>
                                    <option value={item.id!="" ? item.id : 1}>{item.nombre_genero}</option>
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

export default FormArtista;