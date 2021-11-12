import React, { useEffect, useState } from "react";
import { Container, Navbar, NavDropdown, Nav, Image } from "react-bootstrap";
import { useDispatch, useSelector } from "react-redux";
import { Link } from "react-router-dom";

const SideBar = () => {
  return (
    <Navbar bg="dark" variant="dark" expand="lg">
    <Container>
        <Navbar.Brand href="/"><Image src="../img/Spotify_Logo_CMYK_White.png"/></Navbar.Brand>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="me-auto">
                    <Link className="nav-link" to="#">Artista</Link>
                    <NavDropdown title="" id="basic-nav-dropdown">
                      <Link className="dropdown-item" to="/artistas">Listar Artistas</Link>
                      <Link className="dropdown-item" to="/artista/create">Crear Artista</Link>
                    </NavDropdown> 

                    <Link className="nav-link" to="#">Canciones</Link>
                    <NavDropdown title="" id="basic-nav-dropdown">
                      <Link className="dropdown-item" to="/canciones">Listar Canciones</Link> {/*//[ ] terminar nav Canciones*/ }
                      <Link className="dropdown-item" to="/canciones/create">Crear Canciones</Link>
                    </NavDropdown> 
                </Nav>
        </Navbar.Collapse>
    </Container>
    </Navbar>
    
  );
};

export default SideBar;
