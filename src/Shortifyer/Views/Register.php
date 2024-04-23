<h3>Регистрация</h3>
<div class="container">
    <form action="/register" method="post">
        <label for="">Логин</label>
        <input type="text" name="login" required/>
        <label for="password">Пароль</label>
        <input type="password" name="password" required/>
        <label for="confirm_password">Повтор пароля</label>
        <input type="password" name="confirm_password" required/>

        <button type="submit">Регистрация</button>
    </form>
</div>