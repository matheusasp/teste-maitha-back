Essa é uma simples API com um sistema básico de autenticação e CRUD para usuários e produtos. Descreverei abaixo os passos para utilizá-la:

Na pasta raíz do projeto há um arquivo chamado RequestHero que contém uma exportação de todas as requisições que a API é capaz de realizar para ser importado em Insomnia/Postman. Apenas basta substituir e adicionar os campos na URL que devem ir ID, tokens e o body.

Por ser apenas uma API simples, utilizei um sistema de autenticação básico que funciona da seguinte forma:
Ao criar um usuário para acessar, ele gerará um token de autenticação único, esse token deverá ser passado como Bearer token em todas as requisições que exigem autenticação. Para obter o token basta realizar a requisição de login que ele retornará o token daquele usuário para que possa ser utilizado.

