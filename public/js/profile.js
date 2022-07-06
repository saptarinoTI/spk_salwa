


$(document).ready(function(){
	$('#ftu, #pass').hide();
});

$('#cekf').on('click', function(){
	if ($(this).is(':checked')) {
		$('#ffoto').show();
		$('#foto').attr('required');
	}else{
		$('#ffoto').hide();
		$('#foto').removeAttr('required');
		$('#foto').val('');
	}
});

$('#cekp').on('click', function(){ 
	if ($(this).is(':checked')) {
		$('#fpassword').show();
		$('#password').prop('required', true)
	}else{
		$('#fpassword').hide();
		$('#password').prop('required', false)
		$('#password').val('')
	}
});

$('#foto').on('change', function(){
	if(CheckExtensionIMG($('#foto')[0].files[0].name) == false){  //cek tipe file  
		$('#v1').html('File not supported!');
		$('#foto').focus();
		$('#foto').addClass('error'); 
	}else{
		$('#v1').html('');
	}
	$('#labelfoto').html($('#foto')[0].files[0].name);
})

$('.tpass').on('click', function(){
    if($(this).hasClass('spass')){
        $(this).removeClass('spass').addClass('hpass');
        $(this).parent().find('.pswd').attr('type', 'text');
    } else {
        $(this).removeClass('hpass').addClass('spass');
        $(this).parent().find('.pswd').attr('type', 'password');
    }
});


$(document).on('change', '#foto', function(){
    wait('ios', 'default', '.image-input-wrapper', 'Changing');

    var foto = $("#foto")[0].files[0];
    var data = new FormData();
    data.append('foto', foto);

    $.ajax({
        url: window.origin+'/app/setavatar',
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

            
            if(response.status){  
                notif('Success', 'Avatar changed successfuly.', 'success');
            } else {
                notif('Failed', 'Avatar fail to change.', 'danger');
            }
 
            stopWait('.image-input-wrapper');

        },
        error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error

            showAlert(2, 'ERROR!', 'Error : '+ ajaxOptions+'. '+thrownError, 'error', 4000, true) 
            stopWait('.image-input-wrapper');

        }
    });

});

function validatex(){
    var valid = true;
    let validator = $('form#reg').jbvalidator({
        errorMessage: true,
        successClass: true,
    });
    valid = validator.checkAll() > 0 ? false : true;
    return valid;
}

$('form#reg').on('submit', function(e){
	e.preventDefault();

    btnLoading($('#reg'), true);

    var cekp = $('#cekp');  
	var nama = $('#nama').val(); 
	var email = $('#email').val(); 
    var password = $('#password').val();

    if(validatex()){
        var data = new FormData();
  
        data.append('nama', nama); 
        data.append('email', email); 
        data.append('password', password);
    
        $.ajax({
            url: window.origin+'/app/setprofile',
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
    
                
                if(response.status){  
                    notif('Success', 'Data saved successfuly.', 'success');
                } else {
                    notif('Failed', 'Data fail to save.', 'danger');
                }
    
                btnLoading($('#reg'), false);
    
            },
            error: function (xhr, ajaxOptions, thrownError) { // Ketika terjadi error
    
                showAlert(2, 'ERROR!', 'Error : '+ ajaxOptions+'. '+thrownError, 'error', 4000, true) 
                btnLoading($('#reg'), false, 'Save Changes');
    
            }
        });
    
    } else {
        btnLoading('#reg', false);
    }
    
})


