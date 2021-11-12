import axios from 'axios';
import React, { useEffect, useState } from 'react'
import { Card,Button, Row, Col} from 'react-bootstrap';
import { Link } from 'react-router-dom';
import { useHistory } from 'react-router';

const apiRootPath = 'http://127.0.0.1:8000';

const ListaGeneros = () => {
    const history = useHistory();

    const [listaGenero, setListaGenero] = useState([]);
    const [cargando, setCargando] = useState(false);
    // const [listagenero, setListaGenero] = useState([]);

    useEffect(() => {
        obtenerListaGenero();
    }, []);


    const obtenerListaGenero = () => {
        setCargando(true);
        axios.get(`${apiRootPath}/api/generos`, {  
            
        }).then(response => {
            console.log('response obtenerListaGenero', response.data);
            setListaGenero(response.data);
            setCargando(false);
        }).catch(error => {
            console.log('error', error);
        });
    }

    // const eliminarArtista = (id) => {
    //     const confirmation = window.confirm('¿Está seguro que desea eliminar?');
    //     if (!confirmation) {
    //         return;
    //     }
    //     const urlDelete = apiRootPath + '/artistas/' + id + '/';
    //     axios.delete(urlDelete, {

    //     }).then((response) => {
    //         obtenerListaArtista();
    //     }).catch(error => {
    //         console.log(error);
    //     });

    //     setCargando(true);
    // }

    return <div>
        {cargando === true && <h1>Cargando...</h1>}

        {cargando === false &&

                <Row xs={2} md={5} > 
                    {listaGenero.map(genero =>
                        <Col >
                            <Card style={{ width: '12rem' }}>
                                <Card.Img variant="top" src={apiRootPath+genero.path_imagen_genero} alt={"genero_imagen"+genero.id} />
                                <Card.Body>
                                    <div className="d-grid gap-6">
                                    {/* <Link to="/GeneroArtista">{genero.nombre}</Link> */}
                                    </div>
                                </Card.Body>
                            </Card>
                        </Col>
                    )}
                </Row>
        }
    </div >;
}

export default ListaGeneros;