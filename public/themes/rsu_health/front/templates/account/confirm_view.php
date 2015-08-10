<div class="content">
	<div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url(); ?>">Home</a></li>
            <li><a href="javascript:void(0)">Member</a></li>
            <li class="active"><a href="javascript:void(0)">Confirm Email</a></li>
        </ol>
        <h1 class="page__header">
        	<span>Mem</span>ber
        </h1>
        <div class="wrap__content bg--factory">
        	<div class="account">
            	<div class="account__detail">
                    <h1 class="account__detail--topic">Confirm Email</h1>
                    <div class="account__detail--sub">Advanced Power Equipment (Thailand) Co.,Ltd</div>
                    
                    <?php echo $retVal = ( ! empty( $error ) ) ? $error : '' ; ?>

                    <?php if ( ! empty( $form_status ) ): ?>
                        <?php echo $form_status ?>
                    <?php else: ?>
                        <div class="form over_input page_confirm">
                            <?php echo form_open( '', array('class' => 'form_class', 'id' => 'form_id') ); ?>
                            <p>Enter E-mail</p>
                            <input type="email" name="email" value="<?php echo $retVal = ( ! empty( $show_data['email'] ) ) ? $show_data['email'] : '' ; ?>" autocomplete="off" placeholder="exp@domain.com">
                            <button type="" style="padding: 0;border: none;" class="btn-gray">POST</button>
                            <?php echo form_close(); ?>
                        </div>
                    <?php endif ?>


                </div>
            </div>
        </div>
    </div>
</div>


<script>

  jQuery(document).ready(function($) {


    
  });

</script>

