var input_var = ['total_puskesmas','total_rs', 'total_klinik', 'total_pustu', 'total_balai_pemerintah', 'total_balai_swasta'];

var new_input_var = [];
var i = 0;
$.each(input_var, function(index, el) {
  new_input_var[i] = {'input':el,'data':'data-'+el.replace(/_/g,'-')};
  i++;
});
var input_var = new_input_var;
var dss_url = 'dss_5_2';

var user_type = $('#user_type').val();
var id_instansi_user = $('#id_instansi_user').val();
var id_instansi_tabel = $('#id_instansi_tabel').val();

var list_template = JSON.parse($('tr[data-control="list-template"]').attr('record-list'));

function default_button(){
  $('#btn-cancel').addClass('d-none');
  $('#btn-save').addClass('d-none');
  $('#btn-edit').removeClass('d-none');
  $('#btn-delete').removeClass('d-none');
  $('.btn-group').removeClass('d-none');
}

function get_data_rows(){
  var year = $('#year').val();
  $('td[data-control^="data-total"]').html('');
  $('input[type="hidden"]').remove();
  $('td[id^="all_total"]').html('');
  // $('#not_ready_notification').addClass('d-none');

  $.ajax({
      type: 'get',
      url: base_url+'dss/'+dss_url+'/get_data_by_year/'+year,

      beforeSend : function() {
        $('#table-data').block(circle_segmented_loading);
      },
      complete: function () {
        $('#table-data').unblock();
      },
      success:function(query)
      {
        set_dss_date_information(query);
        if(query.length > 0){
          var status = query[0].status;
          set_dss_status(status);

          function show_data()
          {
            $.each(query, function(index, value){
              $.each(input_var, function(i, el){
                $('tr[kelurahan-id="'+value.id_kelurahan+'"]').find('td[data-control="'+el.data+'"]').text(empty_if_false(value[el.input]));
              });
            })
          }

          if(status == 1)
          {
            if(user_type == 'admin' || (user_type =='instansi' && id_instansi_user == id_instansi_tabel))
            {
              show_data();
              get_total_sum();
            }
            else{
              $('#not_ready_notification').removeClass('d-none');
            }
          }
          else{
            show_data();
            get_total_sum();
          }
        }
        else
        {
          set_dss_status(0);
        }
      },
      error:function(){
        console.log('No data..!!');
      }
  })
}

function get_total_sum(){
  var sum = {};
  var sum_kecamatan = {};
  $.each(input_var,function(index_input, value_input) {
    sum[value_input.input] = 0;
    sum_kecamatan[value_input.input] = 0;
  });
  $('tr[data-control="row"]').each(function() {
    var tr = $(this);
    $.each(input_var,function(index_input, value_input) {
      var value = empty_if_zero(parseFloat(tr.find('td[data-control="'+value_input.data+'"]').text()));
      if(value > 0) {
          sum[value_input.input] += value;
      }
    });
  });

  $.each(input_var,function(index_input, value_input) {
    $('td#all_'+value_input.input).text(sum[value_input.input]);
  });

  $('tr[data-control="data-kecamatan"]').find('td[data-control^="data-total"]').text('');
  $('tr[data-control="data-kecamatan"]').each(function() {
    var tr_kecamatan = $(this);
    var kecamatan_id = tr_kecamatan.attr('kecamatan-id');
    $.each(input_var,function(index_input, value_input) {
      sum_kecamatan[value_input.input] = 0;
      $('td[data-control="'+value_input.data+'"][kecamatan-id="'+kecamatan_id+'"]').each(function() {
        var value = parseFloat($(this).text());
        if(value > 0) {
          sum_kecamatan[value_input.input] += value;
        }
      });
      tr_kecamatan.find('td[data-control="'+value_input.data+'"]').text(empty_if_zero(sum_kecamatan[value_input.input]));
    });
  });
}

window.onload = function ()
{
  get_data_rows();
  loadgrafik(dss_url);
}

$(document).on('change','#year', function(event){
  event.preventDefault();

  get_data_rows();
  if(user_type == 'admin' || (user_type =='instansi' && id_instansi_user == id_instansi_tabel)){
    default_button();
  }
});

