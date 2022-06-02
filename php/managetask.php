<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>

<div class=" p-5">  
    <h1 class="display-4">Управление заказами</h1>
    <div class="help"></div>
<table id="table"
  data-pagination="true"
  data-pagination-h-align="left"
  data-pagination-detail-h-align="right"
  data-show-refresh="true"
  data-show-toggle="true"
  data-search="true"
  data-detail-view="true"
  data-detail-view-icon="true"
  data-row-attributes="rowAttributes"
  data-show-columns="true"
  data-detail-formatter="idorderfrm"
  >
  <thead>
    <tr>
      <!-- <th data-field="ID_client" >Клиент</th> -->
      <th data-sortable="true" data-field="ID_order" >Заказ</th>
      <th data-sortable="true" data-field="Name_client" >Имя</th>
      <th data-sortable="true" data-field="phone_client" >Телефон</th>
      <th data-sortable="true" data-field="sn_hw_order" >С/Н</th>
      <th data-sortable="true" data-field="name_hw_order" >Наименование</th>
      <th data-sortable="true" data-field="order_datetime" >Дата заявки</th>
      <!-- <th data-sortable="true" data-field="warranty_order" >Гарантия</th> -->
      <th data-sortable="true" data-field="price_order" >Стоимость</th>
      <th data-sortable="true" data-field="device_condition" >Состояние устройства</th>
      <th data-formatter="operateFormatter" data-events="operateEvents">Статус</th>
      <!-- <th data-field="order_end_datetime">Заявка выполнена</th> -->
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">ОК</button>
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
        <button type="button" class="btn btn-primary" data-dismiss="modal">ОК</button>
      </div>
    </div>
  </div>
</div>


<?php   
  
  $result = $mysql->query("SELECT * FROM `client_orders` JOIN `clients` USING (`ID_client`)");
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
        'Дата завершения: ' + row.order_end_datetime+ '\t\n',
        'Гарантия: ' + row.warranty_order
      ].join(' ')
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
    'click .takeord': function (e, value, row) {
      $.post( "database.php", { action:"setmaster", ID_order:JSON.parse(row.ID_order) })
        .done(function( data ) {
            if (data=' '){
            $('#AddModal').modal('show');
            $('.modal-body').html('<p class="col-form">Заказ <strong class="ID_order"></strong> закреплен</p><p class="col-form">Сотрудник: <span class="ID_empl"><strong>Потемка Даниил</strong></span></label>');
            $('.ID_order').html(row.ID_order);    
            } else {
              $('#ErrorModal').modal('show');
               $('.modal-body').html('<p class="col-form">Заказ <strong class="ID_order"></strong> уже занят</p>');
              $('.ID_order').html(row.ID_order);  
          }
        });
    },
    'click .doneord': function (e, value, row) {
      $.post( "database.php", { action:"doneorder", ID_order:JSON.parse(row.ID_order) })
        .done(function( data ) {
            if (data=' '){
              $('#AddModal').modal('show');
            $('.modal-body').html('<p class="col-form">Заказ <strong class="ID_order"></strong> завершен</p><p class="col-form">Сотрудник: <span class="ID_empl"><strong>Потемка Даниил</strong></span></label>');
            $('.ID_order').html(row.ID_order);
            }else{
              $('#ErrorModal').modal('show');
               $('.modal-body').html('<p class="col-form nomaster">Заказ <strong class="ID_order"></strong> не может быть выполнен</p>');
              $('.ID_order').html(row.ID_order);  
               $('.err_reason').html('Причина: '+data); 
                
          }
        });
    },
    'click .closeord': function (e, value, row) {
      $.post( "database.php", { action:"closeorder", ID_order:JSON.parse(row.ID_order) })
        .done(function( data ) {
            if (data=' '){
            $('#AddModal').modal('show');
            $('.modal-body').html('<p class="col-form">Заказ <strong class="ID_order"></strong> закрыт</p><p class="col-form">Сотрудник: <span class="ID_empl"><strong>Потемка Даниил</strong></span></label>');
            $('.ID_order').html(row.ID_order);    
            } else {
              $('#ErrorModal').modal('show');
               $('.modal-body').html('<p class="col-form nomaster">Заказ <strong class="ID_order"></strong> не может быть завершен</p>');
              $('.ID_order').html(row.ID_order);  
          }
        });
    }
  }

      
  function operateFormatter(value, row, index) {
    return [ '<div class="text-center" style="font-size:22px;">', '<a class="takeord" href="javascript:void(0)" title="Закрепить заказ">', '<i class="fas fa-arrow-circle-right"></i>', '</a>  ', '<a class="doneord text-success" href="javascript:void(0)" title="Завершить заказ">', '<i class="fas fa-check-circle"></i>', '</a>  ', '<a class="closeord text-danger" href="javascript:void(0)" title="Закрыть заказ">', '<i class="fas fa-times-circle"></i>', '</a>  ', '</div>' ].join('')
  }
</script>
<script>  
  function idorderfrm(index, row) {
    return '<p> <b>Элемент</b>: '
    + index 
    + '</p><p><b>Заказ</b>: ' 
    + row.ID_order 
    + '</p><p> <b>Имя</b>: ' 
    + row.Name_client 
    + '</p><p> <b>Номер телефона клиента</b>: ' 
    + row.phone_client 
    + '</p><p> <b>Серийный номер</b>: ' 
    + row.sn_hw_order 
    + '</p><p> <b>Наименование</b>: ' 
    + row.name_hw_order 
    + '</p><p> <hr /> <b>Дата заказа</b>: ' 
    + row.order_datetime 
    + '</p><p> <b>Дата начала исполнения</b>: ' 
    + row.exec_order_start 
    + '</p><p> <b>Дата завершения</b>: ' 
    + row.exec_order_end
    + '</p><p> <b>Дата закрытия</b>: ' 
    + row.order_end_datetime
    + '</p><hr /><p> <b>Гарантия</b>: ' 
    + row.warranty_order 
    + '</p><p> <b>Стоимость</b>: ' 
    + row.price_order 
    + '</p><p> <b>Состояние</b>: ' 
    + row.device_condition
    +'</p>' 
  }
</script>