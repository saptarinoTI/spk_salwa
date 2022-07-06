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

$('.tpass').on('click', function(){
    if($(this).hasClass('spass')){
        $(this).removeClass('spass').addClass('hpass');
        $(this).parent().find('.pswd').attr('type', 'text');
    } else {
        $(this).removeClass('hpass').addClass('spass');
        $(this).parent().find('.pswd').attr('type', 'password');
    }
});


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


//------------- table user -------------------
var columns1 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false}, 
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false}, 
    {data: 'locked',     name: 'locked', orderable: false},
    {data: 'nama',    name: 'nama'}, 
    {data: 'username',    name: 'username'}, 
    {data: 'email',  name: 'email'}, 
    {data: 'role_user',  name: 'role_user'},
    {data: 'jenis_kelamin',  name: 'jenis_kelamin'},
    {data: 'last_login',  name: 'last_login'},
    {data: 'aksi',      name: 'aksi', orderable: false,},
];

var collapsedGroups = {};
var top = '';

// ---- initialize table ----
var tbluser = $('#tbluser').DataTable({
    pageLength : 10,
    searchDelay: 1200,
    scrollX: false, 
    scrollCollapse: true,
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getdatauser',
        data: function (d) {
            d.filters = {
                locked: $("#fllocked").val().trim() ? ['=', $("#fllocked").val()] : '',
                nama: $("#flnama").val().trim() ? [$("#flnama").parent().find('.statefil').text(), $("#flnama").val()] : '',
                username: $("#flusername").val().trim() ? [$("#flusername").parent().find('.statefil').text(), $("#flusername").val()] : '',
                email: $("#flemail").val().trim() ? [$("#flemail").parent().find('.statefil').text(), $("#flemail").val()] : '',
                id_role: $("#flrole").val().trim() ? ['=', $("#flrole").val()] : '',
                jenis_kelamin: $("#fljenis_kelamin").val().trim() ? ['=', $("#fljenis_kelamin").val()] : '',
                last_login: $("#fllastlogin").val().trim() ? [$("#fllastlogin").parent().find('.statefil').text(), $("#fllastlogin").val()] : '',
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
    }, {
        targets: 6, 
        className: 'text-center'
    }, {
        targets: 7, 
        className: 'text-center'
    }, {
        targets: 8, 
        className: 'text-center'
    }, {
        targets: 9,
        orderable: false,
        className: 'text-center'
    }],
    select: {
        style: 'os',
        //selector: 'td:first-child'
    },
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna    	
	},
	order: [[6, 'desc'],[3, 'asc']],
    rowGroup: {
        enable: false,
        dataSrc: ['jenis_kelamin'],
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
$('#tbluser tbody').on('click', 'tr.dtrg-start', function() {
    var name = $(this).data('name');
    collapsedGroups[name] = !collapsedGroups[name];
    tbluser.draw(false);
});

// ---- handle event on select row -----
tbluser.on('select deselect', function (e, dt, type, indexes) {
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
$("#tbluser .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tbluser.search( $(this).val() ).draw();  
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable').on('keyup change', delay(function (e) {
    tbluser.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();  
}, 1200));

// ---- handle select all --------
$(document).on('click', '#satbluser', function() {
    if ($('#satbluser:checked').val() === 'on') {
      tbluser.rows().select();
    } else {
      tbluser.rows().deselect();
      $('.dsblsel').prop('disabled', true);
      $('.nsel').html('');  
    } 

});  
// ------------- end table user ----------------


$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
    tbluser.columns.adjust().draw();
});

function setAktif(el, idx) {

    var act = el.is(':checked') ? 1 : 0;

    $('.dataTables_processing').show();

    var data = new FormData();
    data.append('id', idx);
    data.append('locked', (act ? 1 : 0));

    $.ajax({
        url: base+'/app/setactiveuser',
        type: 'POST',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        data: data,//$('#reg').serialize(),
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
 

            if(response.status){
                notif('Success!', response.message, 'success');
            }else{ 
                showAlert(1, 'FAILED!', 'Data failed to save! <br> Error : '+response.message, 'error', 4000, true);
            }

            $('.dataTables_processing').hide();


        },
        error: function (xhr, ajaxOptions, thrownError) {

            showAlert(1, 'ERROR!', 'Error : '+xhr.responseText, 'error', '', true);

            $('.dataTables_processing').hide();

        }
    });

    resetSelect(1);

}


//============================ start simpan =============================
$('form#reg').on('submit', function(e){
    e.preventDefault(); 
    
        var data = new FormData();
        data.append('id', (idmulti[0] ? idmulti[0] : ''));
        data.append('nama', $('#nama').val().trim());
        data.append('username', $('#username').val().trim());
        data.append('email', $('#email').val().trim());
        data.append('password', $('#password').val().trim());
        data.append('usia', $('#usia').val().trim());
        data.append('pekerjaan', $('#pekerjaan').val().trim());
        data.append('jenis_kelamin', $('input[name=jk]:checked').val());
        data.append('id_role', $('#id_role').val());
    
        if (validatex('#reg')){  
    
            btnLoading($('#reg'), true);
    
            $.ajax({
                url: base+'/app/ucuser',
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
    
                    refreshTablex($('#tbluser'));
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
        url: base+'/app/fdatauser',
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


            $('#nama').val(response.nama);
            $('#username').val(response.username);
            $('#email').val(response.email);
            $('#usia').val(response.usia);
            $('#pekerjaan').val(response.pekerjaan);
            $('input[name=jk][value='+response.jenis_kelamin+']').prop('checked', true);
            $('#id_role').val(response.id_role).change();
            
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
                url: base+'/app/deluser',
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
                refreshTablex($('#tbluser'));
                idmulti = [];
                showAlert(2, 'Success!', 'User succsessfully deleted', 'success', 2000, true);
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
                    url: base+'/app/deluser',
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
                    refreshTablex($('#tbluser'));
                    idmulti = [];
                    
                    showAlert(2, 'Success!', 'User succsessfully deleted', 'success', 2000, true);
                } else {
                    showAlert(1, 'ERROR!', 'Error : ' +ajaxOptions+' <br> '+thrownError, 'error', 1800, true);
                }    
            }
            resetSelect(1);
        });
    
    
    }
    
}


function activeDeactive() {

    if (idmulti.length < 1) {
        notif('Ups!', 'Please select data.', 'warning');
    }else{

        Swal.fire({
            icon: 'question',
            title: 'Please select action',
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'Activate',
            denyButtonText: 'Deactivate',
        }).then((result) => {
            var mode = 0;
            if (result.isConfirmed) {
                mode = 1;
            } else if (result.isDenied) {
                mode = 0;
            }

            if (result.isConfirmed || result.isDenied){
                Swal.fire({
                    icon: 'warning',
                    title: 'Are you sure?',
                    showCancelButton: true,
                    confirmButtonText: 'Yes',
                    showLoaderOnConfirm: true,
                    preConfirm: (act) => {
                        
                        var data = new FormData();
                        data.append('id', JSON.stringify(idmulti)); 
                        data.append('locked', mode); 
            
                        return $.ajax({
                            url: base+'/app/setactiveuser',
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
                            Swal.fire(result.value.message, '', 'success');
                            refreshTablex($('#tbluser'));
                            resetSelect(1);
                        } else {
                            Swal.fire(result.value.message, '', 'error')
                        }
                    }
                });
    
            }

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
