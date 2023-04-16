# Autodoc\Test For PHP

## Introdução

Bem-vindo ao teste para a vaga de desenvolvedor PHP :elephant: !

Neste teste, você será desafiado a finalizar a implementação de um cliente HTTP que está pela metade, 
adicionando métodos seguindo o verbo HTTP, como `GET`, `POST`, `PUT` e `DELETE`, e também criar um mecanismo 
de cache em arquivo e outro em memória usando uma mesma interface.

Para completar essa tarefa, você deve refatorar a classe `HttpResponse` para que a mesma utilize um mecanismo 
de cache nos métodos `GET`, `PUT` e `DELETE`. É importante notar que o cliente HTTP já possui um método `call` 
que já implementa toda a funcionalidade de requisição.

Além disso, o desenvolvedor deve criar uma interface para implementar um recurso de cache, e duas implementações 
diferentes usando a mesma interface, uma em memória e outra em arquivo.

## Observação

Importante ressaltar que não é permitido o uso de pacotes externos, apenas o phpunit pode ser utilizado para 
criar os testes de unidade.

Embora não seja obrigatório, fazer testes de unidade é altamente recomendado e pode render pontos extras.

Segue uma API Publica que pode ser utilizada no Cliente Http

https://jsonplaceholder.typicode.com/

## Uso

Para realizar o teste, siga os seguintes passos:

* Faça um fork do projeto no Github para a sua conta pessoal.
* Implemente os métodos GET, POST, PUT e DELETE na classe HttpResponse.
* Crie uma interface para implementar um recurso de cache, e duas implementações diferentes usando a mesma interface, uma em memória e outra em arquivo.
* Refatore a classe HttpResponse para que a mesma utilize um mecanismo de cache nos métodos GET, PUT e DELETE.
* Crie testes de unidade utilizando o phpunit.
* Nos avise por e-mail quando finalizar o teste. Não é necessário criar uma pull request.

Este teste foi projetado para avaliar suas habilidades em PHP, orientação a objetos, design patterns e boas práticas de programação. Boa sorte e divirta-se!

## Resolução

Como eu não conhecia o projeto decidi seguir por etapas, a primeira foi o teste prático, onde eu usei e testei todas as
requests para ver como reagiriam. Após ver elas funcionando defini o como iria separar elas e adicionei uma nova função
que todas elas usariam que seria o `makeRequest`.

Com a estrutura inicial feita decidi testar as formas de fazer cache para ter uma melhor noção de como estruturar a sua
utilização. A primeira foi o cache em memória usando o `Memcached` e a outra foi o cache em arquivo usando o PHP puro,
com tudo pesquisado, testado e organizado criei a interface deles e criei o `CacheService` que o `HttpRequest` vai
estender para conseguir fazer o cache sem se preocupar com qual tipo de cache vai ser (um detalhe importante o
`CacheService` vai pegar da configuração qual o tipo de cache será feito).

Com tudo planejado e estruturado bastou codificar, e como etapa final falta pesquisar e criar os testes com o PHPUnit.
