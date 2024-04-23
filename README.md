⚠️ Вводная информация ⚠️
⏰Срок выполнения: 2-4 дня.
📝 Цель: реализовать сократитель ссылок, по аналогии с vk.cc.
📋 Что должно быть:
Посетитель сайта вводит любой оригинальный URL-адрес в поле ввода.
Нажимает кнопку submit.
Страница делает ajax-запрос на сервер и получает уникальный короткий URL-адрес.
Сгенерированный URL-адрес отображается на странице в ответном сообщении.
Посетитель может скопировать короткий URL-адрес и повторить процесс с другой ссылкой.
⚠️Важно:
Использовать классы.
Не использовать фреймворк.
Короткий URL должен уникальным и перенаправлять на ссылку привязанную к данному URL.
💪 Приветствуется:
Реализация авторизации, где пользователь, создавший короткую ссылку может посмотреть статистику переходов по ней.


Возможности дальнейшего развития:
    Больше декомпозиции:
        Вынос логики из роутера в отдельные контроллеры (пользователи, ссылки),
        Регистрация роутов вместо match() {}
    Больше валидации:
        Например в веб формах (пороверка ссылок/логинов и т.д. на корректность, sql-injection),
        Длина пароля, наличие спец. символов и т.п.,
        Активация через email
