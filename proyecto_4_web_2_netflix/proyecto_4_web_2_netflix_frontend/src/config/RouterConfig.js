import React from "react";
import { Route, Switch } from "react-router";
import DetallePelicula from "../pages/DetallePelicula";
import FormPelicula from "../pages/FormPelicula";
import ListaPelicula from "../pages/ListaPelicula";

const RouterConfig = () => {
  return (
    <Switch>
      <Route path="/peliculas/create">
        <FormPelicula/>
      </Route>
      <Route path="/peliculas/edit/:id" component={FormPelicula}>
      </Route>
      <Route path="/peliculas" exact>
        <ListaPelicula />
      </Route>
      <Route path="/peliculas/:id" component={DetallePelicula}>
      </Route>
      <Route path="/" exact>
        <ListaPelicula />
      </Route>
    </Switch>
  );
};

export default RouterConfig;
