<!-- новый заказ  -->

<style>.card {display:inline-block;}</style>
<script type="text/javascript" src="js/typeahead.js"></script>
<link href="css/typeahead.css"  rel="stylesheet" />
    <style> .list-group { width: 100%;} </style>
<div class="container p-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="form-group col-md-12">
                    <h1 class="display-4">Новый заказ</h1>
                    <form action="database.php" method="POST">
                        <input type='hidden' name='action' value='newtask'>
                        <h5>Информация о клиенте</h5>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="Name_client" class="form-control" placeholder="Имя клиента" aria-label="Name">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" name="Phone_client" class="form-control" id="phone" placeholder="Телефон" aria-label="Name">
                            </div>
                            <h6>Откуда узнали о сервисе</h6>
                            <div class="input-group mb-3">
                                <select class="custom-select mr-sm-2" name="referrer" id="inlineFormCustomSelect">
                                    <option value="Другое" selected> Другое</option>
                                    <option value="По совету друзей">По совету друзей</option>
                                    <option value="По совету родственников">По совету родственников</option>
                                    <option value="Реклама ВКонтакте">Реклама ВКонтакте</option>
                                    <option value="Реклама Instagram">Реклама Instagram</option>
                                    <option value="Реклама в интернете">Реклама в интернете</option>
                                    <option value="В приложении навигации">В приложении навигации</option>
                                    <option value="Случайно">Случайно</option>
                                </select>
                            </div>
                        </div>
                        <?php   
                         $provname = Null;
                          $result = Null;
                          $result = $mysql->query("SELECT * FROM `employees` WHERE `ID_job`='3'");
                        ?>
                        <h5 class="mt-4">Закрепите рабочего</h5>
                        <div class="input-group mb-3">
                            <select class="custom-select mr-sm-2" name="mstr" id="inlineFormCustomSelect">
                                <option value=" " selected>Нет</option>
                                <?php 
                                if($result){
                                        while ($row = mysqli_fetch_row($result)) {
                                             print('<option value="'.$row[0].'">'.$row[1].'</option>');
                                        }
                                    }
                                ?>
                            </select>
                        </div> 
                        <h5 class="mt-5">Информация об оборудовании</h5>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-laptop"></i></span>
                            </div>
                                <input type="text" name="hw_name" class="typeahead form-control " maxlength="300" placeholder="Наименование оборудования" aria-label="Name" aria-describedby="basic-addon1">
                        </div>

                        <div class="form-group mb-3">
                            <input type="text" name="sn_hw" class="form-control" maxlength="50" placeholder="Серийный номер оборудования">
                        </div>
                         <div class="form-group mb-3">
                            <input type="text" name="problems" class="form-control" maxlength="300" placeholder="Заявленные неисправности">
                        </div>
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" name="warranty" class="custom-control-input" id="customSwitch1">
                            <label class="custom-control-label" for="customSwitch1" style="user-select: none;">
                                <h6>Гарантийный случай</h6>
                            </label>
                        </div>

                        <div class="form-group mb-3 ">
                            <label for="exampleFormControlTextarea1">
                                <h6>Состояние оборудования</h6>
                            </label>
                            <small class="text-muted ml-2">Осталось <span id="remain">300</span> символов</small>
                            <textarea name="device_condition" class="form-control" id="condition-textarea" rows="3" maxlength="300"></textarea>
                            <div class="border p-2 container horizontal-scrollable" style="font-size: 19px!important;">
                                <a href="javascript:void(0)" class="condition-pattern badge badge-success">Нет царапин</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-success">Нет трещин</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-success">Нет коцок</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-success">Включается</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-success">Чистый</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-warning">Есть мелкие коцки</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-warning">Плавающая проблема</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-warning">Проблема не известна</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-warning">Плавающая проблема</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-danger"> Корпус серьезно поврежден</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-danger"> Нет комплекта</a>
                                <a href="javascript:void(0)" class="condition-pattern badge badge-danger"> Не включается</a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>
    </main>
</div>
   

<script>
$(document).ready(function() {
    var maxchars = 300;
    $('#condition-textarea').on('input', function() {
        $(this).val($(this).val().substring(0, maxchars));
        var tlength = $(this).val().length;
        remain = maxchars - parseInt(tlength);
        $('#remain').text(remain);
        if ($(this).val().length == 1) {
            h = $(this).val()[0].toUpperCase();
            $(this).val(h);
        }
        $('.condition-pattern').each(function(){
            var text = [];
            text.push($(this).text());
            if ($('#condition-textarea').val().toLowerCase().indexOf($(this).html().toLowerCase()) == -1) {
                $(this).fadeIn('normal');
                $(this).show();
            } else {
                $(this).hide("drop", {direction: "up"}, 100);
            }
        });
    });

    $(".condition-pattern").click(function() {
        if (!$("#condition-textarea").val()) {
            $('#condition-textarea').val($('#condition-textarea').val() + $(this).html() + ", ");
        } else {
            $('#condition-textarea').val($('#condition-textarea').val() + $(this).html().toLowerCase() + ", ");
        }
        $("#condition-textarea").trigger("input");
        
    });
});

$(function() {
    $("#phone").mask("8 (999) 999-99-99");
});
</script>