Api routs:

POST /api/users body({"first_name":"aaa","last_name":"bbb","password":"11111111","email":"aaa@gmail.com"})- Создание пользователя

PUT /api/users/{user_id} body({"first_name":"qwe","last_name":"asd","password":"12345678","email":"zxc@gmail.com"}) - Редактирование пользователя

DELETE /api/users/{user_id} - Удаление пользователя

GET /api/users - Получение всех пользователей

GET /api/users/{user_id} - Получение пользователя


POST /api/tasks body({"title":"aaa","description":"desc","user":"2"})- Создание Задачи, user - передаете user's id к которому хотите привязать задачу

PUT /api/tasks/{tasks_id} body({"title":"aaaa","description":"desca","status":"2","user":"3"}) - Редактирование задачи

PUT /api/tasks/{tasks_id} body({"status":"2"}) - Изменить статус задачи

PUT /api/tasks/{tasks_id} body({"user":"2"}) - Изменить пользователя на которого назначена задача

DELETE /api/tasks/{tasks_id} - Удаление задачи

GET /api/tasks/{tasks_id} - Получение задачи

GET /api/tasks?status_id={status_id}&order={order} - Получение списка задач. Можно отфильтровать по статусу добавив {status_id}, и отсортировать по id передав {order} - desc или asc


Написаны Seeders.
Написаны Feature тесты для контроллера

После того как вы запустили миграции запустите php artisan db:seed чтобы добавить statuses