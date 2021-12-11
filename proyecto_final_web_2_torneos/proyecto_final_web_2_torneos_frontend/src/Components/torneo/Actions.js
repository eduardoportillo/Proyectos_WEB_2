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

    static open = () => {
        var reducer = Actions._getReducer(null);
        if (reducer.datatype != "open") reducer.data = null;
        reducer.datatype = "open";
        var data = reducer.data;
        if (!data) {
            if (reducer.estado == "cargando") return null;
            SHttp.get({
                component: Parent.component,
                type: "open",
            })
            return null;
        }
        return data;
    }
    static getAll = (force) => {
        var reducer = Actions._getReducer(null);
        if (force) {
            if (reducer.datatype != "getAll") reducer.data = null;
            reducer.datatype = "getAll";
        }

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

    static user = () => {
        var reducer = Actions._getReducer(null);
        if (reducer.datatype != "user") reducer.data = null;
        reducer.datatype = "user";
        var data = reducer.data;
        if (!data) {
            if (reducer.estado == "cargando") return null;
            SHttp.get({
                component: Parent.component,
                type: "user",
            })
            return null;
        }
        return data;
    }
    static iniciado = () => {
        var reducer = Actions._getReducer(null);
        if (reducer.datatype != "iniciado") reducer.data = null;
        reducer.datatype = "iniciado";
        var data = reducer.data;
        if (!data) {
            if (reducer.estado == "cargando") return null;
            SHttp.get({
                component: Parent.component,
                type: "iniciado",
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