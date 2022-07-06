let idmulti1 = [];
let idmulti2 = [];
let permuser = [];
let tempselect = [];
var isfirst = true;

$(".select2").select2({
    allowClear: true,
});


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


//------------- table permission -------------------
var columns1 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false},
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'kategori',     name: 'kategori'},
    {data: 'permission_key',    name: 'permission_key'},
    {data: 'keterangan',  name: 'keterangan'},
    {data: 'aksi',      name: 'aksi', orderable: false,},
];

var collapsedGroups1 = {};
var top1 = '';

// ---- initialize table ----
var tblpermission = $('#tblpermission').DataTable({
    pageLength : 10,
    searchDelay: 1200,
    scrollX: true,
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getdatapermission',
        data: function (d) {
            d.filters = {
                kategori: $("#flkategori").val().trim() ? [$("#flkategori").parent().find('.statefil').text(), $("#flkategori").val()] : '',
                permission_key: $("#flpermissionkey").val().trim() ? [$("#flpermissionkey").parent().find('.statefil').text(), $("#flpermissionkey").val()] : '',
                keterangan: $("#flketerangan").val().trim() ? [$("#flketerangan").parent().find('.statefil').text(), $("#flketerangan").val()] : '',
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
        targets: 5,
        className: 'text-center'
    }],
    select: {
        style: 'os',
        //selector: 'td:first-child'
    },
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna
	},
	order: [[2, 'asc'], [3, 'asc']],
    rowGroup: {
        dataSrc: ['kategori'],
        startRender: function(rows, group, level) {
            var all;

            if (level === 0) {
                top1 = group;
                all = group;
            } else {
                // if parent collapsed, nothing to do
                if (!!collapsedGroups1[top1]) {
                    return;
                }
                all = top1 + group;
            }

            var collapsed = !!collapsedGroups1[all];

            rows.nodes().each(function(r) {
                r.style.display = collapsed ? 'none' : '';
            });

            // Add category name to the <tr>. NOTE: Hardcoded colspan
            return $('<tr/>').css({'cursor': 'pointer'})
                //.append('<td colspan="2"></td><td colspan="4">' + group + ' (' + rows.count() + ')</td>')
                .append('<td colspan="2"></td><td colspan="4">' + group + '</td>')
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
$('#tblpermission tbody').on('click', 'tr.dtrg-start', function() {
    var name = $(this).data('name');

    collapsedGroups1[name] = !collapsedGroups1[name];
    tblpermission.draw(false);
});

// ---- handle event on select row -----
tblpermission.on('select deselect', function (e, dt, type, indexes) {
    var data = dt.rows({selected: true}).data();

    if(data.length > 0){

        idmulti1 = [];
        for(var i = 0; i < data.length; i++){
            idmulti1.push(data[i].id);
        }

        $('.dsblsel1').prop('disabled', false);
        $('.nsel1').html(' ('+data.length+')');

    }
})

// ---- handle delay typing search box ---
$("#tblpermission .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tblpermission.search( $(this).val() ).draw();
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable1').on('keyup change', delay(function (e) {
    tblpermission.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();
}, 1200));

// ---- handle select all --------
$(document).on('click', '#satblpermission', function() {
    if ($('#satblpermission:checked').val() === 'on') {
      tblpermission.rows().select();
    } else {
      tblpermission.rows().deselect();
      $('.dsblsel1').prop('disabled', true);
      $('.nsel1').html('');
    }

});
// ------------- end table permission ----------------



//==================================================================================

var columns2 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false},
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'role',     name: 'role'},
    {data: 'aksi',      name: 'aksi', orderable: false,},
];

// ---- initialize table ----
var tblrole = $('#tblrole').DataTable({
    pageLength : 10,
    searchDelay: 1200,
    scrollX: true,
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getdatarole',
        data: function (d) {
            d.filters = {
                role: $("#flrole").val().trim() ? [$("#flrole").parent().find('.statefil').text(), $("#flrole").val()] : '',
            };
        }
    },
    columns: columns2,
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
        targets: 3,
        className: 'text-center'
    }],
    select: {
        style: 'os',
        //selector: 'td:first-child'
    },
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna
	},
	order: [[2, 'asc']],
    fnServerParams: function(data) {
        data['order'].forEach(function(items, index) {
            data['order'][index]['column_name'] = data['columns'][items.column]['data'];
        });
    }
});

