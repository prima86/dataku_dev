function edit_data_table_behavior(){
  $("#form-data-table input").prop("disabled", false);
  $('#btn-edit').addClass('d-none');
  $('#btn-cancel').removeClass('d-none');
  $('#btn-save').removeClass('d-none');
}
function save_data_table_behavior(){
  $("#form-data-table input").prop("disabled", true);
  $('#btn-save').addClass('d-none');
  $('#btn-cancel').addClass('d-none');
  $('#btn-edit').removeClass('d-none');
}
$(function() {
  // $("#table-data").tableExport({
  //   headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
  //   footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
  //   formats: ['xlsx','xls', 'csv', 'txt'],            // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
  //   filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
  //   bootstrap: true,                           // (Boolean), style buttons using bootstrap, (default: true)
  //   exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
  //   position: 'top',                          // (top, bottom), position of the caption element relative to table, (default: 'bottom')
  //   ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
  //   ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
  //   trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
  // });
  $("#tree").treeview({
    collapsed: false,
    animated: "medium",
    control:"#sidetreecontrol",
    persist: "location"
  });

  function search_tree_view(){
    var select_value = $('select[name=instansi]').val();
    var input_value = $('#keyword').val();
    if(input_value.length > 0 && select_value.length > 0){
      $(".items").each(function () {
        if ($(this).text().search(new RegExp(select_value, "i")) > 0 && $(this).text().search(new RegExp(input_value, "i")) > 0) {
           $(this).closest('li').show();
        } else {
          $(this).closest('li').fadeOut();
        }
      });
    }else if(input_value.length > 0 && select_value.length === 0){
      $(".items").each(function () {
        if ($(this).text().search(new RegExp(input_value, "i")) > 0) {
           $(this).closest('li').show();
        } else {
          $(this).closest('li').fadeOut();
        }
      });
    }else  if(input_value.length === 0 && select_value.length > 0){
      $(".items").each(function () {
        if ($(this).text().search(new RegExp(select_value, "i")) > 0) {
           $(this).closest('li').show();
        } else {
          $(this).closest('li').fadeOut();
        }
      });
    }else  if(input_value.length === 0 && select_value.length === 0){
        $(".items").each(function () {
          $(this).closest('li').show();
        });
      }
    }

  $("#keyword").keyup(function(event) {
    search_tree_view();
  });

  $('select[name=instansi]').on('change', function() {
    search_tree_view();
  });

  // $("#form-data-table input").prop("disabled", true);
  save_data_table_behavior();

  $('#btn-edit').click(function(event) {
    event.preventDefault();
    edit_data_table_behavior();
  });

  $('#btn-save, #btn-cancel').click(function(event) {
    event.preventDefault();
    save_data_table_behavior();
    get_data();
  });

});




// $(document).on("click","#btn-excel",function() {
//     // alert("click bound to document listening for #test-element");
//   $('.btn-toolbar').remove();
// });

var tableToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
        , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
        , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
        , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
    return function (table, name) {
        if (!table.nodeType) table = document.getElementById(table)
        var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
        var blob = new Blob([format(template, ctx)]);
        var blobURL = window.URL.createObjectURL(blob);

        if (ifIE()) {
            csvData = table.innerHTML;
            if (window.navigator.msSaveBlob) {
                var blob = new Blob([format(template, ctx)], {
                    type: "text/html"
                });
                navigator.msSaveBlob(blob, '' + name + '.xls');
            }
        }
        else
        // var ctx = {worksheet: name || 'Worksheet', table: table.innerHTML}
                //window.location.href = uri + base64(format(template, ctx))
                var link = document.createElement("a");
                    link.setAttribute("type", "hidden");
                    link.download = "filename.xls";
                    link.href = uri + base64(format(template, ctx));
                    document.body.appendChild(link);
                    link.click();
                    link.remove();
    }
})()

function ifIE() {
    var isIE11 = navigator.userAgent.indexOf(".NET CLR") > -1;
    var isIE11orLess = isIE11 || navigator.appVersion.indexOf("MSIE") != -1;
    return isIE11orLess;
}



$('#btn-excel').click(function(event) {
  event.preventDefault();
  // alert('test');
  // $('.btn-toolbar').remove();
  // $("#table-data").tableExport({
  //   headers: true,                              // (Boolean), display table headers (th or td elements) in the <thead>, (default: true)
  //   footers: true,                              // (Boolean), display table footers (th or td elements) in the <tfoot>, (default: false)
  //   formats: ['xlsx','xls', 'csv', 'txt'],            // (String[]), filetype(s) for the export, (default: ['xlsx', 'csv', 'txt'])
  //   filename: 'id',                             // (id, String), filename for the downloaded file, (default: 'id')
  //   bootstrap: true,                           // (Boolean), style buttons using bootstrap, (default: true)
  //   exportButtons: true,                        // (Boolean), automatically generate the built-in export buttons for each of the specified formats (default: true)
  //   position: 'bottom',                         // (top, bottom), position of the caption element relative to table, (default: 'bottom')
  //   ignoreRows: null,                           // (Number, Number[]), row indices to exclude from the exported file(s) (default: null)
  //   ignoreCols: null,                           // (Number, Number[]), column indices to exclude from the exported file(s) (default: null)
  //   trimWhitespace: true                        // (Boolean), remove all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s) (default: false)
  // });

  // var exportData = $("#table-data").getExportData();


  // $("#table-data").tableExport({type:'xls',escape:'false'});
  tableToExcel('table-data', 'Export HTML Table to Excel');
});
