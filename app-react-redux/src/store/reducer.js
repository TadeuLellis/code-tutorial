import { createStore } from 'redux';  // importar createStore de redux

/*
** função counterReducer responsável pelo comportamento das ações dispatch em react-redux
** conforme o tipo (type ou action.type) lançado durante o uso da aplicação react.js.
** o state para o estado da loja (store) e action das ações (dispatch) da aplicação
**/
function counterReducer(state = { value: 0 }, action) {
    // usando switch para os casos (cases) que determinará a ação escolhida no dispatch
    // para a ação escolhida pelo usuário, ou seja, o increment ou decrement
    switch (action.type) {
      case 'counter/incremented':
        return { value: state.value + 1 }
      case 'counter/decremented':
        return { value: state.value - 1 }
      default:
        return state
    }
}

let store = createStore(counterReducer);  // cria a loja (store) com createStore

export default store; // exporta como padrão (default) a store (loja)