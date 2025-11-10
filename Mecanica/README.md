# 🚗 CheckCar API

Sistema de checklist veicular desenvolvido para controle de inspeções, respostas por item e geração de relatórios. Ideal para oficinas, frotas ou qualquer operação que exija verificação sistemática de veículos.

---

## 📦 Tecnologias utilizadas

- Java 21
- Spring Boot 3.5.6
- Spring Data JPA
- Spring Security
- MySQL
- Swagger (SpringDoc OpenAPI)
- Maven

---

## 🚀 Como executar o projeto

### Pré-requisitos

- Java 21 instalado
- MySQL rodando localmente
- IDE com suporte a Maven (IntelliJ, Eclipse, VS Code)

### Passos

1. Clone o repositório:
   ```bash
   git clone https://github.com/seu-usuario/checkcar-api.git
   ```

2. Configure o banco de dados no `application.properties`:
   ```properties
   spring.datasource.url=jdbc:mysql://localhost:3306/checkcar
   spring.datasource.username=seu_usuario
   spring.datasource.password=sua_senha

   springdoc.api-docs.enabled=true
   springdoc.swagger-ui.enabled=true
   ```

3. Execute o projeto:
   ```bash
   mvn spring-boot:run
   ```

4. Acesse a documentação Swagger:
   ```
   http://localhost:8080/swagger-ui/index.html
   ```

---

## 📘 Endpoints principais

### ✅ Checklist

- `POST /checklists` — Cadastra um novo checklist
- `GET /checklists` — Lista todos os checklists
- `GET /checklists/{id}` — Busca checklist por ID
- `DELETE /checklists/{id}` — Remove checklist

**Exemplo de JSON:**
```json
{
  "usuario": { "id": 1 },
  "veiculo": { "id": 3 }
}
```

---

### 🧾 ItemChecklist

- `POST /itens-checklist` — Cadastra item
- `GET /itens-checklist` — Lista todos os itens
- `GET /itens-checklist/{id}` — Busca item por ID
- `DELETE /itens-checklist/{id}` — Remove item
- `GET /itens-checklist/tipo/{tipo}` — Lista itens por tipo de veículo (`CARRO`, `MOTO`, etc.)

**Exemplo de JSON:**
```json
{
  "nome": "Verificar nível de óleo",
  "tipoVeiculo": "CARRO"
}
```

---

### ✅ RespostaChecklist

- `POST /respostas-checklist` — Cadastra resposta individual
- `POST /respostas-checklist/lote` — Cadastra várias respostas de uma vez
- `GET /respostas-checklist` — Lista todas as respostas
- `GET /respostas-checklist/{id}` — Busca resposta por ID
- `DELETE /respostas-checklist/{id}` — Remove resposta

**Exemplo de JSON individual:**
```json
{
  "checklist": { "id": 1 },
  "item": { "id": 3 },
  "status": "OK",
  "observacao": "Tudo certo com o nível de óleo"
}
```

**Exemplo de JSON em lote:**
```json
[
  {
    "checklist": { "id": 1 },
    "item": { "id": 3 },
    "status": "OK",
    "observacao": "Tudo certo com o nível de óleo"
  },
  {
    "checklist": { "id": 1 },
    "item": { "id": 4 },
    "status": "FALHA",
    "observacao": "Pneu dianteiro murcho"
  }
]
```

---

## 📚 Documentação Swagger

Acesse a interface interativa para testar os endpoints:

```
http://localhost:8080/swagger-ui/index.html
```

---

## 🧠 Funcionalidades futuras

- Validação de checklist completo
- Relatório resumido por checklist
- Autenticação com JWT
- Integração com front-end (React)
- Deploy em nuvem (Render, Railway)

---

## 👨‍💻 Autor

**Lucas**  
Projeto desenvolvido para fins acadêmicos e profissionais.  
Contagem, MG — Brasil
