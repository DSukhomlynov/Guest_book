Реализовать гостевую книгу
============

Установка:<br>
1.Развернуть на своем localhost клонируя репозиторий<br>
2.Обновить в composer с помощью - composer update<br>
3.Создать бд в базе<br>
4.Выполнить yii migrate<br>
5.Выполнить yii migrate/up --migrationPath=@vendor/costa-rico/yii2-images/migrations<br>


Требования:
-Гостевая книга работает без аутентификации и авторизации
-Для каждого сообщения задается имя автора
-Для каждого сообщения должны выводиться дата и время
отправки.
-К каждому сообщению можно прикрепить произвольное число
изображений.
-Для каждого отправляемого сообщения можно прикрепить ссылку
на свой сайт.
-Каждому сообщению можно поставить лайк, для каждого
сообщения выводится общее количество лайков
В качестве БД должна использоваться MySQL.
Разрешены любые фреймворки, библиотеки и технологии (Yii, JQuery,
AJAX и т.д.).