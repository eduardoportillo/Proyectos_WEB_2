import { SPageListProps } from 'servisofts-component'
import Home from './Home';
import Test from './Test';
import user from '../Components/user';
import Carga from './Carga';
import Ajustes from './Ajustes';
import torneo from '../Components/torneo';
import equipo from '../Components/equipo';
import partida from '../Components/partida';
const Pages: SPageListProps = {
    "/": Home,
    "carga": Carga,
    "ajustes": Ajustes,
    "test": Test,
    ...user.Pages,
    ...torneo.Pages,
    ...equipo.Pages,
    ...partida.Pages
}

export default Pages;