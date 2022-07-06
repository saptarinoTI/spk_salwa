let jawaban = {};

$('.btnnext').on('click', function () {
    const modalx = '#dataxtbl';
    const tabx = $(this).data('tabx');
    const nextTabLinkEl = $(tabx + '.nav-tabs .active').closest('li').next('li').find('a')[0];
    const nextTabLinkEl1 = $(tabx + '.nav-tabs .active').closest('li').next('li').find('a');
    const tabref = $(tabx + '.nav-tabs .active').closest('li').find('a').attr('href');
    const tabActive = $(tabref);
    const progressbarstep = $('#prorgessbarstep');

    if (nextTabLinkEl) {
        const steptitle = nextTabLinkEl1.data('title');
        const stepsubtitle = nextTabLinkEl1.data('subtitle');
        const stepnumb = nextTabLinkEl1.text();
        const dataCount = parseInt(nextTabLinkEl1.data('count'));
        const dataNo = parseInt(nextTabLinkEl1.data('no'));


        btnLoading('#dataxtbl', true);

        var deferred = $.Deferred();
        var casex = function(dfd){

            // return dfd.resolve(true);


            if(parseInt(stepnumb) == 2){
                if(!validatex('#form1')){

                    notif('Whoops!', 'Silakan lengkapi form terlebih dahulu.', 'error');
                    return dfd.resolve(false);
                }

                return dfd.resolve(true);

            } else {

                if(!validatex(tabActive.find('.formx'))){
                    notif('Whoops!', 'Silakan pilih jawaban terlebih dahulu.', 'error');
                    return dfd.resolve(false);
                }

                var option = tabActive.find('.formx').find('input:radio:checked');
                var value = option.val();
                var key = "gejala_"+option.data('urut');
                var idgejala = option.data('gejala');

                jawaban[key] = [idgejala, value];

                return dfd.resolve(true);

            }

            /* if(parseInt(stepnumb) == 2){

                if(selectedFams.length < 1){
                    if($('#key_customer').data('npk')){

                        $.when( searchCustomer() ).always(function(res) {
                            if(res.responseJSON){
                                notif('Whoops!', res.responseJSON.message, 'error');
                                return dfd.resolve(false);
                            } else {
                                $.when( generateCustomerList(res) ).always(function(res) {
                                    return dfd.resolve(true);
                                });
                            }
                        });

                    } else if(!$('#rute').dxSelectBox('instance').option('value') || !$('#tgl_keberangkatan').val() || !$('#id_flight').dxSelectBox('instance').option('value')){
                        notif('Whoops!', 'Silakan lengkapi form', 'warning');
                        return dfd.resolve(false);
                    } else {
                        return dfd.resolve(true);
                    }
                } else {
                    return dfd.resolve(true);
                }


            } else if(parseInt(stepnumb) == 3) {


                if(!selectedFams.length){
                    notif('Info!', 'Silakan pilih customer terlebih dahulu', 'info');
                    return dfd.resolve(false);
                }

                if(!$('#alertmulticustomer').hasClass('d-none')){
                    notif('Whoops!', 'Tidak dapat melakukan reservasi multi customer. (Customer harus dalam satu keluarga yang sama).', 'error');
                    return dfd.resolve(false);
                }


                if(!$('input:radio[name=block_seat]:checked').val() && $('input:radio[name=block_seat]:checked').length > 0){
                    notif('Info!', 'Silakan pilih prioritas kursi terlebih dahulu', 'info');
                    return dfd.resolve(false);
                }

                if(!$('#kode_jenis_perjalanan').dxSelectBox('instance').option('value')){
                    notif('Whoops!', 'Silakan pilih kategori penumpang', 'warning');
                    return dfd.resolve(false);
                }

                if(!$('#alamat').val().trim()){
                    notif('Whoops!', 'Silakan masukkan alamat', 'warning');
                    return dfd.resolve(false);
                }

                if(!$('#alamat').val().trim()){
                    notif('Whoops!', 'Silakan masukkan nomor HP', 'warning');
                    return dfd.resolve(false);
                }

                if($('#transport').is(':checked') && !$('#alamat_jemput').val().trim()){
                    notif('Whoops!', 'Silakan isi alamat jemput customer terlebih dahulu', 'warning');
                    return dfd.resolve(false);
                }

                if(selectedFams[0].hasOwnProperty('nonkaryawan') && !$('input:radio[name=domisili]:checked').val()){
                    notif('Whoops!', 'Silakan pilih domisili customer terlebih dahulu', 'warning');
                    return dfd.resolve(false);
                }

                if($('#multiple_seat').length){
                    if($('#multiple_seat').is(':checked') && ($('#jumlah_seat').val() == '' || $('#jumlah_seat').val() == 0)){
                        notif('Whoops!', 'Silakan masukkan jumlah seat yang akan di block', 'error');
                        return dfd.resolve(false);
                    }
                }

                if($('#fdokref').is(':visible') && !$('#dokref').val()){
                    notif('Whoops!', 'Silakan masukkan dokumen referensi terlebih dahulu', 'error');
                    return dfd.resolve(false);
                }

                if($('#buktibayar').length > 0){
                    if(!$('#buktibayar').val()){
                        notif('Info!', 'Silakan masukkan bukti pembayaran jika dibutuhkan', 'info');
                        // return dfd.resolve(false);
                    }
                }




                $.when( cekBlockSeat() ).always(function(res) {

                    if(res.responseJSON){
                        notif('Whoops!', res.responseJSON.message, 'error');
                        return dfd.resolve(false);
                    }

                    $.when( setCharge() ).always(function(res) {

                        if(res.responseJSON){
                            notif('Whoops!', res.responseJSON.message, 'error');
                            return dfd.resolve(false);
                        } else {
                            $.when( generatePaymentCustomers(res) ).always(function(res) {
                                return dfd.resolve(res);
                            });
                        }
                    });

                });

            } else if(parseInt(stepnumb) == 4){

                if(!selectedFams.length){
                    notif('Whoops!', 'Silakan pilih customer terlebih dahulu', 'warning');
                    return dfd.resolve(false);
                }

                if(!validatex()){
                    notif('Whoops!', 'Silakan pilih metode pembayaran', 'warning');
                    return dfd.resolve(false);
                }

                $.when( setReservasi() ).always(function(res) {

                    if(res.responseJSON){
                        notif('Whoops!', res.responseJSON.message, 'error');
                        return dfd.resolve(false);
                    } else {
                        $.when( generateDetailReservation(res) ).always(function(res) {
                            return dfd.resolve(res);
                        });
                    }
                });

            } else {
                //do nothing
            }

            return dfd.promise(); */
        }

        casex(deferred).then(function(res) {

            if(res){
                setTimeout(function(){

                    $('.steptitle').html(steptitle)
                    $('.stepsubtitle').html(stepsubtitle)
                    $('.stepnumb').html(stepnumb)


                    if (nextTabLinkEl1.data('prev') == 1) {
                        $(modalx + ' .btnprev').removeClass('d-none');
                    } else {
                        $(modalx + ' .btnprev').addClass('d-none');
                    }

                    if (nextTabLinkEl1.data('next') == 1) {
                        $(modalx + ' .btnnext').removeClass('d-none');
                    } else {
                        $(modalx + ' .btnnext').addClass('d-none');
                    }

                    if (nextTabLinkEl1.data('save') == 1) {
                        $(modalx + ' .btnsave').removeClass('d-none');
                    } else {
                        $(modalx + ' .btnsave').addClass('d-none');
                    }

                    var widthprogress = dataNo/dataCount * 100;

                    progressbarstep.css({'width': widthprogress+'%'});
                    progressbarstep.attr('aria-valuenow', widthprogress);

                    btnLoading('#dataxtbl', false);
                    showTab(nextTabLinkEl);

                }, 600);

            } else {
                setTimeout(function(){ btnLoading('#dataxtbl', false); }, 600);
            }

        });


    } else {
        setTimeout(function(){
            btnLoading('#dataxtbl', false);
            const nextTab = new bootstrap.Tab(nextTabLinkEl);
            nextTab.show();
        }, 600);
    }

});

