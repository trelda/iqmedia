<h3>Добавить ссылку</h3>
<form action="#" method="post">
    <label for="link">Новая ссылка</label>
    <input type="text" name="link" required/>

    <div class="btn btn-submit" onclick="createlink();">
        <span>Создать ссылку</span>
    </div>
</form>

<h3>Ваши ссылки</h3>
<table id="links">
    <thead>
        <th>Полная ссылка</th>
        <th>Сокращенная ссылка</th>
        <th>Кол-во обращений</th>
    </thead>
<?php
foreach ($links as $link) { ?>
    <tr>
        <td>
            <a href="<?php echo $link['link']; ?>"><?php echo $link['link']; ?></a>
        </td>
        <td>
            <a href="/<?php echo $link['short_link']; ?>" target="_blank"><?php echo $link['short_link']; ?></a>
        </td>
        <td>
            <?php echo $link['counter']; ?>
        </td>
    </tr>
<?}
?>
</table>