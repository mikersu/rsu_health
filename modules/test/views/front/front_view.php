<div class="content">
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>"><?php echo lang_get('Home') ?></a></li>
            <li class="active"><a href="#"><?php echo lang_get('Test') ?></a></li>
        </ol>
        <h1 class="page__header">
            <span><?php echo lang_get('Test') ?></span>
        </h1>
        <div class="wrap__content">
            <div class="default__page">
                <div class="default__page--menu">
                    <ul>
                        <?php foreach ( $data_list as $key => $value ): ?>
                            <li <?php echo $retVal = ( ! empty( $value->hover ) ) ? $value->hover : '' ; ?> ><a href="<?php echo site_url( 'testus/'.$value->slug ) ?>"><?php echo $value->title ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </div>
                <div class="default__page--wrap">
                    
                    <?php echo $retVal = ( ! empty( $show_data->detail ) ) ? $show_data->detail : '' ; ?>
                    
                    <?php if ( ! empty( $gallery_list ) ): ?>
                        
                    <div class="overview" style="padding-top: 1em;" >
                       
                        <!-- sliderkit -->
                        <div class="blog-image-show">
                            <div style="border: medium none; display: block;" class="sliderkit photosgallery-std counter-demo1">
                                <div class="sliderkit-panels">

                                    <?php foreach ( $gallery_list as $key => $value ): ?>
                                        <div class="sliderkit-panel" style="display: none;">
                                            <div class="sliderkit-wrap">
                                                <img src="<?php echo base_url().call_image_site( $value->image , 515 , 415 ); ?>">
                                            </div>
                                        </div> 
                                    <?php endforeach ?>

                                </div>

                                <div class="sliderkit-nav">
                                    
                                    <div style="padding-top: 32px;position: absolute;" class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev">
                                        <a title="Previous line" href="#" rel="nofollow">
                                            <span style="margin-top:0" >
                                                <img src="<?php echo base_url( 'public/images/arr_l.png' ) ?>" style="width: 23px;" alt="">
                                            </span>
                                        </a>
                                    </div>
                                    <div style="padding-top: 32px;position: absolute;right: 0;" class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next">
                                        <a title="Next line" href="#" rel="nofollow">
                                            <span style="margin-top:0" >
                                                <img src="<?php echo base_url( 'public/images/arr_r.png' ) ?>" style="width: 23px;" alt="">
                                            </span>
                                        </a>
                                    </div>

                                    <div class="sliderkit-nav-clip" style="">
                                        <ul style="width: 212px;">
                                            
                                            <?php foreach ( $gallery_list as $key => $value ): ?>
                                                <li style="">
                                                    <div class="main_c">
                                                        <div class="tn_c">
                                                            <a href="url">
                                                                <img title="" alt="" src="<?php echo base_url().call_image_site( $value->image , 105 , 90 ); ?>" />
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>   
                        <!-- // end sliderkit -->
                    </div>
                    <?php endif ?>

                </div>
                

            </div>
        </div>
    </div>
</div>

<script>
    jQuery().ready(function(){
        $(".photosgallery-std").sliderkit({
            // mousewheel:false,
            shownavitems:4,
            // panelbtnshover:true,
            // auto:false,
            // // navscrollatend:false
        });
        
        $(".mscroll").mCustomScrollbar({
            mouseWheel:false,
            scrollButtons:{
                enable:true
            },
            advanced: {
                updateOnContentResize: true
            },
            theme:"dark-thin"
        });
    });
</script>

