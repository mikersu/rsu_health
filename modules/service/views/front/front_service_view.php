<div class="content" id="engineering-service">
	<div class="container">
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url() ?>"><?php echo lang_get('Home') ?></a></li>
            <li class="active"><a href="#"><?php echo lang_get('Engineering Service') ?></a></li>
        </ol>
        <h1 class="page__header">
        	<span><?php echo lang_get('Engineering Service') ?></span>
        </h1>
        <div class="wrap__content">
        	<div class="service">
            	<div class="service__head">
                	<div class="row">
                    	<div class="col-xs-6">
                            <?php echo $this->content_config_model->get( 'service_detail_left' , $this_lang ) ?>
                        </div>
                        <div class="col-xs-6" style="width:420px; float:right;">
                        	<?php echo $this->content_config_model->get( 'service_detail_right' , $this_lang ) ?>
                        </div>
                    </div>
                </div>
                <div class="service__tab">
                

                    <!-- sliderkit -->
                    <div class="sliderkit photosgallery-std wg_filterType" style="border:none;">
                        <div class="sliderkit-nav">
                            <div class="sliderkit-nav-clip">
                                <ul>
                                    <?php 
                                    foreach ( $category_list as $key => $value ): 
                                        
                                        if ( empty( $value->image ) ) {
                                            $value->image = '["images\/no_image.png"]';
                                        }

                                        $array_image = json_decode($value->image);
                                    ?>

                                    <li>
                                    	<a href="#" class="overset-image" >
                                        
                                        <?php foreach ( $array_image as $key_image => $value_image ): ?>
                                            <img src="<?php echo base_url().call_image_site( $value_image , 0 , 50 ); ?>"/>
                                        <?php endforeach ?>
                                        
                                    	</a>
                                    </li>
                                    <?php endforeach ?>

                                </ul>
                            </div>
                            <div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-prev"><a href="javascript:void(0)" title="Scroll to the left"><span class="display_none" >Previous</span></a></div>
                            <div class="sliderkit-btn sliderkit-nav-btn sliderkit-nav-next"><a href="javascript:void(0)" title="Scroll to the right"><span class="display_none" >Next</span></a></div>
                        </div>
                        <div class="sliderkit-panels">

                            <?php foreach ( $category_list as $key => $value ): ?>
                                
                                    <div class="sliderkit-panel">
                                        <div class="service__tab--list">
                                            <ul>
                                                <?php foreach ( $value->list_item as $key_item => $value_item ): ?>
                                                    <li>
                                                        <div class="thumb">
                                                            <img src="<?php echo base_url().call_image_site( $value_item->image , 200 , 130 ); ?>">
                                                        </div>
                                                        <div class="text">
                                                            <div class="topic"><?php echo $value_item->title ?></div>
                                                            <span ><?php echo limit_text( $value_item->detail , 300 ) ?></span>
                                                        </div>
                                                    </li>
                                                <?php endforeach ?>
                                            </ul>
                                        </div>
                                    </div><!-- sliderkit-panel -->


                            <?php endforeach ?>


                        </div>
                    </div>
                    <!-- // end sliderkit -->
                </div>
            </div>
        </div>
    </div>
</div>

<script>

    $(window).load(function(){
        $(".photosgallery-std").sliderkit({
            mousewheel:false,
            shownavitems:8,
            scroll:1,
            panelbtnshover:true,
            circular:true,
            auto:false,
            navscrollatend:false
        });
        
        var service__tabHeight = $('.service__tab--list').height();
        $('.service__tab .photosgallery-std .sliderkit-panel').css('height',service__tabHeight+10);
        $('.service__tab').css('height',service__tabHeight+100);
        /*
        $(".content--where__detail .list").click(function(){
            var id = $(this).attr('id');
            $(".content--where__detail .list").removeClass('active');
            $(this).addClass('active');
            $(".retailer img").removeClass('active');
            $('#logo_'+id).addClass('active');
        });
        */

        // $('.sliderkit-nav-clip').delay( 800 ).attr('style', '');
        // $('.sliderkit-nav-clip ul').delay( 800 ).attr('style', '');
        $('.sliderkit-nav-clip ul').delay( 800 ).attr('style', 'width: 1111em;');

    });


</script>


