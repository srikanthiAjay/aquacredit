function ordersFollowHistory(){

    $(window).load(function(){
      
 $(document).ready(function() {
 var dataUrl = '<?php echo base_url('admin/followups_orders_log')?>';
var options = [
  { key : 'option 1', value : 1 },
  { key : 'option 2', value : 2 },
  { key : 'option 3', value : 3 }
];

var rowCache = [];

function mouseUp(event)
{
  var ctrl = $(document.elementsFromPoint(event.clientX, event.clientY)).filter('input.border-highlight');
    
  if (ctrl.length > 0 && rowCache.length > 0)
  {
    var el = rowCache[0];
    var data = el.row.data();
    
    if (data.length > 0)
    {
      ctrl.val(data[0].name);
      el.row.remove().draw();
    }
  } 
  
  rowCache = [];
  $('#example tr td:nth-child(6) input').removeClass('border-highlight');
}

$(document).ready(function() {
  var $table = $('#example');
  var dataTable = null;

  $('body').mouseup(mouseUp);
  
  $table.on('mousedown', 'td .fa.fa-minus-square', function(e) {
  
    var $row = $(this).closest("tr");
    var $input = $(this).find('td');

    $row.find('td').not(':nth-child(6)').not(':last').each(function(i, el) {
      var $input = $(this).find('td');
      if(i == 0)
      deleteOrdersLog($input.context.textContent);  
      dataTable.row($(this).closest("tr")).remove().draw();
    });

    //dataTable.row($(this).closest("tr")).remove().draw();
  });

  $table.on('mousedown.edit', 'i.fa.fa-pencil-square', function(e) {
    enableRowEdit($(this));
  });

  $table.on('mousedown', 'input', function(e) {
    e.stopPropagation();
  });

  $table.on('mousedown.save', 'i.fa.fa-envelope-o', function(e) {
    updateRow($(this), true); // Pass save button to function.
  });

  $table.on('mousedown', '.select-basic', function(e) {
    e.stopPropagation();
  });

  dataTable = $table.DataTable({
    ajax: {
        "url": dataUrl,
        "type": "POST",
        dataType: "json",

    },
    rowReorder: {
      dataSrc: 'order',
      selector: 'tr'
    },
    columns: [{
      data: 'id'
    }, {
      data: 'created_on'
    }, {
      data: 'c_name'
    },
    {
      data: 'c_mobile'
    },
    {
      data: 'area'
    },
    {
      data: 'status'
    },
    {
      data: 'remarks'
    },
    {
      data: 'product'
    },
    {
      data: 'brand'
    },
    {
      data: 'qty'
    },
    {
      data: 'local_price_user_gets'
    },
    {
      data: 'best_price_offered'
    },                                    
    {
      data: 'delete'
    }
    ]
  });

  $table.css('border-bottom', 'none')
        .after($('<div>').addClass('addRow')
          .append($('<button>').attr('id', 'addRow').text('Add New Row')));

  // Add row
  $('#addRow').click(function() {
    var $row = $("#new-row-template").find('tr').clone();
    dataTable.row.add($row).draw();
    // Toggle edit mode upon creation.
    var filter_length = $('#example_length select').val();
    var table_api = $('#example').dataTable();
    var table_tot=table_api.fnGetData().length;



      enableRowEdit($table.find('tbody tr:first-child td i.fa.fa-pencil-square'));      

    //enableRowEdit($table.find('tbody tr:last-child td i.fa.fa-pencil-square'));
  });

  $('#btn-save').on('click', function() {
    updateRows(true); // Update all edited rows
  });

  $('#btn-cancel').on('click', function() {
    updateRows(false); // Revert all edited rows
  });

  function enableRowEdit($editButton) {
    $editButton.removeClass().addClass("fa fa-envelope-o");
    var $row = $editButton.closest("tr").off("mousedown");

    $row.find("td").not(':nth-child(1)').not(':nth-child(2)').not(':nth-child(6)').not(':last').each(function(i, el) {
      enableEditText($(this))
    });

    $row.find('td:nth-child(6)').each(function(i, el) {
      enableEditSelect($(this))
    });
  }

  function enableEditText($cell) {
    var txt = $cell.text();

    $cell.empty().append($('<input>', {
      type : 'text',
      value : txt
    }).data('original-text', txt));
  }

  function enableEditSelect($cell) {
    var txt = $cell.text();
    $cell.empty().append($('<select>', {
      class : 'select-basic'
    }).append(options.map(function(option) {
      return $('<option>', {
        text  : option.key,
        value : option.value
      })
    })).data('original-value', txt));
}

  function updateRows(commit) {
     $table.find('tbody tr td i.fa.fa-envelope-o').each(function(index, button) {
      updateRow($(button), commit);
    });
  }


  function updateRow($saveButton, commit) {
    


    var orders_input = [];
    var result = [];
    var res_data = [];
    var luserid = $('#luserid').val();
    $saveButton.removeClass().addClass('fa fa-pencil-square');
    var $row = $saveButton.closest("tr");
    $row.find('td:nth-child(6)').each(function(i, el) {
      var $input = $(this).find('select');
      orders_input.push({'id':el.cellIndex,'value': $input.val()});
      $(this).text(commit ? $input.val() : $input.data('original-value'));
    });
    $row.find('td').not(':last').each(function(i, el) {
      var $input = $(this).find('input');
      // console.log(i+":"+$input.val());
    if(i== 0 || i== 1)
      orders_input.push({'id':el.cellIndex,'value': $input.context.textContent});
    else
    if(i == 11)
    {
      prev=$(this);
      if(i!=5)
      orders_input.push({'id':el.cellIndex,'value': $input.val()});
      orders_input.push({'id':el.cellIndex+1,'value': luserid});

                  $.when(updateOrdersLog(orders_input,$(this))).then(function( data, textStatus, jqXHR ) {
                    result.push(data.data);                                           
     $.each(result[0], function (key, data) {
        prev.text(commit ? $input.val() : $input.data('original-text'));
        res_data.push(data);
    })
          res_data.push(luserid);
          updateFields($row,res_data,commit);
                  });
    }else{
      orders_input.push({'id':el.cellIndex,'value': $input.val()});
      $(this).text(commit ? $input.val() : $input.data('original-text'));
    }
      //$(this).text(commit ? $input.val() : $input.data('original-text'));
     //Math.floor((Math.random() * 1000000) + 1);
     
     //orders_input.push({'id':el.cellIndex,'value': $input.val()});  
    });
  }
});

$('.orders_hst').on('click',function(){
        $('#tab-orders-history').show();
        $('#tab-followups').hide();
});
$('.orders_flws').on('click',function(){
        $('#tab-orders-history').hide();
        $('#tab-followups').show();
});



$('#follwUp').on('hide.bs.modal', function (e) {
    //do something..
      $('.orders_hst').removeClass('active');
      $('.orders_flws').addClass('active');
})
         

function updateOrdersLog(data){
console.log(data);
           return $.ajax({
              url: '<?php echo base_url('admin/updateOrdersLog')?>',
              dataType: "json",
              type : 'POST',
              data:{data:data},
              success: function( data ) {
                
              }
            });
}

function deleteOrdersLog(id){
           return $.ajax({
              url: '<?php echo base_url('admin/deleteOrdersLog')?>',
              dataType: "json",
              type : 'POST',
              data:{id:id},
              success: function( data ) {
                
              }
            });
}

    
});

    });

function updateFields(row,value,commit){
console.log('-------------------');  
console.log(value);  

    row.find('td').not(':nth-child(6)').not(':last').each(function(i, el) {
      var $input = $(this).find('input');
      if(i == 1)
      $(this).text(commit ? value[11] : $input.data('original-text'));
      else if(i ==2)
      $(this).text(commit ? value[1] : $input.data('original-text'));
      else if(i ==3)
      $(this).text(commit ? value[2] : $input.data('original-text'));
      else if(i ==4)
      $(this).text(commit ? value[3] : $input.data('original-text'));          
      else       
      $(this).text(commit ? value[i] : $input.data('original-text'));          
     //Math.floor((Math.random() * 1000000) + 1);
     
     //orders_input.push({'id':el.cellIndex,'value': $input.val()});  
    });
}

}