$('.btnprev').on('click', function () {
    const modalx ='#dataxtbl';
    const tabx = $(this).data('tabx');
    const prevTabLinkEl = $(tabx + '.nav-tabs .active').closest('li').prev('li').find('a')[0];
    const prevTabLinkEl1 = $(tabx + '.nav-tabs .active').closest('li').prev('li').find('a');
    const progressbarstep = $('#prorgessbarstep');

    if (prevTabLinkEl) {
        const steptitle = prevTabLinkEl1.data('title');
        const stepsubtitle = prevTabLinkEl1.data('subtitle');
        const stepnumb = prevTabLinkEl1.text();
        const dataCount = parseInt(prevTabLinkEl1.data('count'));
        const dataNo = parseInt(prevTabLinkEl1.data('no'));

        $('.steptitle').html(steptitle)
        $('.stepsubtitle').html(stepsubtitle)
        $('.stepnumb').html(stepnumb)

        if (prevTabLinkEl1.data('prev') == 1) {
            $(modalx + ' .btnprev').removeClass('d-none');
        } else {
            $(modalx + ' .btnprev').addClass('d-none');
        }

        if (prevTabLinkEl1.data('next') == 1) {
            $(modalx + ' .btnnext').removeClass('d-none');
        } else {
            $(modalx + ' .btnnext').addClass('d-none');
        }

        if (prevTabLinkEl1.data('save') == 1) {
            $(modalx + ' .btnsave').removeClass('d-none');
        } else {
            $(modalx + ' .btnsave').addClass('d-none');
        }

        var widthprogress = dataNo/dataCount * 100;

        progressbarstep.css({'width': widthprogress+'%'});
        progressbarstep.attr('aria-valuenow', widthprogress);


    }

    const prevTab = new bootstrap.Tab(prevTabLinkEl);
    prevTab.show();
});

