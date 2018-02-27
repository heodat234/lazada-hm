$(function() {
    $('input[type="checkbox"]').show();
    $('#btn-admin').on('click', function(){
        if($("#toolbar-admin").is(":visible"))
        {
        $("#toolbar-admin").hide();
        $('input[type="checkbox"]').hide();
        }
        else
        {
            $("#toolbar-admin").show();
            $('input[type="checkbox"]').show();
        }
  });  
});

function addRow(tableID) {

      var table = document.getElementById(tableID).getElementsByTagName('tbody')[0];

      var rowCount = table.rows.length;
      var row = table.insertRow(rowCount);

      var colCount = table.rows[0].cells.length;

      for(var i=0; i<colCount; i++) {

        var newcell = row.insertCell(i);

        newcell.innerHTML = table.rows[0].cells[i].innerHTML;
        // alert(newcell.childNodes);
        switch(newcell.childNodes[0].type) {
          case "text":
              newcell.childNodes[0].value = "";
              break;
          case "checkbox":
              newcell.childNodes[0].checked = false;
              break;
          case "select-one":
              newcell.childNodes[0].selectedIndex = 0;
              break;
        }
      }
      renameAllRow(tableID);
    }
function deleteRow(tableID) {
  try {
  var table = document.getElementById(tableID).getElementsByTagName('tbody')[0];
  var rowCount = table.rows.length;

  for(var i=0; i<rowCount; i++) {
    var row = table.rows[i];
    var chkbox = row.cells[0].childNodes[0];
    if(null != chkbox && true == chkbox.checked) {
      if(rowCount <= 1) {
        // alert("Cannot delete all the rows.");
        var colCount = table.rows[i].cells.length;
        for(var j=0; j<colCount; j++){
          var cell = table.rows[i].cells[j];
          cell.getElementsByTagName('input')[0].value = '';
        }
        break;
      }
      table.deleteRow(i);
      rowCount--;
      i--;
    }


  }
  renameAllRow(tableID);
  }catch(e) {
    alert(e);
  }
}
function renameAllRow(tableID){
  var table = document.getElementById(tableID).getElementsByTagName('tbody')[0];

  var rowCount = table.rows.length;
  var colCount = table.rows[0].cells.length;

  for(var i=0; i<rowCount; i++) {
    for(var j=0; j<colCount; j++){
      var cell = table.rows[i].cells[j];
      var name = '';
      switch(j) {
          case 1:
              name = 'product['+i+'][id_sanpham]';
              break;
          case 2:
              name = 'product['+i+'][qty]';
              break;
          case 3:
              name = 'product['+i+'][sales_deliver]';
              break;
          case 4:
              name = 'product['+i+'][phi_co_dinh]';
              break;
          case 5:
              name = 'product['+i+'][phi_khac]';
              break;
          case 6:
              name = 'product['+i+'][phi_gtgt]';
              break;
          case 7:
              name = 'product['+i+'][khoan_wht]';
              break;
          case 8:
              name = 'product['+i+'][khoan_thanh_toan]';
              break;
          default:
            break;
        }
      cell.getElementsByTagName('input')[0].name = name;
      // console.log(cell.getElementsByTagName('input')[0].name);
    }
  }
}

$("#check-all").change(function () {
    $("input:checkbox").prop('checked', $(this).prop("checked"));
});