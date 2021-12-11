//  COMPONENT CONFIG
const component = "partida"; // COMPONENT NAME 
// ---------------------------------------
import Actions from "./Actions";
import Reducer from "./Reducer";

import Lista from "./Pages/Lista";
import Registro from "./Pages/Registro";
import Select from "./Pages/Select";
import Perfil from "./Pages/Perfil";
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
    }
}