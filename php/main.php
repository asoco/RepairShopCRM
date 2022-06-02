<!-- page-content  -->
<style>.card {display:inline-block;}</style>
<?php 
    $totalsum = $mysql->query("SELECT SUM(`price_order`) FROM `client_orders`")->fetch_assoc()['SUM(`price_order`)'];
    $totalclients = $mysql->query("SELECT COUNT(`Name_client`) FROM `clients`")->fetch_assoc()['COUNT(`Name_client`)'];
    $totalempls = $mysql->query("SELECT COUNT(`ID_empl`) FROM `employees`")->fetch_assoc()['COUNT(`ID_empl`)'];
 ?>
<div class="container-fluid p-5">
    <div class="row">
        <div class="form-group col-md-12">
            <h1 class="display-4">Главная</h1>
            <p class="lead">Выберите действия в боковом меню</p>
        </div>
    </div>
    <div class="card text-white bg-info  mb-3 align-top" style="max-width: 18rem;">
        <!-- <div class="card-header">Статистика</div> -->
        <div class="card-body text-center">
            <h1 class="card-title">
                <?php print_r($totalclients) ?>
            </h1>
            <p class="card-text lead">клиентов</p>
        </div>
    </div>
    <div class="card text-white bg-info  mb-3 align-top" style="max-width: 18rem;">
        <!-- <div class="card-header">Статистика</div> -->
        <div class="card-body  text-center">
            <h1 class="card-title">
                <?php print_r($totalsum) ?> ₽</h1>
            <p class="card-text lead">получено сегодня</p>
        </div>
    </div>
    <div class="card text-white bg-info  mb-3 align-top" style="max-width: 18rem;">
        <!-- <div class="card-header">Статистика</div> -->
        <div class="card-body  text-center">
            <h1 class="card-title">
                <?php print_r($totalempls) ?>
            </h1>
            <p class="card-text lead">Сотрудника</p>
        </div>
    </div>
</div>
<hr>
</div>
</main>
</div>