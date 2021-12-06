import "./App.css";
import { BrowserRouter as Router } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import RouterConfig from "./config/RouterConfig";
import Header from "./components/Header";

function App() {
  return (
    <Router>
      <div>
        <Header />
        <RouterConfig/>
      </div>
    </Router>
  );
}

export default App;

