let idmulti = [];

$(".datepicker").bootstrapMaterialDatePicker({
    weekStart: 0,
    time: true,
    clearButton: true,
    nowButton: true,
    // minDate: new Date()
    maxDate :  new Date()
})

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


//------------- table periode -------------------
var columns1 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false},
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'periode',    name: 'periode'},
    {data: 'aksi',      name: 'aksi', orderable: false,},
];

var collapsedGroups = {};
var top = '';

// ---- initialize table ----
var tblperiode = $('#tblperiode').DataTable({
    pageLength : 10,
    searchDelay: 1200,
    scrollX: false,
    scrollCollapse: true,
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getdataperiode',
        data: function (d) {
            d.filters = {
                // ini disesuaikan dengan from yang ada di controller
                periode: $("#flperiode").val().trim() ? [$("#flperiode").parent().find('.statefil').text(), $("#flperiode").val()] : '',
            };
        }
    },
    columns: columns1,
    /* scrollCollapse: true,
    fixedColumns:   {
        //leftColumns: 1,
        rightColumns: 1
    }, */
    colReorder: true,
    columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets:   0
    }],
    select: {
        style: 'os',
        //selector: 'td:first-child'
    },
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna
	},
	order: [[2, 'asc']],
    rowGroup: {
        enable: false,
        dataSrc: ['periode'],
        startRender: function(rows, group, level) {
            var all;

            if (level === 0) {
                top = group;
                all = group;
            } else {
                // if parent collapsed, nothing to do
                if (!!collapsedGroups[top]) {
                    return;
                }
                all = top + group;
            }

            var collapsed = !!collapsedGroups[all];

            rows.nodes().each(function(r) {
                r.style.display = collapsed ? 'none' : '';
            });

            // Add category name to the <tr>. NOTE: Hardcoded colspan
            return $('<tr/>').css({'cursor': 'pointer'})
                //.append('<td colspan="2"></td><td colspan="4">' + group + ' (' + rows.count() + ')</td>')
                .append('<td colspan="3"></td><td colspan="7">' + group + '</td>')
            .attr('data-name', all)
            .toggleClass('collapsed', collapsed);
        }
    },
    fnServerParams: function(data) {
        data['order'].forEach(function(items, index) {
            data['order'][index]['column_name'] = data['columns'][items.column]['data'];
        });
    }
});

// ---- handle group click ----
$('#tblperiode tbody').on('click', 'tr.dtrg-start', function() {
    var name = $(this).data('name');
    collapsedGroups[name] = !collapsedGroups[name];
    tblperiode.draw(false);
});

// ---- handle event on select row -----
tblperiode.on('select deselect', function (e, dt, type, indexes) {
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
$("#tblperiode .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tblperiode.search( $(this).val() ).draw();
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable').on('keyup change', delay(function (e) {
    tblperiode.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();
}, 1200));

// ---- handle select all --------
$(document).on('click', '#satblperiode', function() {
    if ($('#satblperiode:checked').val() === 'on') {
      tblperiode.rows().select();
    } else {
      tblperiode.rows().deselect();
      $('.dsblsel').prop('disabled', true);
      $('.nsel').html('');
    }

});
// ------------- end table periode ----------------


$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
    tblperiode.columns.adjust().draw();
});




//============================ start simpan =============================
$('form#reg').on('submit', function(e){
    e.preventDefault();

    // menyesuaikan dengan tabel database
        var data = new FormData();
        data.append('id', (idmulti[0] ? idmulti[0] : ''));
        data.append('periode', $('#periode').val().trim());


        if (validatex('#reg')){

            btnLoading($('#reg'), true);

            $.ajax({
                url: base+'/app/ucperiode',
                type: 'POST',
                data: data,
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                processData: false,
                contentType: false,
                global: false,
                dataType: "json",
                beforeSend: function(e) {
                    if(e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response){ // Ketika proses pengiriman berhasil

                    refreshTablex($('#tblperiode'));
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
        url: base+'/app/fdataperiode',
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


            $('#periode').val(response.periode);

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
                url: base+'/app/delperiode',
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
                refreshTablex($('#tblperiode'));
                idmulti = [];
                showAlert(2, 'Success!', 'periode succsessfully deleted', 'success', 2000, true);
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
                    url: base+'/app/delperiode',
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
                    refreshTablex($('#tblperiode'));
                    idmulti = [];

                    showAlert(2, 'Success!', 'periode succsessfully deleted', 'success', 2000, true);
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