// ---- handle event on select row -----
tblrole.on('select deselect', function (e, dt, type, indexes) {
    var data = dt.rows({selected: true}).data();

    if(data.length > 0){

        idmulti2 = [];
        for(var i = 0; i < data.length; i++){
            idmulti2.push(data[i].id);
        }

        $('.dsblsel1').prop('disabled', false);
        $('.nsel1').html(' ('+data.length+')');

    }
})

// ---- handle delay typing search box ---
$("#tblrole .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tblrole.search( $(this).val() ).draw();
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable2').on('keyup change', delay(function (e) {
    tblrole.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();
}, 1200));

// ---- handle select all --------
$(document).on('click', '#satblrole', function() {
    if ($('#satblrole:checked').val() === 'on') {
      tblrole.rows().select();
    } else {
      tblrole.rows().deselect();
      $('.dsblsel1').prop('disabled', true);
      $('.nsel1').html('');
    }

});

// ==========================================================================



var collapsedGroups2 = {};
var top2 = '';

var columns3 = [
    {data: 'id', name: 'id', render: function (data, type, row, meta) { return ''; }, orderable: false, searchable: false},
    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
    {data: 'kategori',     name: 'kategori'},
    {data: 'permission_key', name: 'permission_key'},
    {data: 'keterangan',  name: 'keterangan'},
];

