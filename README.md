# Login/Cadastro com o CI4
Páginas de login e cadastro feitas com o [CodeIgniter 4](https://codeigniter.com/user_guide/intro/index.html). Validação dos dados realizada no servidor, através das classes de validação do framework.
## Requerimentos
- `CI4`: faça o [download do CI4](https://codeigniter.com/download) e substitua o diretório `app` pelo diretório contido neste repositório.
- `MySQL`.
## Uso
Crie um banco no MySQL, [configure a conexão do CodeIgniter 4 com o banco](https://www.codeigniter.com/user_guide/database/configuration.html) e crie a tabela de usuários utilizando `user.sql`. Execute o comando `php spark serve` no diretório raiz do CI4 para servir a aplicação com o servidor de testes do framework, ou execute o servidor de testes do PHP com o comando `php -S localhost:8080`, no diretório `public`. Se necessário, siga as [instruções para executar o framework](https://codeigniter4.github.io/userguide/installation/running.html).
