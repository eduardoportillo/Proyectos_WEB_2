import SSocket from 'servisofts-socket';
import Parent from './index'
import { SNavigation } from 'servisofts-component';
import SHttp from '../../SHttp';

export default class Actions {
    static _getReducer = (props) => {
        if (!props) {
            props = {
                state: SHttp.getState()
            };
        }
        return props.state[Parent.component + "Reducer"];
    }
    static validateSession(props, preventRedirect) {
        if (!props) {
            props = {
                state: SHttp.getState()
            };
        }
        var reducer = Actions._getReducer(props);
        var data = reducer.usuarioLog;
        if (!data) {
            if (preventRedirect) return null;
            SNavigation.replace("carga");
            return null;
        }
        return data;
    }
    static login({ email, password }) {
        SHttp.post({
            component: "user",
            type: "login",
            data: {
                email, password
            },
        })
    }

    static getAll = () => {
        var reducer = Actions._getReducer(null);
        var data = reducer.data;
        if (!data) {
            if (reducer.estado == "cargando") return null;
            SHttp.get({
                component: Parent.component,
                type: "/",
            })
            return null;
        }
        return data;
    }

    static getById = (key) => {
        var data = Actions.getAll();
        if (!data) return null;
        return data[key]
    }
    static register = (data) => {
        SHttp.post({
            component: Parent.component,
            type: "register",
            data: data
        })
    }
    static editar = (data) => {
        SHttp.post({
            component: Parent.component,
            type: "editar",
            data: data
        })
    }
}