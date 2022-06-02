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
    <h1 class="display-4">Ожидается доставка:</h1>

<table id="table"
  data-pagination="true"
  data-pagination-h-align="left"
  data-pagination-detail-h-align="right"
  data-show-refresh="true"
  data-search="true"
   data-detail-view="true"
  data-show-columns-toggle-all="true"
  data-detail-formatter="idorderfrm"
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
          data-events="operateEvents">Подтвердить</th>
    </tr>
  </thead>
</table> 

<div class="modal fade" id="AddModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Вы закрепили заказ</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Хорошо</button>
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Отмена</button>
      </div>
    </div>
  </div>
</div>

<?php   
  
  $result = $mysql->query("SELECT * FROM `catalog_parts` JOIN `providers` USING (`ID_provider`) WHERE `Status_delivery`='Ожидает доставки'");
  $dbdata = array();
  while ( $row = $result->fetch_assoc())  {
  $dbdata[]=$row;
  }
  ?>
<script>
  function rowAttributes(row, index) {
    return {
      'data-toggle': 'popover',
      'data-placement': 'bottom',
      'data-trigger': 'hover',
      'data-content': [
        // 'Индекс: ' + index,
        'Представитель: ' + row.Name_Rprsnt+'\t\n',
        'Телефон: ' + row.Phone_provider+''
        
      ].join('\t\n ')
    }
  }
  $(function() {
    $('#table').on('post-body.bs.table', function (e) {
      $('[data-toggle="popover"]').popover()
    })
  })
</script>
<script>
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
</script>

<script>
  function detailFormatter(index, row) {
    var html = []
    $.each(row, function (key, value) {
      html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })
  
    return html.join('')
  }
  
  
  // управление заказами
  window.operateEvents = {
    'click .delivered': function (e, value, row) {
      $.post( "database.php", { action:"delivered", ID_cat_part:JSON.parse(row.ID_cat_part) })
        .done(function( data ) {
            if (data=' '){

            $('#AddModal').modal('show');
            $('.modal-body').html('<p class="col-form">Заказ <strong class="ID_cat_part"></strong> доставлен</p>');
            $('.ID_cat_part').html(row.ID_cat_part);    
              $table.bootstrapTable('refreshOptions', {}); 
          }else{
              $('#ErrorModal').modal('show');
               $('.modal-body').html('<p class="col-form nomaster">Заказ <strong class="ID_cat_part"></strong> не может быть принят</p>');
              $('.ID_cat_part').html(row.ID_cat_part); 
              $table.bootstrapTable('refreshOptions', {}); 
          }
        });
              
    }
  }
  
  function operateFormatter(value, row, index) {
    return [
      '<div class="text-center" style="font-size:22px;">',
      '<a class="delivered" href="javascript:void(0)" title="Like">',
      '<i class="fas fa-check-circle"></i>',
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