//  COMPONENT CONFIG
const component = "torneo"; // COMPONENT NAME 
// ---------------------------------------
import Actions from "./Actions";
import Reducer from "./Reducer";

import Lista from "./Pages/Lista";
import Registro from "./Pages/Registro";
import Select from "./Pages/Select";
import Perfil from "./Pages/Perfil";
import Open from "./Pages/Open";
import User from "./Pages/User";
import Iniciado from "./Pages/Iniciado";
export default {
    component,
    Actions,
    Reducers: {
        [component + 'Reducer']: Reducer
    },
    Pages: {
        [component]: Lista,
        [component + "/registro"]: Registro,
        [component + "/perfil"]: Perfil,
        [component + "/select"]: Select,
        [component + "/open"]: Open,
        [component + "/user"]: User,
        "inicio": Iniciado
    }
}