$('#btnsave').on('click', function(){

    const tabx = $(this).data('tabx');
    const tabref = $(tabx + '.nav-tabs .active').closest('li').find('a').attr('href');
    const tabActive = $(tabref);

    btnLoading($('#btnsave'), true);


    if(validatex(tabActive.find('.formx'))){
        $.ajax({
            url: window.origin+'/app/prosesdiagnosa',
            type: 'POST',
            data: {
                usia: $('#usia').val().trim(),
                pekerjaan: $('#pekerjaan').val().trim(),
                jenis_kelamin: $('input[name=jk]:checked').val(),
                jawaban: jawaban
            },
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            global: false,
            // processData: false,
            // contentType: false,
            dataType: "json",
            beforeSend: function(e) {
                if(e && e.overrideMimeType) {
                    e.overrideMimeType("application/json;charset=UTF-8");
                }
            },
            success: function(response){

                if (response.status) {
                    // window.location = 'app';
                }else{
                    notif('Whoops!', response.message, 'error');
                }

                btnLoading($('#btnsave'), false);

            },
            error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
                // return {status: false, message: xhr.responseJSON.message, error: xhr.responseJSON.message};
                // console.log(xhr)
                notif('Whoops!', 'Silakan pilih jawaban terlebih dahulu.', 'error');

                // showAlert(1, 'ERROR!', 'Error : ' +ajaxOptions+' \n '+thrownError, 'error', 4000, true);
                btnLoading($('#btnsave'), false);
            }
        });
    } else {
        notif('Whoops!', 'Silakan pilih jawaban terlebih dahulu.', 'error');
    }
})

function showTab(target){
    const nextTab = new bootstrap.Tab(target);
    nextTab.show();
}
