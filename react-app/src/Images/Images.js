import React from 'react'
import ImageList from '../ImageList/ImageList'

// componente class Images
class Images extends React.Component {
  // renderiza o HTML
  render() {
    return (
      <div>
        <ol>
        {
        // se sucesso
        (this.props.status.status === 'sucesso') // então
        ?this.props.images.map((i, index) => {  // faz percurso com map por um array images
          return <ImageList key={index} image={i} />  // retorna ImageList para renderização
        })  // se não
        :'Erro: A imagem não existe' //  erro encontrado ao consultar em SearchForm
        }
        </ol>
      </div>
    )
  }
}

// exporta como padrão (default)
export default Images