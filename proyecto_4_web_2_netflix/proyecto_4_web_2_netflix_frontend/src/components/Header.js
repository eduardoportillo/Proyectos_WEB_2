import React from "react";
import { Container, Form, FormControl, Nav, Navbar, NavDropdown } from "react-bootstrap";
import { Link } from "react-router-dom";

const Header = () => {
  return (
    <Navbar bg="dark" variant="dark" expand="lg">
    <Container>
        <div className="justify-content-center" ><h2 className="m-0 text-info">YTS</h2></div>
        <Navbar.Toggle aria-controls="basic-navbar-nav" />
        <Navbar.Collapse id="basic-navbar-nav">
            <Nav className="me-auto">
                <NavDropdown title="Crear" id="basic-nav-dropdown">
                    <Link className="nav-link" to="/peliculas/create">Crear Pelicula</Link>
                </NavDropdown>
                    <Link className="nav-link" to="/">Browse Movies</Link>
            </Nav>
            <Form className="d-flex">
              <FormControl
                type="search"
                placeholder="Search"
                className="me-2"
                aria-label="Search"
              />
            <button className="btn btn-outline-success">Search</button>
            </Form>
        </Navbar.Collapse>
    </Container>
  </Navbar>
  );
};
export default Header;
