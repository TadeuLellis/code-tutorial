// as importações
import React from 'react';  // importa React de react
import { Provider } from 'react-redux'; // importa o Provider para registrar a store (loja) de react
import store from './store/reducer';  // importa store de /store/reducer.js
import ReactDOM from 'react-dom'; // importa o ReactDom de react-dom para a renderização de JSX
import './index.css'; // importa css de /index.css
import App from './App';  // importa App de /App.js
import ReduxTest from './ReduxTest';  // importa ReduxTest de /ReduxTest.js
import reportWebVitals from './reportWebVitals';

// importa de react-router-dom para as rotas de react
import {
  BrowserRouter as Router,
  Switch,
  Route,
  Link
} from "react-router-dom";

// ReactDom é responsável pela renderização (render) e aqui é o núcleo (core) do app React
ReactDOM.render(
  <React.StrictMode>
    <Router>
      <Provider store={store}>
        <Switch>
          <Route exact path="/">
            <App />
          </Route>
          <Route path="/redux-test">
            <ReduxTest />
          </Route>
        </Switch>
      </Provider>
    </Router>
  </React.StrictMode>,
  document.getElementById('root')
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