// ---- initialize table ----
var tbllistpermission = $('#tbllistpermission').DataTable({
    // pageLength : 2,
    searchDelay: 1200,
    scrollY: 400,
    scrollX:false,
    scrollCollapse: false,
    deferRender: true,
    scroller: {
        loadingIndicator: true
    },
    processing: true,
    serverSide: true,
    ajax: {
        type: "POST",
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        url : base+'/app/getlistpermission',
        data: function (d) {
            d.filters = {
                kategori: $("#flkategori3").val().trim() ? [$("#flkategori3").parent().find('.statefil').text(), $("#flkategori3").val()] : '',
                permission_key: $("#flpermissionkey3").val().trim() ? [$("#flpermissionkey3").parent().find('.statefil').text(), $("#flpermissionkey3").val()] : '',
                keterangan: $("#flketerangan3").val().trim() ? [$("#flketerangan3").parent().find('.statefil').text(), $("#flketerangan3").val()] : '',
            };
        }
    },
    columns: columns3,
    colReorder: true,
    columnDefs: [ {
        orderable: false,
        className: 'select-checkbox',
        targets:   0
    }],
    select: {
        style: 'multiple',
        info:false
        //selector: 'td:first-child'
    },
    createdRow: function ( row, data, index ) { // Buat baris menjadi berwarna
    },
    order: [[2, 'asc']],
    rowGroup: {
        dataSrc: ['kategori'],
        startRender: function(rows, group, level) {
            var all;

            if (level === 0) {
                top2 = group;
                all = group;
            } else {
                // if parent collapsed, nothing to do
                if (!!collapsedGroups2[top2]) {
                    return;
                }
                all = top2 + group;
            }

            var collapsed = !!collapsedGroups2[all];

            rows.nodes().each(function(r) {
                r.style.display = collapsed ? 'none' : '';
            });

            // Add category name to the <tr>. NOTE: Hardcoded colspan
            return $('<tr/>').css({'cursor': 'pointer'})
                //.append('<td colspan="2"></td><td colspan="4">' + group + ' (' + rows.count() + ')</td>')
                .append('<td colspan="2"></td><td colspan="4">' + group + '</td>')
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

// ---- handle event on select row -----
tbllistpermission.on('select deselect', function (e, dt, type, indexes) {

    var data = dt.data().permission_key;
    if(e.type == "select"){
        var index = permuser.indexOf(data);
        if (index == -1) {
            permuser.push(data);
        }
    } else {
        var index = permuser.indexOf(data);
        if (index !== -1) {
            permuser.splice(index, 1);
        }
    }
})

// ---- handle group click ----
$('#tbllistpermission tbody').on('click', 'tr.dtrg-start', function() {
    var name = $(this).data('name');

    collapsedGroups2[name] = !collapsedGroups2[name];
    tbllistpermission.draw(false);
});

// ---- handle delay typing search box ---
$("#tbllistpermission .dataTables_filter input").unbind().on('keyup', delay(function (e) {
    tbllistpermission.search( $(this).val() ).draw();
}, 1200));

// ---- handle delay typing header filter ----
$('.fltable3').on('keyup change', delay(function (e) {
    tbllistpermission.column( $(this).data('column'))
    .search( $(this).val() )
    .draw();
}, 1200));

tbllistpermission.on( 'preDraw', function () {
    // if(!isfirst){
    //     tempselect = permuser;
    // }
})
tbllistpermission.on( 'draw', function () {
    setPermission();
})

function setPermission(){
    tbllistpermission.rows().every (function (rowIdx, tableLoop, rowLoop) {
        if(permuser.includes(this.data().permission_key)){
            this.select();
        }
    });

    // if(tbllistpermission.rows({selected: true}).data().length == tempselect.length){
    //     isfirst = false;
    // }
}


$(function(){


});

function toggleLayout(el, tipe){

    if(tipe == 1) {

        idmulti1 = [];
        if(el.text().toLowerCase() == 'add'){
            bs5showTab('#formx1-tab');
            el.html("Back");
            $('.hidex1').hide();
        } else {
            bs5showTab('#dataxtbl1-tab');
            el.html("Add");
            $('.hidex1').show();
        }
        $('form#reg1').trigger('reset');

    } else {

        idmulti2 = [];
        if(el.text().toLowerCase() == 'add'){
            bs5showTab('#formx2-tab');
            el.html("Back");
            $('.hidex2').hide();
        } else {
            bs5showTab('#dataxtbl2-tab');
            el.html("Add");
            $('.hidex2').show();
        }
        $('form#reg2').trigger('reset');

    }


}



function loadPermission() {

}

//============================ start simpan =============================

$('form#reg1').on('submit', function(e){
    e.preventDefault();

    var data = new FormData();
    data.append('id', (idmulti1[0] ? idmulti1[0] : ''));
    data.append('kategori', $('#kategori').val());
    data.append('permission_key', $('#permission_key').val());
    data.append('keterangan', $('#keterangan').val());


    if (validatex('#reg1')){

        btnLoading($('#reg1'), true);

        $.ajax({
            url: window.origin+'/app/ucpermission',
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
            success: function(response){ // Ketika proses pengiriman Success

                var nid = idmulti1.length;
                refreshTablex($('#gridContainer'));
                if (response.status) {
                    if(nid > 0){
                        toggleLayout($('#add1'), 1);
                    }
                    notif(response.data, response.message, 'success');
                    resetForm(1);
                }else{
                    var pesanx = '';
                    if(response.message == 'E13'){
                        $.each(response.errors, function(key, value){
                            pesanx = pesanx+'<li>'+value+'</li>';
                        });
                    } else {
                        pesanx = response.message;
                    }
                    notif(response.errors, pesanx, 'error');
                }
                btnLoading($('#reg1'), false, 'Save Changes');

            },
            error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                btnLoading($('#reg1'), false);
                showAlert(1, 'ERROR!', 'Error : '+xhr.responseText, 'error', '', true);
            }
        });

    } else {
        notif('Ups', 'Please fill form correctly', 'error');
        return false;
    }

 });

$('form#reg2').on('submit', function(e){
    e.preventDefault();

    var data = new FormData();
    data.append('id', (idmulti2[0] ? idmulti2[0] : ''));
    data.append('role', $('#role').val());
    data.append('permission', JSON.stringify(permuser));


    if (validatex('#reg')){

        btnLoading($('#reg2'), true);

        $.ajax({
            url: window.origin+'/app/ucrole',
            type: 'POST',
            data: data,//$('#reg').serialize(),
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
            success: function(response){ // Ketika proses pengiriman Success

                var nid = idmulti2.length;
                refreshTablex($('#gridContainer1'));

                if (response.status) {
                    if(nid > 0){
                        toggleLayout($('#add2'), 2);
                    }
                    notif(response.data, response.message, 'success');
                    resetForm(2);
                    loadPermission();
                    permuser = [];
                }else{
                    var pesanx = '';
                    if(response.message == 'E13'){
                        $.each(response.errors, function(key, value){
                            pesanx = pesanx+'<li>'+value+'</li>';
                        });
                    } else {
                        pesanx = response.message;
                    }
                    notif(response.errors, pesanx, 'error');
                }

                btnLoading($('#reg2'), false);

            },
            error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                btnLoading($('#reg2'), false, 'Save Changes');

                showAlert(1, 'ERROR!', 'Error : '+xhr.responseText, 'error', '', true);
            }
        });

    } else {
        notif('Ups', 'Please fill form correctly', 'error');
        return false;
    }

 });
 // ========================  end simpan ===============================

 function edit1(el){


    var data = new FormData();
    data.append('id', el.idu);

    $.ajax({
        url: base+'/app/fdatapermission',
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
            toggleLayout($('#add1'), 1);

            idmulti1 = [];
            idmulti1.push(el.idu);

            $('#permission_key').val(response.permission_key);
            $('#kategori').val(response.kategori);
            $('#keterangan').val(response.keterangan);
        }

    });

}

function edit2(el){



    var data = new FormData();
    //data.append('id', el.idu); old
    data.append('id', el);


    $.ajax({
        url: base+'/app/fdatarole',
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
            toggleLayout($('#add2'), 2);

            idmulti2 = [];
            //idmulti2.push(el.idu); old
            idmulti2.push(el);

            $('#role').val(response.role);
            permuser = response.priviledges;
            // tempselect = response.priviledges;

            $('#tbllistpermission').on( 'draw.dt', function () {
                setPermission();
            });

        }

    });

}

