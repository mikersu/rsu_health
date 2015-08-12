<!-- banner start -->
<!-- ================ -->
<div class="container" >
   <div class="row" >
      <div class="link-group">
         <div class="head">
            <ol class="breadcrumb" style="padding-left: 10px;">
               <li><a href="qa_evaluation">เอกสาร QA</a></li>
            </ol>
         </div>
         <div class="link-page">
            <ol class="breadcrumb">
               <li><a href="index">หน้าแรก</a></li>
               <li class="active"><a href="javascript:void(0)">เอกสาร QA</a></li>
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
                        <li <?php echo $retVal = ( ! empty( $value->hover ) ) ? $value->hover : '' ; ?> ><a href="<?php echo site_url( 'qa_evaluation/'.$value->slug ) ?>"><?php echo $value->title ?></a></li>
                     <?php endforeach ?>
                  </ul>
               </nav>
            </div>        
         </div>

      </div><!-- endcol-3 -->

      <div class="col-md-9" style="padding: 5px 10px;">
         <h3 class="title" style="margin-top: 10px;"><?php echo $retVal = ( ! empty( $show_data->title ) ) ? $show_data->title : '' ; ?></h3>
         <div class="separator-2"></div>
         <div class="row" style="padding: 10px 10px; margin-bottom: 10px;">

            <?php echo $retVal = ( ! empty( $show_data->detail ) ) ? $show_data->detail : '' ; ?>

         </div>
      </div> <!-- endcol-9 -->
   </div><!-- endrow -->
</div>  


</div>
<!-- section end -->
