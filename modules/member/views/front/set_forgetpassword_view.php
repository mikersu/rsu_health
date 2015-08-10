<div class="content page_forgetpassword">
	<div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>">Home</a></li>
            <li><a href="<?php echo site_url('member/detail') ?>">Member</a></li>
            <li class="active"><a href="javascript:void(0)">Forgot Password</a></li>
        </ol>
        <h1 class="page__header">
        	<span>Mem</span>ber
        </h1>
        <div class="wrap__content member">
        	<div class="member__head">
            	<h1 class="member__head--topic">Forgot Password</h1>
                <div class="member__head--sub">Advanced Power Equipment (Thailand) Co.,Ltd</div>
            </div>
            <div class="member__forgot">
            	<div class="member__forgot--head">Forgot Password</div>
                <div class="member__forgot--wrap">
                	<div class="form">
                    	<div class="form-group">
                        	<div class="wrap--label"><label>E-mail :</label></div>
                            <div class="wrap--input">
                                <input type="email" style="width:240px;" name="email" class="email" placeholder="example@example.com" >
                                <div class="wrap--btn">
                                    <button type="" class="btn-gray btn_confirm" >CONFIRM</button>
                                    <a class="btn-gray reset_input" href="javascript:void(0)">CANCEL</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>

jQuery(document).ready(function($) {
    // RESET BTN ON READY STATR
    $('.btn_confirm').removeAttr('disabled');
});

    
$('.reset_input').click(function(event) {
    $('.email').val('');
});

$('.btn_confirm').click(function(event) {

    this_btn = $(this);

    this_btn.attr('disabled', 'disabled').text( '<?php echo lang_get("The system is working") ?>' );

    $('.reset_input').hide();

    var mail = $('.email').val();
    $.ajax({
        url: '<?php echo site_url( "member/forgetpassword" ) ?>' ,
        type: "POST" ,
        dataType: "json",
        data: csrf_name+'='+csrf_value+'&email='+mail ,
        success: function( data ) 
        { 
            if ( data.error == 1 ) {
                alert( data.text );
                this_btn.removeAttr('disabled').text( '<?php echo lang_get( "CONFIRM" ) ?>' );
                $('.reset_input').show();
            }else{
                alert( data.text );
            }
        }
    });

});


</script>