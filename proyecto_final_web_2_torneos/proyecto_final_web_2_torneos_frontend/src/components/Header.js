import React, { useEffect, useState } from 'react'
import { Container, Nav, Navbar, NavDropdown } from 'react-bootstrap';
import { useDispatch, useSelector } from 'react-redux';
import { Link } from 'react-router-dom';
import { sesionCerrada } from '../redux/loginSlice';
import { useHistory } from 'react-router';
import { usuarioTienePermisos } from '../utils/roleUtils';

const Header = () => {
    const dispatch = useDispatch();
    const history = useHistory();

    const permisos = useSelector(state => state.login.permisos);
    const token = useSelector(state => state.login.token);
    const [permisoMostrarUser, setPermisoMostrarUser] = useState(false);
    const [permisoInsertarUser, setPermisoInsertarUser] = useState(false);
    useEffect(() => {
        if (!token) {
            history.push('/login');
        }
    }, [token])
    useEffect(() => {
        if (!permisos) {
            return;
        }
        if (permisos.length === 0) {
            return;
        }
        setPermisoMostrarUser(usuarioTienePermisos("list user", permisos));
        setPermisoInsertarUser(usuarioTienePermisos("insert user", permisos));

    }, [permisos])
    const cerrarSesion = () => {
        dispatch(sesionCerrada());
    }

    return (
        <Navbar bg="dark" variant="dark" expand="lg">
            <Container>
                <Navbar.Brand href="#home">Ejemplo React</Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                    {token &&
                        <Nav className="me-auto">
                            <Link className="nav-link" to="/">Home</Link>
                            {(permisoInsertarUser || permisoMostrarUser) ? <NavDropdown title="Personas" id="basic-nav-dropdown">
                                {permisoMostrarUser && <Link className="dropdown-item" to="/personas">Lista de Usuario</Link>}
                                {permisoInsertarUser && <Link className="dropdown-item" to="/personas/create">Crear Usuario</Link>}
                            </NavDropdown> : ""}
                            <button className="btn btn-link" onClick={cerrarSesion}>Cerrar sesión</button>
                        </Nav>}
                    {!token && <Nav className="me-auto">
                        <Link className="nav-link" to="/login">Iniciar sesión</Link>
                    </Nav>}
                </Navbar.Collapse>
            </Container>
        </Navbar>


    );
}

export default Header;