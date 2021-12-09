import React from 'react';
import {Route, Switch} from 'react-router';
// import FormPersona from '../pages/FormPersona';
// import ListaPersonas from '../pages/ListaPersonas';
import Login from '../pages/Login';
const RouterConfig = () => {
	return (
		<Switch>
			{/* <Route path="/personas/create">
                <FormPersona />
            </Route> */}
			{/* <Route path="/personas/edit/:id" component={FormPersona}>
            </Route> */}
			{/* <Route path="/personas" exact>
                <ListaPersonas />
            </Route> */}
			<Route path='/login' exact>
				<Login />
			</Route>
			<Route path='/'>
				<Login />
				{/* <ListaPersonas /> */}
			</Route>
		</Switch>
	);
};

export default RouterConfig;
