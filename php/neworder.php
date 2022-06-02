<!-- новый заказ  -->
<style>.card {display:inline-block;}</style>
<script type="text/javascript" src="js/typeahead.js"></script>
<link href="css/typeahead.css" rel="stylesheet" />
<style>
    .list-group { width: 100%;}
    </style>
<?php   
 $provname = Null;
  $result = Null;
  $result = $mysql->query("SELECT `Name_provider` FROM `providers`");
?>
<div class="container p-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="form-group col-md-12">
                    <h1 class="display-4">Заказ комплектующих</h1>
                    <form action="database.php" method="POST">
                        <input type='hidden' name='action' value='neworder'>
                        <h5>Выберите поставщика</h5>
                        <div class="input-group mb-3">
                            <select class="custom-select mr-sm-2" name="Provider_part" id="inlineFormCustomSelect">
                                <?php 
                                if($result){
                                        while ($row = mysqli_fetch_row($result)) {
                                             print('<option value="'.$row[0].'">'.$row[0].'</option>');
                                        }
                                    }
                                ?>
                            </select>
                        </div>
                        <h5 class="mt-4">Составьте заказ</h5>
                        <div class="card mb-3 shadow" style="width: 100%;">
                            <div class="card-body">
                                <div class="input-group  mb-3 orderline">
                                    <input type="text" name="Vendor_part" class="form-control" placeholder="Производитель" aria-label="" maxlength="20" aria-describedby="basic-addon1" style="max-width: 100px;">
                                    <input type="text" name="Name_part" class="form-control" maxlength="300" placeholder="Наименование">
                                    <select class="custom-select " name="Color_part" id="inlineFormCustomSelect" value="Цвет" style="max-width: 150px;">
                                        <option disabled selected>Цвет</option>
                                        <option value="Черный">Черный</option>
                                        <option value="Серебристый">Серебристый</option>
                                        <option value="Золото">Золото</option>
                                        <option value="Белый">Белый</option>
                                        <option value="Красный">Красный</option>
                                    </select>
                                    <select class="custom-select " name="Condition_part" id="inlineFormCustomSelect" placeholder="Состояние" style="max-width: 120px;">
                                        <option disabled selected>Состояние</option>
                                        <option value="Новое">Новое</option>
                                        <option value="Б/У">Б/У</option>
                                    </select>
                                    <input type="number" name="Quantity_part" min="1" max="100" class="form-control" id="inputAddress" maxlength="50" value="1" style="max-width: 100px;">
                                </div>
                                <div class="input-group  mb-3 orderline">
                                    <input type="text" name="Price_part" class="form-control" placeholder="Цена">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="basic-addon2">руб</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Отправить</button>
                        <!-- <button type="button" class="btn btn-outline-success addlinebtn"><i class="fas fa-plus"></i></button> -->
                    </form>
                </div>
            </div>
        </div>
        <hr>
    </div>
    </main>
</div>

<script>
$(document).ready(function () {
    $(" select").on("change", function () {
        var value = this.value;
        $.ajax({
            url: "index.php?page=neworder",
            type: "POST",
            data: {
                value: value,
            },
        });
    });
    var maxchars = 300;
    $("#condition-textarea").on("input", function () {
        $(this).val($(this).val().substring(0, maxchars));
        var tlength = $(this).val().length;
        remain = maxchars - parseInt(tlength);
        $("#remain").text(remain);
        if ($(this).val().length == 1) {
            h = $(this).val()[0].toUpperCase();
            $(this).val(h);
        }
        $(".condition-pattern").each(function () {
            var text = [];
            text.push($(this).text());
            if ($("#condition-textarea").val().toLowerCase().indexOf($(this).html().toLowerCase()) == -1) {
                $(this).fadeIn("normal");
                $(this).show();
            } else {
                $(this).hide(
                    "drop",

                    {
                        direction: "up",
                    },
                    100
                );
            }
        });
    });
    $(".condition-pattern").click(function () {
        if (!$("#condition-textarea").val()) {
            $("#condition-textarea").val($("#condition-textarea").val() + $(this).html() + ", ");
        } else {
            $("#condition-textarea").val($("#condition-textarea").val() + $(this).html().toLowerCase() + ", ");
        }
        $("#condition-textarea").trigger("input");
    });
});
$(function () {
    $("#phone").mask("8 (999) 999-99-99");
});
</script>