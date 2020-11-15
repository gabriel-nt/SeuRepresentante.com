<p align="center">
    <img src="https://github.com/Gabriel-Teixeira/Blog/blob/master/public/img/logo.svg" alt="logo.svg" height="100"/>
</p>
<h1 align="center">
    🚀 SeuRepresentante.com
</h1>
<p align="center">Trabalho de Conclusão de Curso</p>

<p align="center">
  <img src="https://img.shields.io/badge/laravel%20version-5.8.*-important"/>
  <img src="https://img.shields.io/badge/php%20version-7.1.3-informational" />
  <img src="https://img.shields.io/badge/last%20commit-november-yellow" />
  <img src="https://img.shields.io/badge/license-MIT-success"/>
</p>

<p align="center">
  <a href="#-features">Features</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-pré-requisitos">Pré-Requisitos</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-configurações">Configurações</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-licença">Lincença</a>
</p>

<h3 align="center"> 
🚧  Finalizado  🚧
</h3>

### 📎 Features

- [x] Cadastro de Vendedor/Representante
- [x] Cadastro de Comerciante/Lojista
- [x] Cadastro de Empresa
- [x] Login de Usuários
- [x] Reset e Atualização de Senhas
- [x] Atualização dos Dados dos usuários
- [x] Upload e alteração do avatar do usuário
- [x] Cadastro e atualização de Produtos do Vendedor
- [x] Cadastro e atualização de localização por Mapas
- [x] Carrinho de Produtos 
- [x] Realização de Pedidos
- [x] Envio de Emails

### ✅ Demonstração
<img src="https://github.com/Gabriel-Teixeira/Blog/blob/master/public/img/news.PNG" alt="news" />

### ⚙ Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [Node.js](https://nodejs.org/en/) e/ou [Yarn](https://https://yarnpkg.com/), [Composer](https://getcomposer.org/)
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)
<br/>
Também precisará ter instalado em sua máquina, um apache. Algumas opções são:

- [Wampp](https://sourceforge.net/projects/wampserver/)
- [Xampp](https://www.apachefriends.org/pt_br/index.html)
- [Vertrigo](https://www.vswamp.com/?lang=pt)

### 🎲 Instalando as Dependências 

```bash
# Clone este repositório
$ git clone https://github.com/gabriel-nt/SeuRepresentante.com

# Instale as dependências
$ yarn ou npm install

```

### 🛠 Configurações
Algumas configurações devem ser feitas primeiramente:

- Editar as variaveis do arquivo .env para as suas variáveis
- Permitir o envio de emails em seu Gmail
- Criar o banco e definir o mesmo no seu arquivo .env
- Ter instalado o Grunt de forma local ou global em sua máquina

### 📂 Rodando as Migrations

```bash
# Rodar as migrations
$ php artisan migrate

# Deletar migrations
$ php artisan migrate:reset

# Criar novas migrations
$ php artisan make:migration migration-name

# Ajuda
$ php artisan -v

```


### 🚀 Tecnologias

Esse projeto foi desenvolvido com as seguintes tecnologias:

- Laravel
- PHP
- Bootstrap
- Jquery
- SASS
- Javascript
- Grunt
- MySQL

### 📝 Licença

Esse projeto está sob a licença MIT.

<hr/>

Feito por Gabriel Teixeira
