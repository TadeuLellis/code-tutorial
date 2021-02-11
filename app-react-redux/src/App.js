import './App.css'; // importa css de App.css
import { useSelector, useDispatch } from 'react-redux'; // importar de react-redux
import { increment, decrement } from './store/actions'; // importar de store/actions

import {  // importa Link de react-router-dom para gerar os links de JSX
  Link
} from "react-router-dom";

// App function é um componente de react para ser renderizado em index.js na raiz do projeto
function App() {
  /* 
  ** com useSelector pegará o valor mais atual de state
  ** sem precisar implementar uma função adicional pra isso, pois o react-redux registra tudo
  **/
  let data = useSelector(state => state.value);
  /*
  ** obtém dispatch para enviar uma requisição de envio dependendo do seu tipo (type) de envio
  ** sem precisar implementar uma função adicional pra isso, pois o react-redux registra
  ** tudo pra você
  **/
  let dispatch = useDispatch();

  // renderiza html com o JSX de react.js
  return (
    <div className="App">
      <header className="App-header">
        <h1>Redux Home Page</h1>
        <span><Link style={{color:'#FFF'}} to="/">Redux Home</Link></span>
        <span><Link style={{color:'#FFF'}} to="/redux-test">ReduxTest</Link></span>
        <p>
          Valor a ser incrementado ou decrementado: {data}
        </p>
        <span><button className="App-Button" onClick={() => dispatch(decrement())}>Diminuir</button></span>
        <span><button className="App-Button" onClick={() => dispatch(increment())}>Aumentar</button></span>
      </header>
    </div>
  );
}

export default App; // exportar como padrão (default) o componente App
