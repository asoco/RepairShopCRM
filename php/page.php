<?php 
$ID_order=$_POST['ID_order'];
$worker = (($mysql->query("SELECT * FROM `order_empls` JOIN `employees` `jobs` USING(`ID_empl`) WHERE (`ID_job`= 3) AND (`ID_order`='$ID_order')"))->fetch_assoc());
if (empty($worker)) {
    $worker['Name_empl'] = 'Рабочий не задан';
}
$manager = (($mysql->query("SELECT * FROM `order_empls` JOIN `employees` `jobs` USING(`ID_empl`) WHERE `ID_job`=2"))->fetch_assoc());
 if (empty($manager)) {
    $manager['Name_empl'] = 'Менеджер не задан';
}
 ?>
<div class="p-5" style="max-width: 1100px;">
    <h1>Заказ #<strong><?php print($_POST['ID_order']) ?></strong> </h1>
    <p class="lead">Мы были рады ремонтировать ваше устройство <i class="fas fa-heart text-danger"></i>.</p><br>
    <table class="table table-borderless" style="max-width: 700px;">
        <tbody>
            <tr>
                <th scope="row" class="text-right lead">Клиент: </th>
                <td class="lead"><strong> <?php print($_POST['Name_client']) ?></strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Ваше устройство: </th>
                <td class="lead"><strong><?php print($_POST['name_hw_order']) ?></strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Серийный номер: </th>
                <td class="lead"><strong><?php print($_POST['sn_hw_order']) ?></strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Состояние: </th>
                <td class="lead"><strong><?php print($_POST['device_condition'])?></strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Заявленная неисправность: </th>
                <td class="lead"><strong><?php print($_POST['problems'])?></strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Ремонт: </th>
                <td class="lead"><strong>Выполнен успешно</strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Стоимость: </th>
                <td class="lead"><strong><?php print($_POST['price_order'])?> ₽</strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Метод оплаты: </th>
                <td class="lead"><strong>Безналичный</strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Мастер: </th>
                <td class="lead"><strong><?php print($worker['Name_empl']); ?></strong></td>
            </tr>
            <tr>
                <th scope="row" class="text-right lead">Менеджер: </th>
                <td class="lead"><strong><?php print_r($manager['Name_empl']); ?></strong></td>
            </tr>
        </tbody>
    </table>
    <br>
    <p class="lead">На данный ремонт предоставлена гарантия <strong>1 год</strong> начиная с сегодняшней даты.</p>
	<br class="mb-5">
    <p class="lead"><span>Подпись сотрудника:<span class="ml-2">"_______________________"</span></span><span class="float-right">Подпись клиента: <span class="ml-2">"_______________________"</span> </span> </p>
    <hr class="my-4">
    <p>Телефон поддержки: 8-800-800-80-80.</p>
    <p class="lead">
    </p>
</div>
<script>
$(".page-wrapper").toggleClass("toggled");
  window.print();
</script>
<script>
     $.post( "database.php", { action:"get_empl_rep", ID_order:<?php print($_POST['ID_order']) ?> })
        .done(function( data ) {
                $('.help').html(data); 
        });
</script>