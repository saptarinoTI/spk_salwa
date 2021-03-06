let idmulti = [];


$(".select2").select2({
    allowClear: true,
});

function toggleLayout(el){
    idmulti = [];
    if(el.text().toLowerCase() == 'add'){
        bs5showTab('#formx-tab');
        el.html("Back");
        $('.hidex').not(el).hide();
    } else {
        bs5showTab('#dataxtbl-tab');
        el.html("Add");
        $('.hidex').show();
    }
    resetForm();
}


// --- delay typing --
function delay(callback, ms) {
    var timer = 0;
    return function() {
      var context = this, args = arguments;
      clearTimeout(timer);
      timer = setTimeout(function () {
        callback.apply(context, args);
      }, ms || 0);
    };
}


//------------- table training -------------------
var columns1 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false},
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'nama_pasien',    name: 'nama_pasien'},
];

if(gejala){
    gejala.forEach((el, idx) => {
        var iterate = idx+1;
        var col = {};
        col.data = 'G' + iterate;
        col.name = 'G' + iterate;
        col.orderable = false;
        col.searchable = false;
        columns1.push(col);
    });
}

columns1.push({data: 'penyakit',    name: 'penyakit', orderable: false, searchable: false})
columns1.push({data: 'aksi',      name: 'aksi', orderable: false});

var collapsedGroups = {};
var top = '';

// ---- initialize table ----
var tbltraining = $('#tbltraining').DataTable({
    pageLength : 10,
    searchDelay: 1200,
    scrollX: false,
    scrollCollapse: true,
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getdatatraining',
        data: function (d) {
            d.filters = {
                // ini disesuaikan dengan from yang ada di controller
            };
        }
    },
    columns: columns1,
    colReorder: true,
    columnDefs: [],
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna
	},
	order: [[2, 'asc']],
    fnServerParams: function(data) {
        data['order'].forEach(function(items, index) {
            data['order'][index]['column_name'] = data['columns'][items.column]['data'];
        });
    }
});

// ---- handle group click ----
$('#tbltraining tbody').on('click', 'tr.dtrg-start', function() {
    var name = $(this).data('name');
    collapsedGroups[name] = !collapsedGroups[name];
    tbltraining.draw(false);
});

// ---- handle event on select row -----
tbltraining.on('select deselect', function (e, dt, type, indexes) {
    var data = dt.rows({selected: true}).data();

    idmulti = [];
    if(data.length > 0){

        for(var i = 0; i < data.length; i++){
            idmulti.push(data[i].id);
        }


        $('.dsblsel').prop('disabled', false);
        $('.nsel').html(' ('+data.length+')');

    }
})

// ---- handle delay typing search box ---
$("#tbltraining .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tbltraining.search( $(this).val() ).draw();
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable').on('keyup change', delay(function (e) {
    tbltraining.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();
}, 1200));

// ---- handle select all --------
$(document).on('click', '#satbltraining', function() {
    if ($('#satbltraining:checked').val() === 'on') {
      tbltraining.rows().select();
    } else {
      tbltraining.rows().deselect();
      $('.dsblsel').prop('disabled', true);
      $('.nsel').html('');
    }

});
// ------------- end table training ----------------


$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
    tbltraining.columns.adjust().draw();
});




