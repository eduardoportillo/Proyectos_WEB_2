import { combineReducers } from 'redux';
import { SStorage } from 'servisofts-component';

import user from './Components/user';
import torneo from './Components/torneo';
import equipo from './Components/equipo';
import partida from './Components/partida';
const reducers = combineReducers({
    ...user.Reducers,
    ...torneo.Reducers,
    ...equipo.Reducers,
    ...partida.Reducers
});

export default (state, action) => {
    switch (action.type) {
        case 'USUARIO_LOGOUT':
            SStorage.removeItem("usr_log");
            state = undefined;
            break;
        default:
            break;
    }
    return reducers(state, action);
}