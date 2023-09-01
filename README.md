<p align="center">
  <a href="" rel="noopener">
 <img width=200px height=200px src="https://i.imgur.com/6wj0hh6.jpg" alt="Project logo"></a>
</p>

<h3 align="center">Desafio Diretorio Digital - Lista de Fornecedores</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg)]()

</div>

---

<p align="center"> Projeto desenvolvido para o desafio Diretorio Digital que consiste no cadastro, edição e exclusão de fornecedores em uma lista.
    <br> 
</p>

## 📝 Índice

- [Sobre](#about)
- [Getting Started](#getting_started)
- [Authors](#authors)

## 🧐 Sobre <a name = "about"></a>


## 🏁 Getting Started <a name = "getting_started"></a>

Instruções para ter uma cópia do repositório.

### Pré-requisitos

-   **PHP - Supported Versions:** >= 8
-   **Database:** MySQL
-   **Run-time environment:**: Node.js, Composer, npm, Vue & Laravel Framework

### Instalação

- Clone

O repositório onde se encontra o código fonte da aplicação está na branch **master**. Logo:

```bash
$ git clone https://github.com/maurorgrdev/desafio-diretorio-digital.git
$ cd desafio-diretorio-digital
$ git checkout master
```

-   **Back-end**

Estas ações devem ser realizadas dentro da pasta /fornecedor-backend.

- Configuração

Faça uma cópia do arquivo env.example e o renomeie para .env

```bash
APP_NAME=Fornecedor

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=diretorio
DB_USERNAME=SEU_USERNAME
DB_PASSWORD=_SEU_PASSWORD
```

Acessa sua conta no mailtrap e altere os dados de conexão MAIL com Laravel > 9 com suas credênciais

```bash
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=
MAIL_USERNAME=
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls
```

Execute os seguintes comandos nessa mesma ordem

```bash
$ composer install
$ php artisan key:generate
```

Execute os seguintes comandos para configurar o JWT

```bash
$ composer require tymon/jwt-auth
$ php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"
$ php artisan jwt:secret
```

Ainda no terminal execute:
```bash
$ php artisan optimize:clear
$ php artisan optimize
```

Para gerar o banco de dados e povoar o mesmo execute o seguinte comando:
```bash
$ php artisan migrate --seed
```

Será gerado um usuário com as seguintes credênciais:
```bash
nome: admin
email: admin@gmail.com
password: senha
```

E por fim inicie o servidor:
```bash
$ php artisan serve --port=8000
```


-   **Front-end**

Estas ações devem ser realizadas dentro da pasta /fron-end.

- Configuração

Instale todas as depedências:

```bash
$ npm install
```

- Framework

Instale o framework Vue:

```bash
$ npm install -g @vue/cli
```

- Iniciar app em modo de desenvolvimento

```bash
$ npm run serve
```

A Lista de Fornecedores deverá aparecer no seu navegador.

## ✍️ Authors <a name = "authors"></a>

- [@maurorgrdev](https://github.com/maurorgrdev) - Developer - mauroroger2020@gmail.com
