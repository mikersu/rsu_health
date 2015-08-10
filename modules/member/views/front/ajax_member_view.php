<?php $a = 0 ?>

<?php foreach ( $get_list as $key => $value ): ?>
    
    <?php $a++; ?>

    <li <?php echo $retVal = ( $a <= 2 ) ? 'class="head"' : '' ; ?> >
        <a href="<?php echo site_url( 'member/account/'.$value->account_id ) ?>">
        <div class="wrap_list">
            <div class="pic"><img src="<?php echo $value->logo_image ?>"></div>
            <table>
                <tr>
                    <td><span>Name</span></td>
                    <td><span>: <?php echo $value->account_fullname ?></span></td>
                </tr>
                <tr>
                    <td><span>Tel</span></td>
                    <td><span>: <?php echo $value->mobile_phone ?></span></td>
                </tr>
                <tr>
                    <td><span>Email</span></td>
                    <td><span>: <?php echo $value->account_email ?></span></td>
                </tr>
                <tr>
                    <td colspan="2"><span>Business : <?php echo $value->name_business_type ?></span></td>
                </tr>
                <tr>
                    <td colspan="2" class="text"><?php echo limit_text( $value->address , 20 ) ?></td>
                </tr>
            </table>
        </div>
        </a>
    </li>

<?php endforeach ?>