import Parent from './index'

type DataProps = {
    component: any,
    type: string,
    version?: any,
    estado?: "exito" | "cargando" | "error",
    error: any,
    [key: string]: any;
}

const initialState = () => {
    var initialState: any = {
        component: Parent.component,
    }
    return initialState;
}
export default (state: any, action: DataProps) => {
    if (!state) return initialState();
    if (action.component != Parent.component) return state;
    TypesSwitch(state, action)
    state.type = action.type;
    state.estado = action.estado;
    state.error = action.error;
    state.lastSend = new Date();
    state = { ...state };
    return state;
}

const TypesSwitch = (state: any, action: DataProps) => {
    switch (action.type) {
        case "/": return getAll(state, action);
        case "getAll": return getAll(state, action);
        case "open": return getAll(state, action);
        case "user": return getAll(state, action);
        case "iniciado": return getAll(state, action);
        case "iniciar": return iniciar(state, action);
        case "register": return register(state, action);
        case "editar": return editar(state, action);
        case "getById": return getById(state, action);
    }
}

const getAll = (state: any, action: DataProps) => {
    if (action.estado != "exito") return;
    state.data = {};
    action.data.map((itm: any) => {
        state.data[itm.id] = itm;
    })
}
const register = (state: any, action: DataProps) => {
    if (action.estado != "exito") return;
    if (!state.data) return;
    state.data[action.data.id]=action.data;
}
const editar = (state: any, action: DataProps) => {
    if (action.estado != "exito") return;
    if (!state.data) return;
    state.data[action.data.id] = action.data;
}
const iniciar = (state: any, action: DataProps) => {
    if (action.estado != "exito") return;
    if (!state.data) return;
    state.data[action.data.id] = action.data;
}
const getById = (state: any, action: DataProps) => {
    if (action.estado != "exito") return;
    state.data[action.data.id] = action.data;
}
