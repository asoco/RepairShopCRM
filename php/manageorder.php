<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>

<style>
  .select,
  #locale {
    width: 100%;
  }
  .like {
    margin-right: 10px;
  }
</style>

<div class=" p-5">  
    <h1 class="display-4">Склад</h1>

<table id="table"
  data-pagination="true"
  data-pagination-h-align="left"
  data-pagination-detail-h-align="right"
  data-show-refresh="true"
  data-search="true"
  data-detail-view="true"
  data-detail-formatter="idorderfrm"
  data-show-columns-toggle-all="true"
  >
  <thead>
    <tr>
      <th data-field="ID_cat_part" >ID</th>
      <th data-field="Vendor_part" >Производитель</th>
      <th data-field="Name_part" >Наименование</th>
      <th data-field="Condition_part" >Ссостояние</th>
      <th data-field="Color_part" >Цвет</th>
      <th data-field="Price_part" >Цена</th>
      <th data-field="Quantity_part" >Сток</th>
      <th data-field="Status_delivery" >Доставка</th>
      <th data-field="Name_provider" >Поставщик</th>
      <th data-formatter="operateFormatter"
          data-events="operateEvents">Склад</th>
    </tr>
  </thead>
</table> 

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Успех</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button id="modalbtn" type="button" class="btn btn-primary" data-dismiss="modal">Хорошо</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="ErrorModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ошибка</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <div class="err_reason"></div>
        <button type="button" id="modalbtn" class="btn btn-primary" data-dismiss="modal">Отмена</button>
      </div>
    </div>
  </div>
</div>


<?php   
  
  $result = $mysql->query("SELECT * FROM `catalog_parts` JOIN `providers` USING (`ID_provider`) WHERE `Status_delivery`='Доставлено' ");
  $dbdata = array();
  while ( $row = $result->fetch_assoc())  {
  $dbdata[]=$row;
  }
  ?>

<script>


  $('#modalbtn').click(function(){
    window.location.reload();
  });

  function rowAttributes(row, index) {
    return {
      'data-toggle': 'popover',
      'data-placement': 'bottom',
      'data-trigger': 'hover',
      'data-content': [
        'Дата завершения: ' + row.order_end_datetime,
        'Гарантия: ' + row.warranty_order
      ].join('')
    }
  }

  $(function() {
    $('#table').on('post-body.bs.table', function (e) {
      $('[data-toggle="popover"]').popover()
    })
  })

  var $table = $('#table')

  $(function() {
    var data = <?php echo json_encode($dbdata); ?>
  
    $table.bootstrapTable({
      data: data,
      escape: true,
      height: 700,
      locale: 'ru-RU'
    })
  })


// управление заказами
  window.operateEvents = {
    'click .takethis': function (e, value, row) {
           $.post( "database.php", { action:"takethis", ID_cat_part:JSON.parse(row.ID_cat_part) })
        .done(function( data ) {
            if (data=' '){

            $('#AddModal').modal('show');
            $('.modal-body').html('<p class="col-form">Вы взяли <strong class="Name_part"></strong></p>');
            $('.Name_part').html(row.Name_part);    
            } else {
              $('#ErrorModal').modal('show');
               $('.modal-body').html('<p class="col-form"><strong class="Name_part"></strong> не может быть взят</p>');
              $('.Name_part').html(row.Name_part); 
              $('.err_reason').html('Причина: '+data); 
          }
        });

    }
  }

  function operateFormatter(value, row, index) {
    return [
      '<div class="text-center" style="font-size:22px;">',
      '<a class="takethis" href="javascript:void(0)" title="Like">',
      '<i class="fas fa-arrow-circle-right"></i>',
      '</a>  ',
      '</div>'
    ].join('')
  }

    function idorderfrm(index, row) {
    return '<p> <b>Элемент</b>: '
    + index 
    + '</p><p><b>Код поставщика</b>: ' 
    + row.ID_provider 
    + '</p><p> <b>Поставщик</b>: ' 
    + row.Name_provider
    + '</p><p> <b>Адрес поставщика</b>: ' 
    + row.Adress_provider
    + '</p><p> <b>Телефон поставщика</b>: ' 
    + row.Phone_provider
    + '</p><p> <b>Представитель</b>: ' 
    + row.Name_Rprsnt
    + '</p><hr /><p> <b>Код_каталог</b>: ' 
    + row.ID_cat_part 
    + '</p><p> <b>Производитель</b>: ' 
    + row.Vendor_part
    + '</p><p> <b>Наименование</b>: ' 
    + row.Name_part 
    + '</p><p> <b>Стоимость</b>: ' 
    + row.Price_part
    + '</p><p> <b>Цвет</b>: ' 
    + row.Color_part
    + '</p><p> <b>Состояние</b>: ' 
    + row.Condition_part
    + '</p><p>  <b>Количество</b>: ' 
    + row.Quantity_part
    + '</p><p> <b>Статус доставки</b>: ' 
    + row.Status_delivery
    +'</p>' 
  }
</script>