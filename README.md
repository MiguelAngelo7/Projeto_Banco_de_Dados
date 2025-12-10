# Projeto_Banco_de_Dados
Projeto desenvolvido com o objetivo de aprimorar o acesso à instituição escolar, facilitando o processo de matrícula dos alunos e proporcionando uma gestão mais organizada e eficiente de seus dados.
# 📚 Projeto: Sistema de Cadastro e Gestão de Alunos

Sistema desenvolvido em PHP com MySQL para autenticação de usuários e gerenciamento de alunos.

---

# 📂 Estrutura do Projeto

```
├── painel.php
├── cadastro.php
├── conexao.php
├── dados.php
├── formulario.php
├── index.php
├── login.php
├── salvar_formulario.php
├── logout.php
|── verifica_login.php
├── list.php
├── navbar.php
├── telacadastro.php
```


---

# 🚀 Funcionalidades

### **🔐 Autenticação**

| Função                 | Status                         | Arquivos                           |
| ---------------------- | ------------------------------ | ---------------------------------- |
| Cadastrar usuário      | ✅ Completo                     | `cadastro.php`                     |
| Fazer login            | ✅ Completo                    | `index.php`, `login.php`           |
| Verificar sessão ativa | ✅ Completo                    | `verifica_login.php`                |
| Logout                 | ✅ Completo                     | `logout.php`                       |

### **🧑‍🎓 Gestão de Alunos**

| Função          | Status                             | Arquivos                                  |
| --------------- | ---------------------------------- | ----------------------------------------- |
| Cadastrar aluno | ✅ Completo                        | `formulario.php`, `salvar_formulario.php` |
| Editar aluno    | ✅ Completo                        | —                                         |
| Excluir aluno   | ❌ Não implementado                 | —                                         |
| Listar alunos   | ✅ Completo                         | —                                         |


---

# 🛠️ Tecnologias Utilizadas

* **PHP** → Backend, sessões, validação e rotas internas
* **MySQL** → Banco de dados dos usuários e alunos
* **Bootstrap 5** → Interface do formulário e páginas
* **HTML/CSS** → Estrutura das telas
* **MD5** → Utilizado para criptografia de senha (não recomendado)
* **session_start()** → Gerenciamento de autenticação

---

# 🗃️ Banco de Dados

O banco utilizado se chama:

```
sistema_formulario
```

## **1. Tabela users (Login)**

Criada automaticamente por você no phpMyAdmin, mas não enviada.
Estrutura recomendada:

| Coluna  | Tipo        | Descrição      |
| ------- | ----------- | -------------- |
| id      | INT         | Chave primária |
| usuario | VARCHAR     | Nome de login  |
| senha   | VARCHAR(32) | Senha em MD5   |

## **2. Tabela dados (Alunos)**

Arquivo: `dados.php` (na verdade contém SQL)

```sql
CREATE TABLE `dados` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` int(3) NOT NULL,
  `email` varchar(100) NOT NULL,
  `rua` varchar(100) NOT NULL,
  `numero` int(10) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cep` varchar(100) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `responsavel` varchar(100) NOT NULL,
  `sexo` varchar(100) NOT NULL,
  `curso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `dados`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `dados`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
```

---

# ⚙️ Configuração do Projeto

### 1️⃣ Copiar arquivos

Coloque todos os `.php` e o SQL no servidor local:

* `htdocs` (XAMPP)
* `www` (WAMP)

---

### 2️⃣ Criar Banco de Dados

No phpMyAdmin:

1. Criar banco `sistema_formulario`
2. Executar conteúdo de `dados.php`
3. Criar tabela `users` manualmente (não enviada)

---

### 3️⃣ Verificar Conexão

Arquivo: **conexao.php**

```php
define('HOST', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('DB', 'sistema_formulario');
```

---

### 4️⃣ Acessar o Sistema

| Função                | Caminho                 |
| --------------------- | ----------------------- |
| Tela de login         | `index.php`             |
| Cadastro de usuário   | `cadastro.php`          |
| Formulário de aluno   | `formulario.php`        |
| Salvar dados do aluno | `salvar_formulario.php` |
| Logout                | `logout.php`            |

---

# 📋 Descrição dos Arquivos

### **🟦 conexao.php**

Gerencia conexão ao MySQL usando constantes definidas no código.

### **🟦 index.php**

Tela inicial de login.
Envia usuário e senha para `login.php`.

### **🟦 login.php**

Valida usuário e senha usando MD5.
Cria sessão com `$_SESSION['usuario']`.

### **🟦 cadastro.php**

Insere novos usuários na tabela `users`.

### **🟦 formulario.php**

Formulário completo de cadastro do aluno (15+ campos).

### **🟦 salvar_formulario.php**

Recebe dados do formulário e insere no banco.


### **🟦 dados.php**

Arquivo contendo o SQL para criar a tabela de alunos.


---

# ✍️ Autor

Miguel Ângelo Amorim Silva
EEEP Manoel Mano
Estudante de Informática

