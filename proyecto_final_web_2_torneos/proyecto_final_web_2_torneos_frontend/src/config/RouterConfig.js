import React from 'react';
import {Route, Switch} from 'react-router';
// import FormPersona from '../pages/FormPersona';
import InicioPage from '../pages/InicioPage';
import Login from '../pages/Login.js';
const RouterConfig = () => {
	return (
		<Switch>
			{/* <Route path='/personas/create'>
				<FormPersona />
			</Route>
			<Route path='/personas/edit/:id' component={FormPersona}></Route> */}
			<Route path='/User' exact>
				<InicioPage />
			</Route>
			<Route path='/login' exact>
				<Login />
			</Route>
			<Route path='/'>
				<InicioPage />
			</Route>
		</Switch>
	);
};

export default RouterConfig;
