# 💰 Finance Control

> Projeto desenvolvido durante o curso de Programação Web do programa PAIDEIA-LASSU da USP.

Um sistema simples e eficiente para controle financeiro, focado na organização do código e na aplicação de boas práticas de desenvolvimento web. O projeto utiliza credenciais de banco de dados isoladas em um arquivo de ambiente, dispensando o uso de dependências externas complexas.

---

## 🚀 Tecnologias e Estrutura

Este projeto foi construído empregando as tecnologias clássicas do desenvolvimento web:

* **Backend:** PHP (7.4 ou superior)
* **Banco de Dados:** MySQL / MariaDB
* **Frontend:** HTML, CSS e JavaScript
* **Estrutura de Pastas:**
  * `php/` - Lógica de backend e conexão.
  * `sql/` - Scripts para criação do banco de dados.
  * `js/` - Comportamentos e interatividade da interface.
  * `styles/` - Estilização das páginas em CSS.
  * `pages/` - Estrutura HTML das páginas do sistema.

---

## 📋 Funcionalidades em Destaque

* **Segurança no Banco de Dados:** Isolamento de configurações sensíveis através de arquivo de ambiente.
* **Classe Dedicada:** Implementação de classe nativa em PHP para a conexão com o banco de dados.
* **Código Limpo:** Estruturação em camadas que facilita a compreensão, a manutenção e a escalabilidade.

---

## 🔧 Como Instalar e Rodar

Para executar este projeto na sua máquina, siga as etapas abaixo:

### 1. Pré-requisitos
Certifique-se de ter instalado:
* [XAMPP](https://www.apachefriends.org/), WAMP, MAMP, Nginx ou outro servidor web configurado.
* PHP 7.4 ou superior.
* MySQL ou MariaDB.

### 2. Clonar o repositório
Clone os arquivos para dentro da pasta pública do seu servidor web (ex: `htdocs` no XAMPP ou `www` no WAMP):
~~~bash
git clone https://github.com/AntDavid/finance_control.git
~~~

### 3. Configurar o Banco de Dados
* Utilize os scripts fornecidos na pasta `sql/` para criar o banco de dados no seu MySQL.
* Crie o arquivo de ambiente na raiz do projeto contendo suas credenciais de acesso ao banco (nunca versione este arquivo no Git).

### 4. Executar
Abra o seu navegador e acesse:
~~~text
http://localhost/finance_control
~~~

---

## 🔐 Recomendações de Segurança

* **Nunca versione seu arquivo de credenciais:** Certifique-se de que ele esteja listado no `.gitignore`.
* **Ambiente de Produção:** Evite utilizar o usuário `root` do MySQL sem senha ao colocar a aplicação online.

---

## 🎓 Sobre o PAIDEIA-LASSU

Este projeto foi desenvolvido como parte das atividades do curso de Programação Web do programa **PAIDEIA**. 

O PAIDEIA é um programa de capacitação e formação em tecnologia oferecido pelo **LASSU** (Laboratório de Sustentabilidade em TIC) da **USP** (Universidade de São Paulo). O objetivo do curso é preparar profissionais com fundamentos sólidos em programação, aplicando os conhecimentos teóricos em projetos práticos voltados ao mercado de trabalho.

Para saber mais sobre o programa, visite o site oficial: [LASSU-USP PAIDEIA](https://www.lassu.usp.br/paideia/)

---

## 📄 Licença

Projeto de código aberto, livre para uso educacional, estudo e projetos pessoais.
EOF
