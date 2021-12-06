import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card, Col, Form, Row } from 'react-bootstrap';
import { useSelector } from 'react-redux';
import { useHistory } from 'react-router';
import { usuarioTienePermisos } from '../utils/roleUtils';
const FormPersona = (props) => {
    const token = useSelector(state => state.login.token)
    const permisos = useSelector(state => state.login.permisos);

    const { id } = props.match ? props.match.params : { id: 0 };
    const history = useHistory();

    const [nombres, setNombres] = useState('');
    const [apellidos, setApellidos] = useState('');
    const [ciudad, setCiudad] = useState('');
    const [edad, setEdad] = useState(0);
    const [genero, setGenero] = useState(0);
    const [fechaNacimiento, setFechaNacimiento] = useState('');

    useEffect(() => {
        if (id === 0) {
            return;
        }
        fetchDatosPersona(id);
    }, [id]);
    useEffect(() => {
        if (!permisos) {
            return;
        }
        if (permisos.length === 0) {
            history.push('/login');
            return;
        }
        if (!usuarioTienePermisos("crear persona", permisos) && !usuarioTienePermisos("actualizar persona", permisos)) {
            history.push('/login');
            return;
        }
    }, [permisos])
    const fetchDatosPersona = (id) => {

        const url = 'http://localhost:8000/api/personas/' + id + '/';
        axios.get(url, {
            headers: {
                "Authorization": "Bearer " + token
            }
        })
            .then((response) => {
                console.log('fetchDatosPersona', response);
                const objPersona = response.data;
                setNombres(objPersona.nombres);
                setApellidos(objPersona.apellidos);
                setEdad(objPersona.edad);
                setFechaNacimiento(objPersona.fechaNacimiento);
                setGenero(objPersona.genero);
                setCiudad(objPersona.ciudad);
            }).catch(error => {
                // console.log('error', error);
                if (error.response.status === 401) {
                    history.push('/login');
                }
            });
    }

    const enviarDatos = () => {

        const params = {
            "nombres": nombres,
            "apellidos": apellidos,
            "ciudad": ciudad,
            "edad": edad,
            "genero": genero,
            "fechaNacimiento": fechaNacimiento
        };
        if (id === 0) {
            insertarPersona(params);
        } else {
            actualizarPersona(params);
        }
    }
    const insertarPersona = (params) => {
        if (!usuarioTienePermisos("insertar persona", permisos)) {
            alert('Ud no tiene permisos para realizar esta función');
            return;
        }
        const url = 'http://localhost:8000/api/personas/';
        axios.post(url, params, {
            headers: {
                "Authorization": "Bearer " + token
            }
        }).then(response => {
            console.log('recibido', response.data);
            history.push('/personas');
        }).catch(error => {
            console.log(error);
            if (error.response.status === 401) {
                history.push('/login');
            }
        });
    }
    const actualizarPersona = (params) => {
        if (!usuarioTienePermisos("actualizar persona", permisos)) {
            alert('Ud no tiene permisos para realizar esta función');
            return;
        }
        const url = 'http://localhost:8000/api/personas/' + id + '/';
        axios.put(url, params, {
            headers: {
                "Authorization": "Bearer " + token
            }
        }).then(response => {
            console.log('recibido', response.data);
            history.push('/personas');
        }).catch(error => {
            console.log(error);
            if (error.response.status === 401) {
                history.push('/login');
            }
        });
    }
    return (
        <Row className="mt-3">
            <Col md={{ span: 6, offset: 3 }}>
                <Card className="mt-3">

                    <Card.Body>
                        <Card.Title>Formulario de Personas</Card.Title>

                        <div><label>Nombres:</label></div>
                        <div><input className="form-control" type="text" value={nombres} onChange={(e) => {
                            setNombres(e.target.value);
                        }} /></div>
                        <div>
                            {nombres.length} caracteres
                        </div>
                        <div><label>Apellidos:</label></div>
                        <div><input className="form-control" type="text" value={apellidos} onChange={(e) => {
                            setApellidos(e.target.value);
                        }} /></div>
                        <div><label>Ciudad:</label></div>
                        <div><input className="form-control" type="text" value={ciudad} onChange={(e) => {
                            setCiudad(e.target.value);
                        }} /></div>
                        <div><label>Edad:</label></div>
                        <div><input className="form-control" type="number" value={edad} onChange={(e) => {
                            setEdad(e.target.value);
                        }} /></div>
                        <div><label>Fecha de Nacimiento:</label></div>
                        <div><input className="form-control" type="date" value={fechaNacimiento} onChange={(e) => {
                            setFechaNacimiento(e.target.value);
                        }} /></div>
                        <div><label>Género:</label></div>
                        <div>
                            <select className="form-select" value={genero} onChange={(e) => {
                                setGenero(e.currentTarget.value);
                            }}>
                                <option value="1">Masculino</option>
                                <option value="0">Femenino</option>
                                <option value="-1">Otro</option>
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

export default FormPersona;