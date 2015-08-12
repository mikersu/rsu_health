<!-- banner start -->
<!-- ================ -->
<div class="container" >
  <div class="row" >
    <div class="link-group">
      <div class="head">
        <ol class="breadcrumb" style="padding-left: 10px;">
          <li><a href="about">หน่วยงาน</a></li>
        </ol>
      </div>
      <div class="link-page">
        <ol class="breadcrumb">
          <li><a href="index">หน้าแรก</a></li>
          <li class="active"><a href="javascript:void(0)">เกี่ยวกับเรา</a></li>
        </ol>
      </div>
    </div>
    
  </div>
</div>
<!-- banner end -->

<!-- section start -->
<!-- ================ -->

<div class="container" style="background-color: #FCFCFC;">
  <div class="row">

   <div class="col-md-3">

    <div class="sidebar" style="padding: 5px 10px;">
      <div class="block clearfix">
        <h3 class="title">Menu</h3>
        <div class="separator-2"></div>
        <nav>
          <ul class="nav nav-pills nav-stacked">
          <?php foreach ( $data_list as $key => $value ): ?>
      <li><a href="philosophy"><?php echo $value->title ?></a></li>
    <?php endforeach ?>
      <!--       <li><a href="philosophy">ปรัชญา</a></li>
            <li><a href="wish">ปณิธาน</a></li>
            <li><a href="vision">วิสัยทัศน์</a></li>
            <li><a href="mission">พันธกิจ</a></li>
            <li><a href="objective">วัตถุประสงค์</a></li> -->
          </ul>
        </nav>
      </div>        
    </div>

  </div><!-- endcol-3 -->

  <div class="col-md-9" style="padding: 5px 10px;">

    <?php foreach ( $data_list as $key => $value ): ?>
      <h3 class="title" style="margin-top: 10px;"><?php echo $value->title ?></h3>
    <?php endforeach ?>
    <div class="separator-2"></div>

    <div class="content">
      <div class="container">

        <div class="wrap__content">
          <div class="default__page">

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




  </div><!-- endcol-9 -->



</div><!-- endrow -->
</div>  


</div>
<!-- section end -->

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