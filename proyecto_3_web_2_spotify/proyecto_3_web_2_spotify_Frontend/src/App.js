import './App.css';
import {
  BrowserRouter as Router,
} from "react-router-dom";
import 'bootstrap/dist/css/bootstrap.min.css';
import RouterConfig from './config/RouterConfig';
import SideBar from './components/SideBar';
import { Container } from 'react-bootstrap';

function App() {
  return (
    
    <Router>
      <div>
        <div>
          <SideBar />
        </div>
        <div>
        <Container>
          <RouterConfig />
        </Container>
        </div>
      </div>
    </Router>
  );
}

export default App;
