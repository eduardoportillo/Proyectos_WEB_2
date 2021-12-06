import axios from 'axios';
import moment from 'moment';
import React, { useEffect, useState } from 'react'
import { Card } from 'react-bootstrap';
import { useSelector } from 'react-redux';
import { Link } from 'react-router-dom';
import { useHistory } from 'react-router';
import { usuarioTienePermisos } from '../utils/roleUtils';

const ListaPersonas = () => {
    const token = useSelector(state => state.login.token)
    const permisos = useSelector(state => state.login.permisos);
    const history = useHistory();

    const [lista, setLista] = useState([]);
    const [cargando, setCargando] = useState(false);

    useEffect(() => {
        obtenerListaUser();
    }, []);
    useEffect(() => {
        if (!permisos) {
            return;
        }
        if (permisos.length === 0) {
            history.push('/login');
            return;
        }
        if (!usuarioTienePermisos("mostrar persona", permisos)) {
            history.push('/login');
            return;
        }
    }, [permisos])

    const obtenerListaUser = () => {
        setCargando(true);
        axios.get('http://127.0.0.1:8000/api/user', {
            headers: {
                "Authorization": "Bearer " + token
            }
        }).then(response => {
            console.log('response', response.data);
            setLista(response.data);
            setCargando(false);
        }).catch(error => {
            if (error.response.status === 401) {
                history.push('/login');
            }
        });
    }
    // const eliminarPersona = (id) => {
    //     const confirmation = window.confirm('¿Está seguro que desea eliminar?');
    //     if (!confirmation) {
    //         return;
    //     }
    //     const url = 'http://localhost:8000/api/personas/' + id + '/';
    //     axios.delete(url, {
    //         headers: {
    //             "Authorization": "Bearer " + token
    //         }
    //     }).then((response) => {
    //         obtenerListaUser();
    //     }).catch(error => {
    //         console.log(error);
    //     });
    // }

    return <div>
        {cargando === true && <h1>Cargando...</h1>}
        {cargando === false &&
            <Card className="mt-3">

                <Card.Body>
                    <Card.Title>Lista de Personas</Card.Title>

                    <table className="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>email</th>
                                {usuarioTienePermisos("update user", permisos) && <th></th>}
                                {usuarioTienePermisos("delete user", permisos) && <th></th>}
                            </tr>
                        </thead>
                        <tbody>
                            {lista.map(item =>
                                <tr key={"item-" + item.id}>
                                    <td>{item.id}</td>
                                    <td>{item.name}</td>
                                    <td>{item.last_name}</td>
                                    <td>{item.email}</td>
                                    {usuarioTienePermisos("update user", permisos) &&
                                        <td>
                                            <Link className="btn btn-primary" to={"/personas/edit/" + item.id}>Editar</Link>
                                        </td>
                                    }
                                    {usuarioTienePermisos("delete user", permisos) && <td>
                                        <button className="btn btn-danger" /* onClick={() => { eliminarPersona(item.id) }} */>Eliminar</button>
                                    </td>}
                                </tr>
                            )}


                        </tbody>
                    </table>
                </Card.Body>
            </Card>
        }
    </div >;
}

export default ListaPersonas;