var express = require('express'); // express para criar as rotas e ao servidor
var bodyParser = require('body-parser');  // bodyParser para converter o body da requisição
var fs = require('fs'); // fs (file system) para manipular arquivo images.json

var app = express();  // cria instância de servidor express e atribui a variável app

app.use(bodyParser.urlencoded({ extended:true }));  // usa middleware bodyParser.urlencoded
app.use(bodyParser.json()); // usa middleware bodyParser.json

// usa middleware para os cabeçalhos setHeader para o funcionamento da API + REST de NODE.JS
// middleware usado como cabeçalho (Allow-Origin) para o retorno de dados ao front-end
app.use(function(req, res, next) {
 res.setHeader('Access-Control-Allow-Origin', '*');
 res.setHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE');
 res.setHeader('Access-Control-Allow-Headers', 'content-type');
 res.setHeader('Content-Type', 'application/json');
 res.setHeader('Access-Control-Allow-Credentials', true);
 next();
});

let port = 9090;  // porta 9090 para o servidor

app.listen(port, function() { console.log('Servidor Web rodando na porta ' + port); });

// pesquisar no navegador como localhost:9090/books
// faz requisição http get '/books' para retornar todos os livros de books.json
app.get('/books', function(req, res) {
    // lê (readFile) de books.json para obter dados de todos os livros
    fs.readFile('books.json', 'utf8', function(err, data) {
      // se dado um erro
      if (err) {  // então
        var response = {status: 'falha', result: err};  // atribui dados de json caso de falha
        res.json(response); // retornar como resposta de erro um json(response)
      } else {
        var obj = JSON.parse(data); // retornar como objeto json (JSON.parse(data))
        var result = 'Nenhum book foi encontrada';
    
        result = obj;
    
        var response = {status: 'sucesso', result: result}; // atribui dados de json caso de sucesso
        res.json(response); // retornar como resposta de sucesso um json(response)
      }
    });
});

// pesquisar no navegador como localhost:9090/book/1 ou 2 ou 3
// faz requisiçao http get '/book/:id' por um id de um livro
app.get('/book/:id', function(req, res) {
  // lê (readFile) de books.json para obter dados de um livro por id
  fs.readFile('books.json', 'utf8', function(err, data) {
    // se dado um erro
    if (err) {  // então
      var response = {status: 'falha', result: err};  // atribui dados de json caso de falha
      res.json(response); // retornar como resposta de erro um json(response)
    } else {
      var obj = JSON.parse(data); // retornar como objeto json (JSON.parse(data))
      var status = 'erro';  // estado de erro
      var result = 'Nenhuma imagem foi encontrada'; // resultado
  
      // faz loop forEach por todos os livros para comparação com if
      obj.books.forEach(function(book) {
        // se book diferente de null
        if (book != null) {  // então
          // se book.bookid for igual a req.param.id da url
          if (book.bookid == req.params.id) { // então
            status = 'sucesso'; // estado de sucesso
            result = [book]; // atributir book com sucesso
          }
        }
      });
  
      var response = {status: status, result: result}; // resposta como json
      res.json(response); // retornar como resposta de erro ou sucesso um json(response)
    }
  });
 });