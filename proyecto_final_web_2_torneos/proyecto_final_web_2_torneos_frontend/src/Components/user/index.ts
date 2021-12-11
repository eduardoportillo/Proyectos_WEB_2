//  COMPONENT CONFIG
const component = "user"; // COMPONENT NAME 
// ---------------------------------------
import Actions from "./Actions";
import Reducer from "./Reducer";

import Lista from "./Pages/Lista";
import Registro from "./Pages/Registro";
import Login from "./Pages/Login";
import Select from "./Pages/Select";
export default {
    component,
    Actions,
    Reducers: {
        [component + 'Reducer']: Reducer
    },
    Pages: {
        [component]: Lista,
        [component + "/registro"]: Registro,
        [component + "/select"]: Select,
        "login": Login
    }
}