//============================ start simpan =============================
$('form#reg').on('submit', function(e){
    e.preventDefault();

        // menyesuaikan dengan tabel database

        var jawaban = [];

        $('.ckb').each(function(el, idx){
            var idgejala = $(this).data('id');
            var value = $(this).is(':checked') ? 1 : 0;
            var jwb = [idgejala, value];

            jawaban.push(jwb);
        });



        if (validatex('#reg')){

            btnLoading($('#reg'), true);

            $.ajax({
                url: base+'/app/uctraining',
                type: 'POST',
                data: {
                    id: (idmulti[0] ? idmulti[0] : ''),
                    id_user: $('#id_user').val(),
                    id_penyakit: $('#id_penyakit').val(),
                    jawaban: jawaban,
                },
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                // processData: false,
                // contentType: false,
                global: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil

                    refreshTablex($('#tbltraining'));
                    if (response.status) {
                        notif(response.data, response.message, 'success');
                        resetForm();
                    }else{
                        notif(response.errors, response.message, 'error');
                    }
                    btnLoading($('#reg'), false, 'Save Changes');
                },
                error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                    btnLoading($('#reg'), false, 'Save Changes');

                    showAlert(1, 'ERROR!', 'Error : '+xhr.responseText, 'error', '', true);
                }
            });

        } else {
            notif('Ups', 'Please fill form correctly', 'error');
            return false;
        }

});

function edit(el){


    toggleLoadingDTB();

    var data = new FormData();
    // data.append('id', el.idu); old
    data.append('id', el);

    $.ajax({
        url: base+'/app/fdatatraining',
        type: 'POST',
        data: data,
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        processData: false,
        contentType: false,
        dataType: "json",
        beforeSend: function(e) {
            if(e && e.overrideMimeType) {
                e.overrideMimeType("application/json;charset=UTF-8");
            }
        },
        success: function(response){

            toggleLayout($('#add'));
            toggleLoadingDTB();

            idmulti = [];
            // idmulti.push(el.idu);
            idmulti.push(el);


            $('#training').val(response.training);
            $('#pertanyaan').val(response.pertanyaan);

        }

    });

}

function hapus(el){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: (act) => {

            var data = new FormData();
            // data.append('id', el.idu); old
            data.append('id', el);

            return $.ajax({
                url: base+'/app/deltraining',
                type: 'POST',
                data: data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){

                    return response;
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    return {status: false, message: 'Error : ' +ajaxOptions+' - '+thrownError, errors: null};
                }

            });

        },
        allowOutsideClick: false,

    }).then((result) => {

        if (result.isConfirmed){
            if (result.value.status) {
                refreshTablex($('#tbltraining'));
                idmulti = [];
                showAlert(2, 'Success!', 'training succsessfully deleted', 'success', 2000, true);
            } else {
                showAlert(1, 'ERROR!', 'Error : ' +result.value.message, 'error', 1800, true);
            }
        }

        resetSelect(1);

    });


}


function deleteAll() {

    if (idmulti.length < 1) {
        notif('Ups!', 'Please select data.', 'warning');
    }else{


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            showLoaderOnConfirm: true,
            confirmButtonText: 'Yes',
            preConfirm: (act) => {

                var data = new FormData();
                data.append('id', JSON.stringify(idmulti));

                return $.ajax({
                    url: base+'/app/deltraining',
                    type: 'POST',
                    data: data,
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    beforeSend: function(e) {
                        if(e && e.overrideMimeType) {
                            e.overrideMimeType("application/json;charset=UTF-8");
                        }
                    },
                    success: function(response){
                        return response;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        return {status: false, message: 'Error : ' +ajaxOptions+' - '+thrownError, errors: null};
                    }

                });

            },
            allowOutsideClick: false,

        }).then((result) => {
            if (result.isConfirmed){
                if (result.value.status) {
                    refreshTablex($('#tbltraining'));
                    idmulti = [];

                    showAlert(2, 'Success!', 'training succsessfully deleted', 'success', 2000, true);
                } else {
                    showAlert(1, 'ERROR!', 'Error : ' +ajaxOptions+' <br> '+thrownError, 'error', 1800, true);
                }
            }
            resetSelect(1);
        });


    }

}




function resetForm(){
    idmulti = [];
    $('form').trigger("reset");
    $("select[data-control=select2].s2x").val(null).trigger('change');
    $('.form-control').removeClass("is-valid").removeClass("is-invalid");
}

function resetSelect(table){
    idmulti = [];
    $('.dsblsel').prop('disabled', true);
    $('.nsel').html('');
}

