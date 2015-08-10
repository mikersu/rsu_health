    <section>
        <article>
            <div class="container" id="main_content">
                
                <div class="row-fluid head_bar">
                    <div class="topic_page">
                        <div class="topic">Member Directory</div>
                        <div id="breadcrumb">
                            <ul>
                                <li><a href="<?php echo site_url(); ?>">Home</a></li>
                                <li class="space">&gt;</li>
                                <li class="active"><a href="javascript:void(0);">Member Directory</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="row-fluid" id="member_directory">
                    <div class="filter">
                        <div class="row-fluid">
                            <div class="span6 input_filter" style="position:relative; z-index:20;">
                                <label>รุ่น</label>
                                <select name="generation" class="custom generation" >
                                        <option value="">เลือกทั้งหมด</option>
                                    <?php foreach ( $generation_list as $key => $value ): ?>
                                        <?php $retVal = ( $value->id == $data_user['generation'] ) ? 'selected' : '' ; ?>
                                        <option <?php echo $retVal ?> value="<?php echo $value->id ?>"><?php echo $value->generation_name ?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                            </div>
                            <div class="span6 input_filter"><label>ชื่อ</label><input class="input_name" type="text"></div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6 input_filter" style="position:relative; z-index:10;">
                                <label>ประเภทธุรกิจ</label>
                                <select name="" class="custom business_type">
                                        <option value="">เลือกทั้งหมด</option>
                                    <?php foreach ( $business_type_list as $key => $value ): ?>
                                        <option value="<?php echo $value->id ?>"><?php echo $value->business_type_name ?></option>
                                    <?php endforeach ?>
                                    
                                </select>
                            </div>
                            <div class="span6 input_filter">
                                <input type="button" value="Male" data-value="1" class="male input_sex">
                                <input type="button" value="ALL" data-value="" class="all input_sex">
                                <input type="button" value="Female" data-value="2" class="female input_sex">
                            </div>
                        </div>
                    </div>
                    
                    <div class="member_directory_list">
                        <ul id="call_list_member">
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

                        </ul>
                    </div>
                </div>
                
            </div>
        </article>
    </section>

