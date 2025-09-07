# Sistema Helpdesk - Projeto de Aprendizado Laravel

## 📝 Sobre o Projeto

Este é um sistema de helpdesk simples desenvolvido em Laravel, criado com foco educacional para praticar e demonstrar conhecimentos específicos em desenvolvimento web. O projeto implementa um sistema básico de tickets de suporte com funcionalidades essenciais de gerenciamento.

## 🎯 Objetivos de Aprendizado

O projeto foi desenvolvido para explorar e praticar os seguintes conceitos do Laravel:

### Controllers Implementados
- **AuthController**: Gerenciamento de autenticação de usuários
- **TicketController**: CRUD completo para tickets de suporte
- **CommentController**: Sistema de comentários nos tickets

### Funcionalidades Avançadas
- **Custom Requests**: Validações personalizadas para diferentes operações
- **Policies**: Controle de acesso e autorização para tickets
- **Resources**: Transformação e formatação de dados da API

## 🚀 Funcionalidades

### Autenticação
- Login e logout de usuários
- Controle de sessão
- Middleware de autenticação

### Gerenciamento de Tickets
- Criar novos tickets
- Visualizar lista de tickets
- Editar tickets existentes
- Fechar/resolver tickets
- Sistema de prioridades e status

### Sistema de Comentários
- Adicionar comentários aos tickets
- Histórico completo de interações
- Controle de autoria dos comentários

### Controle de Acesso
- Policies para autorização de ações
- Diferentes níveis de permissão
- Proteção de rotas sensíveis

## 🛠️ Tecnologias Utilizadas

- **Laravel**: Framework PHP
- **MySQL**: Banco de dados
- **Blade**: Template engine
- **Eloquent ORM**: Mapeamento objeto-relacional

## 📋 Estrutura do Projeto

```
app/
├── Http/
│   ├── Controllers/Api/
│   │   ├── AuthController.php
│   │   ├── TicketController.php
│   │   └── CommentController.php
│   ├── Requests/
│   │   ├── TicketRequest.php
│   │   └── CommentRequest.php
│   └── Resources/
│       ├── TicketResource.php
│       └── CommentResource.php
├── Models/
│   ├── User.php
│   ├── Ticket.php
│   └── Comment.php
└── Policies/
    └── TicketPolicy.php
```

## 🎓 Conceitos Aprendidos

### Custom Requests
- Validação de dados de entrada
- Mensagens de erro personalizadas
- Autorização em nível de request

### Policies
- Controle granular de permissões
- Separação de lógica de autorização
- Gates e policies no Laravel

### Resources
- Transformação de dados para APIs
- Formatação consistente de respostas
- Controle sobre dados expostos

## 🚦 Status do Projeto

Este projeto foi desenvolvido exclusivamente para fins educacionais e demonstração de conceitos específicos do Laravel. Não é recomendado para uso em produção sem implementações adicionais de segurança e funcionalidades.

## 📚 Próximos Passos de Aprendizado

- Implementação de testes automatizados
- API REST completa
- Sistema de notificações
- Upload de arquivos
- Relatórios e dashboards

*Desenvolvido como projeto de aprendizado em Laravel, focando em Controllers, Requests, Policies e Resources.*
