import React from 'react'
import { Route, Switch } from 'react-router';
import FormArtista from '../pages/artista/FormArtista';
import ListaArtista from '../pages/artista/ListaArtista';
import ListaCancion from '../pages/cancion/ListaCancion';
import FormCancion from '../pages/cancion/FormCancion';
import ListaGeneros from '../pages/genero/ListaGenero';
import ListaGeneroArtista from '../pages/ListarGeneroArtista';
// import Login from '../pages/Login';
const RouterConfig = () => {
    return (
        <Switch>
            <Route path="/" exact>
                <ListaGeneros />
            </Route>

            <Route path="/artistas" exact>
                <ListaArtista />
            </Route>

            <Route path="/canciones" exact>
                <ListaCancion />
            </Route>

            <Route path="/GeneroArtista" exact>
                <ListaGeneroArtista />
            </Route>


            <Route path="/artista/edit/:id" component={FormArtista}>
            </Route>

            <Route path="/artista/create">
                <FormArtista/>
            </Route>  

            <Route path="/canciones/edit/:id" component={FormArtista}>
            </Route>

            <Route path="/canciones/create">
                <FormCancion/>
            </Route>   

            
            {/* <Route path="/personas/foto/:id" component={FotoPersona}> */}
            {/* </Route> */}
            
        </Switch>
    );
}

export default RouterConfig;