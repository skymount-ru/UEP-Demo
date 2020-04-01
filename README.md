# UEP Demo App

1. Аутентификация
GET http://localhost:8080/api/login
Basic [username,password]
* далее - Bearer <token>

2. Регистрация пользователя
POST http://localhost:8080/api/user
[username, email, password]

3. Список пользователей (список всех пользователей доступен всем)
GET http://localhost:8080/api/user

4. Получение списка групп (у каждого пользователя свой список групп)
GET http://localhost:8080/api/group

5. Получение списка сообщений в группе
GET http://localhost:8080/api/group/messages

6. Создание группы (в группе может быть несколько человек)
POST http://localhost:8080/api/group
[title]

7. Добавление пользователя в группу из списка всех пользователей
POST http://localhost:8080/api/group/1/user/3

8. Отправка сообщения в чат группы (пользователь может отправлять сообщения только в те группы в которых он состоит)
POST http://localhost:8080/api/group/1/message
[message]


9. Аутентификация как администратор
9.1 Список пользователей
9.2 Удаление пользователя
DELETE GET http://localhost:8080/api/user/1

9.3 Отправка сообщения во все группы у всех пользователей
POST http://localhost:8080/api/group/broad-message
[message]


DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