$(document).ready(function(){
  $('#btn-edit').click(function(event){
    event.preventDefault();

    var year = $('#year').val();
    $.ajax({
      type: 'get',
      url: base_url+'dss/'+dss_url+'/get_data_by_year/'+year,

      success:function(query)
      {
        var user_type = $('#user_type').val();
        var id_instansi_user = $('#id_instansi_user').val();
        var id_instansi_tabel = $('#id_instansi_tabel').val();

        if(query.length > 0) {
          if(query[0].status === 2 && user_type === 'instansi' && id_instansi_user === id_instansi_tabel) {
            notify_alert("Data sudah di-publish. Silakan hubungi admin..",'warning');
            default_button();
          }
          else {
            show_form();
          }
        }
        else {
          show_form();
        }

        function show_form()
        {
          $('td[data-control^="data-total"]').html('');
          $('td[id^="all_total"]').html('');

          $('tr[data-control="row"]').each(function(){
            var tr=$(this);
            var data_index = $(this).attr('data-index');
            var record=query[data_index];
            if(query.length > 0) {
              //inputbox hidden untuk id_kelurahan
              var input_hidden_id='<input type="hidden" data-control="data-template" name="data_input['+data_index+'][id_kelurahan]" value="'+record.id_kelurahan+'">';
              tr.find('td[data-control="data-list"]').append(input_hidden_id);

              //inputbox untuk edit : total_aman, total_rendah, total_sedang, total_tinggi
              $.each(input_var, function(index, el){            
                var input='<input type="number" data-control="'+el.data+'" name="data_input['+data_index+']['+el.input+']" value="'+empty_if_false(record[el.input])+'" class="input-data-table form-control text-center w-100">';
                tr.find('td[data-control="'+el.data+'"]').append(input);
              });
            }
            else{
              //inputbox hidden untuk id_kelurahan
              var input_hidden_id_template='<input type="hidden" data-control="id-template" name="data_input['+data_index+'][id_kelurahan]" value="'+list_template[data_index].id_kelurahan+'" class="input-data-table form-control text-center w-100">';
              tr.find('td[data-control="data-list"]').append(input_hidden_id_template);

              //inputbox untuk edit : total_aman, total_rendah, total_sedang, total_tinggi
              $.each(input_var, function(index, el){            
                var input='<input type="number" data-control="'+el.data+'" name="data_input['+data_index+']['+el.input+']" value="" class="input-data-table form-control text-center w-100">';
                tr.find('td[data-control="'+el.data+'"]').append(input);
              });
            }
          })
        }
      },
      error:function(){
        console.log('Gagal mengambil data..!!');
      }
    });
  });

  $('#btn-cancel').click(function(event){
    event.preventDefault();

    get_data_rows();
    default_button();
  });
});

$('#btn-save').click(function(event) {
  event.preventDefault();
  $.ajax({
    url: base_url+"dss/"+dss_url+"/store",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    async: true,
    cache: false,
    dataType: 'json',
    data: $('#form-data-table').serialize(),
    type: 'post',
    beforeSend : function(xhr) {
      $('#table-data').block(circle_segmented_loading_top);

      $('input[type="text"].input-data-table').each(function() {
        if(!$.isNumeric($(this).val())){
          if($(this).val()){
            notify_alert('Input must be number','warning');
            $(this).focus();
            $('#table-data').unblock();
            xhr.abort();
          }
        }
      });
    },
    complete: function () {
      save_data_table_behavior();
      $('#table-data').unblock();
    },
    success: function (data)    {
      if(data.status == 0){
          console.log('Gagal menyimpan data..!!');
        }
        else
        {
          notify_alert("Data telah disimpan...",'success')
          get_data_rows();
          // default_button();
        }
    },
    error : function(XMLHttpRequest, textStatus, errorThrown) {
      notify_alert(textStatus,'danger');
    }
  });
});

$('#btn-delete').click(function(event) {
  event.preventDefault();
  bootbox.confirm({
    message: "Hapus Data Tahun "+ $('select[name=year] option:selected').text()+"?",
    buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
    },
    callback: function (result) {
        // console.log('This was logged in the callback: ' + result);
        if(result == true){
          $.ajax({
            url: base_url+"dss/"+dss_url+"/delete",
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            async: true,
            cache: false,
            dataType: 'json',
            data: $('#form-data-table').serialize(),
            type: 'post',
            beforeSend : function() {
              $('#table-data').block(circle_segmented_loading_top);
            },
            complete: function () {
              $('#table-data').unblock();
              // save_data_table_behavior();
            },
            success: function (data) {
              if(data.status == 0){              
                }
              else
              {
                notify_alert("Data Tahun "+$('select[name=year] option:selected').text()+" telah dihapus...",'success')
                get_data_rows();
                set_dss_status('empty');
              }
            },
            error : function(XMLHttpRequest, textStatus, errorThrown) {
              notify_alert(textStatus,'danger');
            }
          });
        }else{
          notify_alert('canceled')
        }
    }
  });
});

$('#btn-set-verification').click(function(event) {
  event.preventDefault();
  $.ajax({
    url: base_url+"dss/"+dss_url+"/set_verification",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    async: true,
    cache: false,
    dataType: 'json',
    data: $('#form-data-table').serialize(),
    type: 'post',
    beforeSend : function() {
      $('#table-data').block(circle_segmented_loading_top);
    },
    complete: function () {
      $('#table-data').unblock();
    },
    success: function (data) {
      notify_alert(data.message,data.style);
      if(data.status == 1){
        set_dss_status('verification');
      }
    },
    error : function(XMLHttpRequest, textStatus, errorThrown) {
      notify_alert(textStatus,'danger');
    }
  });
});

$('#btn-set-publish').click(function(event) {
  event.preventDefault();
  $.ajax({
    url: base_url+"dss/"+dss_url+"/set_publish",
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    async: true,
    cache: false,
    dataType: 'json',
    data: $('#form-data-table').serialize(),
    type: 'post',
    beforeSend : function() {
      $('#table-data').block(circle_segmented_loading_top);
    },
    complete: function () {
      $('#table-data').unblock();
    },
    success: function (data) {
      notify_alert(data.message,data.style);
      if(data.status == 1){
        set_dss_status('publish');
      }
    },
    error : function(XMLHttpRequest, textStatus, errorThrown) {
      notify_alert(textStatus,'danger');
    }
  });
});
