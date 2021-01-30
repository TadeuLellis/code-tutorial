import React from 'react'

// exporta searchImages
export function searchImages(uri) { // faz requisição da busca ao back-end
  // se uri estiver vazia
  if(uri === '')  // então
    return fetch('http://localhost:9090/images/' + uri) // retorne todas as imagens
    .then(res => res.json())
    .then((res) => {
      return res
    });
  else  // senão
    return fetch('http://localhost:9090/image/' + uri)  // retorne somente uma imagem por id
    .then(res => res.json())
    .then((res) => {
      return res;
    });
}