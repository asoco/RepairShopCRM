<link href="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.css" rel="stylesheet">
<script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://unpkg.com/bootstrap-table@1.16.0/dist/extensions/export/bootstrap-table-export.min.js"></script>

<div class=" p-5">  
    <h1 class="display-4">Создать отчет</h1>

<table id="table"
  data-pagination="true"
  data-pagination-h-align="left"
  data-pagination-detail-h-align="right"
  data-show-refresh="true"
  data-search="true"

   data-detail-view="true"
     data-row-attributes="rowAttributes"
   data-detail-formatter="idorderfrm"
  
  >
  <thead>
    <tr>
      <th data-sortable="true" data-field="ID_order">Заказ</th>
      <th data-sortable="true" data-field="Name_client">Имя</th>
      <th  data-field="phone_client">Телефон</th>
      <th data-field="name_hw_order">Наименование</th>
      <th data-sortable="true" data-field="order_datetime">Дата заявки</th>
      <th data-sortable="true" data-field="price_order">Стоимость</th>
      <th data-formatter="operateFormatter"
          data-events="operateEvents">Отчет</th>
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
  
  $result = $mysql->query("SELECT * FROM `client_orders` JOIN `clients` USING (`ID_client`) "  );
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
      height: 750,
      locale: 'ru-RU'
    })
  })

  function detailFormatter(index, row) {
    var html = []
    $.each(row, function (key, value) {
      html.push('<p><b>' + key + ':</b> ' + value + '</p>')
    })

    return html.join('')
  }

// управление заказами
  window.operateEvents = {
    'click .print': function (e, value, row) {
    var form = document.createElement('form');
    document.body.appendChild(form);
    form.method = 'post';
    form.action = 'index.php?page=page';
    for (var name in row) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = row[name];
        form.appendChild(input);
    }
    form.submit();
       // window.location.replace('index.php?page=page');
    }
  }

  function operateFormatter(value, row, index) {
    return [
      '<div class="text-center" style="font-size:22px;">',
      '<a class="print" href="javascript:void(0)" title="Like">',
      '<i class="fas fa-print"></i>',
      '</a>  ',
      '</div>'
    ].join('')
  }
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
    + '</p>' 
  }
</script>