<script>
    var bodyTag = document.getElementsByTagName("body")[0];
        bodyTag.className = bodyTag.className.replace("noJS", "hasJS");

    $(function() {



        /**
        *
        *** START AUTO SET DATA FOR START PAGE
        *
        **/
        
        var input_name = $('.input_name').val();
        a = csrf_name+':'+csrf_value;

        var generation = $('.generation').val();
        var business_type = $('.business_type').val();

        $.ajax({
            url: '<?php echo site_url( "member/ajax_data" ) ?>' ,
            type: "POST" ,
            // processData: true ,
            data: csrf_name+'='+csrf_value+'&generation='+generation+'&business_type='+business_type+'&string='+input_name,
            success: function( data ) 
            { 
                $('#call_list_member').html( data );
                Cufon.replace('#', { fontFamily: 'DB Helvethaica X 55 Regular', hover: true });
                Cufon.replace('#', { fontFamily: 'DB Helvethaica X 65 Med', hover: true });
                Cufon.replace('#', { fontFamily: 'DB Helvethaica X 37 ThinCond', hover: true });
                Cufon.replace('.main_home .wrap, #promotion_detail p, .member_directory_list .wrap_list .text', { fontFamily: 'DB Helvethaica X 47 LiCond', hover: true });
                Cufon.replace('#layout_login .text_footer, .cal_event .text, #fg_page label, #member_directory .filter .input_filter label, a.change_pic, #user .btn_setting, #user .btn_orange, #user .username, #news .detail, #news .topic, #user table, #webboard .list_comment .btn_reply .text, #webboard .list_comment .post_by, #webboard .post,  #webboard .list_comment .detail, #header .widget_profile a .username, #menu ul li a, .member_directory_list .wrap_list span, .social_share span, #main_content .topic_page .topic, #pagination li a, .whead span, .btn_social', { fontFamily: 'DB Helvethaica X 67 MedCond', hover: true });
                Cufon.replace('#', { fontFamily: 'DB Helvethaica X 87 BlkCond', hover: true });
                Cufon.replace('.main_home .topic', {
                    fontFamily: 'DB Helvethaica X 67 MedCond',
                    textShadow: '2px 2px 20px 20px rgba(0,0,0,0.4)'
                });
                
            }

        });        
        
        /** END AUTO SET DATA FOR START PAGE **/
        



        
        // FOR EDIT BUG CUFON SHOW SELECT
        // Cufon.replace('.selectedValue , dd', { fontFamily: 'DB Helvethaica X 67 MedCond', hover: true });

        $("select.custom").each(function() {                    
            var sb = new SelectBox({
                selectbox: $(this),
                height: 163
            });

        });


        $('select[name="generation"]').change(function(event) {
            console.log( 'test' );
        });



        $('.selectListInnerWrap dl dd').click(function(event) {

            setTimeout(
              function() 
              {

                    var input_name = $('.input_name').val();
                    a = csrf_name+':'+csrf_value;

                    var generation = $('.generation').val();
                    var business_type = $('.business_type').val();

                    $.ajax({
                        url: '<?php echo site_url( "member/ajax_data" ) ?>' ,
                        type: "POST" ,
                        // processData: true ,
                        data: csrf_name+'='+csrf_value+'&generation='+generation+'&business_type='+business_type+'&string='+input_name,
                        success: function( data ) 
                        { 
                            $('#call_list_member').html( data );
                            Cufon.replace('#', { fontFamily: 'DB Helvethaica X 55 Regular', hover: true });
                            Cufon.replace('#', { fontFamily: 'DB Helvethaica X 65 Med', hover: true });
                            Cufon.replace('#', { fontFamily: 'DB Helvethaica X 37 ThinCond', hover: true });
                            Cufon.replace('.main_home .wrap, #promotion_detail p, .member_directory_list .wrap_list .text', { fontFamily: 'DB Helvethaica X 47 LiCond', hover: true });
                            Cufon.replace('#layout_login .text_footer, .cal_event .text, #fg_page label, #member_directory .filter .input_filter label, a.change_pic, #user .btn_setting, #user .btn_orange, #user .username, #news .detail, #news .topic, #user table, #webboard .list_comment .btn_reply .text, #webboard .list_comment .post_by, #webboard .post,  #webboard .list_comment .detail, #header .widget_profile a .username, #menu ul li a, .member_directory_list .wrap_list span, .social_share span, #main_content .topic_page .topic, #pagination li a, .whead span, .btn_social', { fontFamily: 'DB Helvethaica X 67 MedCond', hover: true });
                            Cufon.replace('#', { fontFamily: 'DB Helvethaica X 87 BlkCond', hover: true });
                            Cufon.replace('.main_home .topic', {
                                fontFamily: 'DB Helvethaica X 67 MedCond',
                                textShadow: '2px 2px 20px 20px rgba(0,0,0,0.4)'
                            });
                            
                        }

                    });



              }, 100);




        });

        $('.input_name').bind('change keydown keyup',function (){
            
            var input_name = $('.input_name').val();
            a = csrf_name+':'+csrf_value;

            var generation = $('.generation').val();
            var business_type = $('.business_type').val();

            $.ajax({
                url: '<?php echo site_url( "member/ajax_data" ) ?>' ,
                type: "POST" ,
                // processData: true ,
                data: csrf_name+'='+csrf_value+'&generation='+generation+'&business_type='+business_type+'&string='+input_name,
                success: function( data ) 
                { 
                    $('#call_list_member').html( data );
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 55 Regular', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 65 Med', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 37 ThinCond', hover: true });
                    Cufon.replace('.main_home .wrap, #promotion_detail p, .member_directory_list .wrap_list .text', { fontFamily: 'DB Helvethaica X 47 LiCond', hover: true });
                    Cufon.replace('#layout_login .text_footer, .cal_event .text, #fg_page label, #member_directory .filter .input_filter label, a.change_pic, #user .btn_setting, #user .btn_orange, #user .username, #news .detail, #news .topic, #user table, #webboard .list_comment .btn_reply .text, #webboard .list_comment .post_by, #webboard .post,  #webboard .list_comment .detail, #header .widget_profile a .username, #menu ul li a, .member_directory_list .wrap_list span, .social_share span, #main_content .topic_page .topic, #pagination li a, .whead span, .btn_social', { fontFamily: 'DB Helvethaica X 67 MedCond', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 87 BlkCond', hover: true });
                    Cufon.replace('.main_home .topic', {
                        fontFamily: 'DB Helvethaica X 67 MedCond',
                        textShadow: '2px 2px 20px 20px rgba(0,0,0,0.4)'
                    });
                    
                }


            });


        });


        $('.custom').change(function(event) {
            
            var input_name = $('.input_name').val();
            a = csrf_name+':'+csrf_value;

            var generation = $('.generation').val();
            var business_type = $('.business_type').val();

            $.ajax({
                url: '<?php echo site_url( "member/ajax_data" ) ?>' ,
                type: "POST" ,
                // processData: true ,
                data: csrf_name+'='+csrf_value+'&generation='+generation+'&business_type='+business_type+'&string='+input_name,
                success: function( data ) 
                { 
                    $('#call_list_member').html( data );
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 55 Regular', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 65 Med', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 37 ThinCond', hover: true });
                    Cufon.replace('.main_home .wrap, #promotion_detail p, .member_directory_list .wrap_list .text', { fontFamily: 'DB Helvethaica X 47 LiCond', hover: true });
                    Cufon.replace('#layout_login .text_footer, .cal_event .text, #fg_page label, #member_directory .filter .input_filter label, a.change_pic, #user .btn_setting, #user .btn_orange, #user .username, #news .detail, #news .topic, #user table, #webboard .list_comment .btn_reply .text, #webboard .list_comment .post_by, #webboard .post,  #webboard .list_comment .detail, #header .widget_profile a .username, #menu ul li a, .member_directory_list .wrap_list span, .social_share span, #main_content .topic_page .topic, #pagination li a, .whead span, .btn_social', { fontFamily: 'DB Helvethaica X 67 MedCond', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 87 BlkCond', hover: true });
                    Cufon.replace('.main_home .topic', {
                        fontFamily: 'DB Helvethaica X 67 MedCond',
                        textShadow: '2px 2px 20px 20px rgba(0,0,0,0.4)'
                    });
                }

            });

        });


        $('.input_sex').click(function(event) {

            var value_sex = $(this).data( 'value' );
            var input_name = $('.input_name').val();
            var a = csrf_name+':'+csrf_value;

            var generation = $('.generation').val();
            var business_type = $('.business_type').val();

            $.ajax({
                url: '<?php echo site_url( "member/ajax_data" ) ?>' ,
                type: "POST" ,
                // processData: true ,
                data: csrf_name+'='+csrf_value+'&generation='+generation+'&business_type='+business_type+'&string='+input_name+'&sex='+value_sex,
                success: function( data ) 
                { 
                    $('#call_list_member').html( data );
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 55 Regular', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 65 Med', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 37 ThinCond', hover: true });
                    Cufon.replace('.main_home .wrap, #promotion_detail p, .member_directory_list .wrap_list .text', { fontFamily: 'DB Helvethaica X 47 LiCond', hover: true });
                    Cufon.replace('#layout_login .text_footer, .cal_event .text, #fg_page label, #member_directory .filter .input_filter label, a.change_pic, #user .btn_setting, #user .btn_orange, #user .username, #news .detail, #news .topic, #user table, #webboard .list_comment .btn_reply .text, #webboard .list_comment .post_by, #webboard .post,  #webboard .list_comment .detail, #header .widget_profile a .username, #menu ul li a, .member_directory_list .wrap_list span, .social_share span, #main_content .topic_page .topic, #pagination li a, .whead span, .btn_social', { fontFamily: 'DB Helvethaica X 67 MedCond', hover: true });
                    Cufon.replace('#', { fontFamily: 'DB Helvethaica X 87 BlkCond', hover: true });
                    Cufon.replace('.main_home .topic', {
                        fontFamily: 'DB Helvethaica X 67 MedCond',
                        textShadow: '2px 2px 20px 20px rgba(0,0,0,0.4)'
                    });
                }

            });

        });

            
    });
</script>
