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

    static getAll = (torneo_id) => {
        var reducer = Actions._getReducer(null);
        if (torneo_id != reducer.torneo_id) {
            reducer.data = null;
        }
        var data = reducer.data;
        if (!data) {
            if (reducer.estado == "cargando") return null;
            reducer.torneo_id = torneo_id;
            SHttp.post({
                component: Parent.component,
                type: "getAllByTorneo",
                data: {
                    torneo_id: torneo_id
                }
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