<div class="content page_forgetpassword">
	<div class="container">
        <ol class="breadcrumb">
            <li><a href="index.html">Home</a></li>
            <li><a href="login.html">Member</a></li>
            <li class="active"><a href="javascript:void(0)">Reset Password</a></li>
        </ol>
        <h1 class="page__header">
        	<span>Mem</span>ber
        </h1>
        <div class="wrap__content member">
        	<div class="member__head">
            	<h1 class="member__head--topic">Reset Password</h1>
                <div class="member__head--sub">Advanced Power Equipment (Thailand) Co.,Ltd</div>
            </div>
			<?php echo $retVal = ( ! empty( $error_validation ) ) ? $error_validation : ''; ?>
			<?php echo $retVal = ( ! empty( $success ) ) ? $success : ''; ?>
			<?php
			$attributes = array('class' => 'email', 'id' => 'myform');
			echo form_open('', $attributes);
			?>
            <div class="member__forgot">
            	<div class="member__forgot--head">Reset Password</div>
                <div class="member__forgot--wrap">
                	<div class="form">
                    	<div class="form-group">
                        	<div class="wrap--label">
                        		<label>E-mail :</label>
                    			<label>Password :</label>
                    			<label>Confirm Password :</label>
                        	</div>
                            <div class="wrap--input over-blog-reset-passwrod" >
                                <input type="email" name="email" class="email" placeholder="example@example.com" >
                                <input type="password" name="password" class="password" placeholder="********" >
                                <input type="password" name="c_password" class="c_password" placeholder="********" >
                                <div class="wrap--btn">
                                    <button type="" class="btn-gray btn_confirm" >CONFIRM</button>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


