import React from 'react';
import logo from './logo.svg';
import SearchForm from './SearchForm/SearchForm'
import { searchImages } from './WebApi/Api'
import Images from './Images/Images'
import './App.css'

// componente class App
class App extends React.Component {
  // inicia constructor ao instânciar um objeto do tipo App ao renderizar
  constructor(props) {  // props são as propriedades que um componente possam ter
    super(props); // chama a super classe (super(props)) de App na hierarquia
    this.state = {  // state é um objeto de estado global de um componente class
      images: [], // array de images
      status: ''  // status para a requisição de back-end
    }
  }

  // evento onSearchSubmit para o componente filho SearchForm do formulário
  onSearchSubmit = async uri => { // async para requisições assíncronas
    // se uri está vazia
    if(uri === '') {  // então
      // faz requisição da Api de searchImages para back-end retornando consulta para todas as imagens
      const response = await searchImages(uri)  // await para fazer requisição com sincronia
      this.setState({ images: response.result.images})  // armazene response em state global
    }
    else { // senão, para uma imagem em questão
      const response = await searchImages(uri)
      this.setState({ images: response.result, status: response})
    }
  }

  // renderiza o HTML
  render() {
    return (
      <div>
        <SearchForm onSubmit={this.onSearchSubmit} />
        <Images status={this.state.status} images={this.state.images} />
      </div>
    );
  }
}

// exporta como padrão (default)
export default App;
