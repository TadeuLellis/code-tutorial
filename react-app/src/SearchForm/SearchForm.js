import React from 'react'

// componente class SearchForm
class SearchForm extends React.Component {
    // inicia constructor ao instânciar um objeto do tipo SearchForm ao renderizar
    constructor(props) {    // props são as propriedades que um componente possam ter
        super(props);   // chama a super classe (super(props)) de SearchForm na hierarquia
        this.state = {  // state é um objeto de estado global de um componente class
            uri: '' // a uri da imagem
        }
    }

    // método de evento de envio de formulário
    onFormSubmit = event => {
        // event.preventDefault evita (previne) um comportamento normal para cada requisição
        event.preventDefault()
        // envia onSubmit um form com a instancia de um objeto do componente pai App.js
        this.props.onSubmit(this.state.uri)
    }

    // renderiza o HTML
    render() {
        return (
        <div>
            <form onSubmit={this.onFormSubmit}>
                <div>
                    <label>Pesquisar imagem por ID</label>
                    <input type="text"
                    value={this.state.uri}
                    onChange={e => this.setState({ uri: e.target.value })}></input>
                </div>
            </form>
        </div>
        )
    }
}

// exporta como padrão (default)
export default SearchForm