function hapus1(el){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: (act) => {

            var data = new FormData();
            //data.append('id', el.idu); old
            data.append('id', el);

            return $.ajax({
                url: base+'/app/delpermission',
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
                refreshTablex($('#tblpermission'));
                showAlert(2, 'Success!', 'Permission succsessfully deleted', 'success', 2000, true);
            } else {
                showAlert(1, 'ERROR!', 'Error : ' +result.value.message, 'error', 1800, true);
            }
        }
    });

    resetSelect(1);

}

function hapus2(el){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes',
        showLoaderOnConfirm: true,
        preConfirm: (act) => {

            var data = new FormData();
            // data.append('id', el.idu);  old
            data.append('id', el);

            return $.ajax({
                url: base+'/app/delrole',
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
                refreshTablex($('#tblpermission'));
                showAlert(2, 'Success!', 'Role succsessfully deleted', 'success', 2000, true);
            } else {
                showAlert(1, 'ERROR!', 'Error : ' +result.value.message, 'error', 1800, true);
            }
        }
    });

    resetSelect(2);


}

function deleteAll1() {

    if (idmulti1.length < 1) {
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
                data.append('id', JSON.stringify(idmulti1));

                return $.ajax({
                    url: base+'/app/delpermission',
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
                    refreshTablex($('#tblpermission'));
                    idmulti1 = [];
                    resetSelect(1);
                    showAlert(2, 'Success!', 'Permissions succsessfully deleted', 'success', 2000, true);
                } else {
                    showAlert(1, 'ERROR!', 'Error : ' +ajaxOptions+' <br> '+thrownError, 'error', 1800, true);
                }
            }
        });


    }

}

function deleteAll2() {

    if (idmulti2.length < 1) {
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
                data.append('id', JSON.stringify(idmulti2));

                return $.ajax({
                    url: base+'/app/delrole',
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
                    refreshTablex($('#tblpermission'));
                    idmulti2 = [];
                    resetSelect(2)
                    showAlert(2, 'Success!', 'Roles succsessfully deleted', 'success', 2000, true);
                } else {
                    showAlert(1, 'ERROR!', 'Error : ' +ajaxOptions+' <br> '+thrownError, 'error', 1800, true);
                }
            }
        });


    }

}



function resetForm(tipe){
    idmulti1 = [];
    idmulti2 = [];
    $('form#reg'+tipe).trigger("reset");
    $('form#reg'+tipe).find(".select2").val(null).trigger('change');
    $('.form-control').removeClass("is-valid").removeClass("is-invalid");

    resetSelect(tipe);

}


$('a[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
    tblpermission.columns.adjust().draw();
    tblrole.columns.adjust().draw();
    tbllistpermission.columns.adjust().draw();
});


//============================ start simpan =============================


function resetSelect(table){
    if(table == 1){
        $('.dsblsel1').prop('disabled', true);
        $('.nsel1').html('');
    } else {
        $('.dsblsel2').prop('disabled', true);
        $('.nsel2').html('');
    }
}
