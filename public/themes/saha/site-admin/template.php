<?php $this->load->view( 'site-admin/inc_html_head' ); ?>  

<!-- SET DATA Indispensable -->
<?php  

if ( ! $this->session->userdata( 'lang' ) ) 
{
   $this->session->set_userdata( 'lang', $this->lang_model->get_lang_default() );
}

$hover_menu = ( ! empty( $hover_menu ) ) ? $hover_menu : '' ;
$hover_sub_menu = ( ! empty( $hover_sub_menu ) ) ? $hover_sub_menu : '' ;

$logo_company_footer = $this->content_config_model->get( 'logo_company_footer' ); 
$logo_company_footer = base_url().call_image_site( $logo_company_footer , 61 , 19 );

?>

<!-- END SET DATA Indispensable -->		

<div class="header navbar navbar-inverse navbar-fixed-top">
   <!-- BEGIN TOP NAVIGATION BAR -->
   <div class="navbar-inner">
      <div class="container-fluid">
         <!-- BEGIN LOGO -->
         <a class="brand" href="<?php echo site_url('site-admin') ?>">
            <img src="<?php echo $logo_company_footer ?>" alt="">
            <span style="font-size: 13px;" ><?php echo $page_title = ( ! empty( $page_title ) ) ? $page_title : '' ; ?></span>
         </a>
         <!-- END LOGO -->
         <!-- BEGIN RESPONSIVE MENU TOGGLER -->
         <a href="javascript:;" class="btn-navbar collapsed" data-toggle="collapse" data-target=".nav-collapse">
            <img src="<?php echo $this->theme_path; ?>assets/img/menu-toggler.png" alt="" />
         </a>          
         <!-- END RESPONSIVE MENU TOGGLER -->            
         <!-- BEGIN TOP NAVIGATION MENU -->     

         <ul class="nav pull-right">
            <span style="margin: 0px; float: left; padding: 11px;" >
               <a style="padding: 16px 12px 11px;" class="" href="<?php echo site_url( 'home' ); ?>"  target="_blank" title="View Front End"  >
                  <i class="icon-globe" style="color: rgb(255, 255, 255); font-size: 26px;" ></i>
               </a>
            </span>

            <?php 

            $data_account = $this->account_model->get_account_cookie( 'member' ); 

                  /**
                  *
                  *** START CHECK PERMISSTION
                  *
                  **/
                  
                  $this->db->where( 'account_id', $data_account['id'] );
                  $query = $this->db->get( 'account_level' );
                  $data_job = $query->row();

                  if ( ! empty( $data_job ) ) 
                  {
                     $check_job = ( ! empty( $data_job->level_group_id )  ) ? $data_job->level_group_id : 0 ;
                  }
                  
                  /** END CHECK PERMISSTION **/


                  ?>


                  <li class="dropdown user">
                     <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img alt="" src="<?php echo $this->theme_path; ?>assets/img/sidebar-toggler.jpg" />
                        <span class="username"><?php echo $retVal = ( ! empty( $data_account['username'] ) ) ? $data_account['username'] : 'admin' ; ?></span>
                        <i class="icon-angle-down"></i>
                     </a>
                     <ul class="dropdown-menu">
                        <li><a href="<?php echo site_url('site-admin/account/edit/'.$data_account['id']) ?>"><i class="icon-user"></i> My Profile</a></li>
                        <?php if ( $this->account_model->check_admin_permission( 'Member', 'Accress Menu Member Admin' ) ): ?>
                           <li><a href="<?php echo site_url('site-admin/member/member_admin') ?>"><i class="icon-tasks"></i> Member Admin</a></li>
                        <?php endif ?>
                        <li class="divider"></li>
                        <li><a href="<?php echo site_url('site-admin/logout') ?>"><i class="icon-key"></i> Log Out</a></li>
                     </ul>
                  </li>

                  <!-- END USER LOGIN DROPDOWN -->
               </ul>
               <!-- END TOP NAVIGATION MENU --> 
            </div>
         </div>
         <!-- END TOP NAVIGATION BAR -->
      </div>
      <!-- END HEADER -->

      <!-- BEGIN CONTAINER -->
      <div class="page-container row-fluid">
         <!-- BEGIN SIDEBAR -->
         <div class="page-sidebar nav-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->         
            <ul>
               <li>
                  <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                  <div class="sidebar-toggler hidden-phone"></div><br>
                  <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
               </li>

               <li class="start <?php echo $hover = ( $hover_menu == 'Dashboard' ) ? 'active' : '' ; ?>" >
                  <a href="<?php echo site_url('site-admin') ?>">
                     <i class="icon-home"></i> 
                     <span class="title">Dashboard</span>
                  </a>
               </li>

               <?php if ( $this->modules_model->is_activated( 'intro_page' ) AND $check_job != 000 ): ?>
                  <li class="display_none <?php echo $hover = ( $hover_menu == 'Intro Page' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/intro_page') ?>">
                        <i class="icon-bookmark-empty"></i>
                        <span class="title">Intro Page</span>
                     </a>
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'home' ) AND $check_job != 000 ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'Home' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                     <a href="javascript:;">
                        <i class="icon-home"></i> 
                        <span class="title">Home</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'Home' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <!-- <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Home Setting' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/home' ) ?>">Home Setting</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Slider List' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/home/slider_list' ) ?>">Slider List</a>
                        </li>
                     </ul>    -->                
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'about' )  ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'About' ) ? 'has-sub active open' : 'has-sub ' ; ?>"> <!--  active -->
                     <a href="javascript:;">
                        <i class="icon-group"></i>
                        <span class="title">About</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'About' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'About Detail' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/about' ) ?>">About Detail</a>
                        </li>
                     </ul>
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'health_unit' ) AND $check_job != 000 ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'Health_unit' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/health_unit') ?>">
                        <i class="icon-inbox"></i> 
                        <span class="title">Health_unit</span>
                     </a>
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'health_new' ) AND $check_job != 000 ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'Health_new' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/health_new') ?>">
                        <i class="icon-inbox"></i> 
                        <span class="title">Health_new</span>
                     </a>
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'qa_evaluation' ) AND $check_job != 000 ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'QA_Evaluation' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/qa_evaluation') ?>">
                        <i class="icon-inbox"></i> 
                        <span class="title">QA_Evaluation</span>
                     </a>
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'news' ) ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'News list' OR $hover_menu == 'News & Event' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                     <a href="javascript:;">
                        <i class="icon-rss"></i>
                        <span class="title">News & Event</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'News list' OR $hover_menu == 'News & Event' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'News list' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/news/index/1' ) ?>">News list</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Event list' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/news/index/2' ) ?>">Event list</a>
                        </li>
                     </ul>                  
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'recipes' ) AND $check_job != 000 ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'Recipes' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                     <a href="javascript:;">
                        <i class="icon-bookmark-empty"></i> 
                        <span class="title">Recipes</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'Recipes' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Recipes Category' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/recipes/category' ) ?>">Recipes Category</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Recipes List' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/recipes' ) ?>">Recipes list</a>
                        </li>
                     </ul>                  
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'trade' ) AND $check_job != 000 ): ?>
                  <li class="<?php echo $hover = ( $hover_menu == 'Trade Area' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/trade') ?>">
                        <i class="icon-bookmark-empty"></i>
                        <span class="title">Trade Area</span>
                     </a>
                  </li>
               <?php endif ?>    

               <?php if ( $this->modules_model->is_activated( 'jobs' ) AND $check_job != 1  ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'Jobs' ) ? 'has-sub active open' : 'has-sub ' ; ?>"> <!--  active -->
                     <a href="javascript:;">
                        <i class="icon-bookmark-empty"></i> 
                        <span class="title">Jobs</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'Jobs' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Jobs Setting Content' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/jobs/content' ) ?>">Jobs Setting Content</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Jobs List' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/jobs' ) ?>">Jobs List</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Apply Jobs' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/jobs/apply_jobs' ) ?>">Apply Jobs</a>
                        </li>

                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Business Type' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/type_setting/table_type/business_type' ) ?>">Business Type</a>
                        </li>
                     </ul>
                  </li>
               <?php endif ?>   

               <?php if ( $this->modules_model->is_activated( 'sahadatabase' ) AND $check_job != 000 ): ?>
                  <li class="has-sub <?php echo $hover = ( $hover_menu == 'Saha Database' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/sahadatabase') ?>">
                        <i class="icon-th-list"></i> 
                        <span class="title">Saha Database</span>
                     </a>
                  </li>
               <?php endif ?>      

               <?php if ( $this->modules_model->is_activated( 'webboard' ) AND $check_job != 000 ): ?>
                  <li class="<?php echo $hover = ( $hover_menu == 'Webboard' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                     <a href="javascript:;">
                        <i class="icon-comments"></i> 
                        <span class="title">Webboard</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'Webboard' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Webboard' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url('site-admin/webboard') ?>">Webboard</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Webboard Fiter' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url('site-admin/webboard/other_setting') ?>">Webboard Fiter</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Webboard Report' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url('site-admin/webboard/report_post') ?>">Webboard Report</a>
                        </li>
                     </ul>                  
                  </li>
               <?php endif ?>

               <?php if ( $this->modules_model->is_activated( 'member' )  ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'Member' ) ? 'has-sub active open' : 'has-sub ' ; ?>"> 
                     <a href="javascript:;">
                        <i class="icon-group"></i>
                        <span class="title">Member</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'Member' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Member list' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/member' ) ?>">Member list</a>
                        </li>
                        <li class="<?php echo $hover = ( $hover_sub_menu == 'Content Text' ) ? 'active' : '' ; ?>">
                           <a href="<?php echo site_url( 'site-admin/member/content_text' ) ?>">Content Text</a>
                        </li>
                     </ul>
                  </li>
               <?php endif ?> 

             <!--   <?php if ( $this->modules_model->is_activated( 'report' ) AND $check_job != 000 ): ?>
                  <li class="<?php echo $hover = ( $hover_menu == 'Report' ) ? 'active' : '' ; ?>">
                     <a href="<?php echo site_url('site-admin/report') ?>">
                        <i class="icon-cogs"></i> 
                        <span class="title">Report</span>
                     </a>
                  </li>
               <?php endif ?> -->

               <?php if ( $this->modules_model->is_activated( 'seotag' ) ): ?> 
                  <li class="<?php echo $hover = ( $hover_menu == 'SEO Tag Setting' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                     <a href="javascript:;">
                        <i class="icon-cogs"></i> 
                        <span class="title">SEO Tag Setting</span>
                        <span class="arrow <?php echo $hover = ( $hover_menu == 'SEO Tag Setting' ) ? 'open' : '' ; ?>"></span>
                     </a>
                     <ul class="sub" >
                        <?php 
                        if ( $this->modules_model->is_activated( 'intro_page') ){
                           ?>
                           <li class="<?php echo $hover = ( $hover_sub_menu == 'page_home' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_intro' ) ?>">Intro Page</a>
                           </li>

                           <?php }
                           if ( $this->modules_model->is_activated( 'home') ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_home' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_home' ) ?>">Page Home</a>
                           </li>

                           <?php }
                           if ( $this->modules_model->is_activated( 'about' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_about_us' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_about_us' ) ?>">Page About us</a>
                           </li>
                           <?php }
                           if ( $this->modules_model->is_activated( 'products' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_product' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_product' ) ?>">Page Products</a>
                           </li> 
                           <?php }
                           if ( $this->modules_model->is_activated( 'marketing' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_marketing' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_marketing' ) ?>">Page Marketing</a>
                           </li> 
                           <?php }
                           if ( $this->modules_model->is_activated( 'recipes' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_recipes' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_recipes' ) ?>">Page Recipes</a>
                           </li> 
                           <?php }
                           if ( $this->modules_model->is_activated( 'news' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_news' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_news_event' ) ?>">Page News&Event</a>
                           </li>
                           <?php }
                           if ( $this->modules_model->is_activated( 'contactus' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_contact_us' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_contact_us' ) ?>">Page Contact us</a>
                           </li>
                           <?php }
                           if ( $this->modules_model->is_activated( 'trade' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_trade' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_trade' ) ?>">Page Trade Area</a>
                           </li>
                           <?php }
                           if ( $this->modules_model->is_activated( 'gallery' ) ){
                             ?>
                             <li class="<?php echo $hover = ( $hover_sub_menu == 'page_gallery' ) ? 'active' : '' ; ?>">
                              <a href="<?php echo site_url( 'site-admin/seotag/index/page_gallery' ) ?>">Page Gallery</a>
                           </li>
                           <?php }?>
                        </ul>

                        <?php if ( $this->modules_model->is_activated( 'setting' )  ): ?> 
                           <li class="<?php echo $hover = ( $hover_menu == 'Setting' ) ? 'has-sub active open' : 'has-sub ' ; ?>"> <!--  active -->
                              <a href="javascript:;">
                                 <i class="icon-cogs"></i>
                                 <span class="title">Setting</span>
                                 <span class="arrow <?php echo $hover = ( $hover_menu == 'Setting' ) ? 'open' : '' ; ?>"></span>
                              </a>
                              <ul class="sub" >
                                 <li class="<?php echo $hover = ( $hover_sub_menu == 'Setting Delete Cache' ) ? 'active' : '' ; ?>">
                                    <a href="<?php echo site_url('site-admin/setting') ?>">Setting Delete Cache</a>
                                 </li>
                                 <li class="<?php echo $hover = ( $hover_sub_menu == 'Setting info' ) ? 'active' : '' ; ?>">
                                    <a href="<?php echo site_url('site-admin/setting/info') ?>">Setting info</a>
                                 </li>
                                 <li class="<?php echo $hover = ( $hover_sub_menu == 'Setting Position Account' ) ? 'active' : '' ; ?>">
                                    <a href="<?php echo site_url('site-admin/account-level') ?>">Setting Position Account</a>
                                 </li>
                                 <li class="<?php echo $hover = ( $hover_sub_menu == 'Setting Account Permission' ) ? 'active' : '' ; ?>">
                                    <a href="<?php echo site_url('site-admin/account-permission') ?>">Setting Account Permission</a>
                                 </li>
                              </ul>
                           </li>
                        <?php endif ?>
                     </li>
                  <?php endif ?>

               </ul>
               <!-- END SIDEBAR MENU -->

            </div>
            <!-- END SIDEBAR -->

            <!-- BEGIN PAGE -->  
            <div class="page-content">
               <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
               <div id="portlet-config" class="modal hide">
                  <div class="modal-header">
                     <button data-dismiss="modal" class="close" type="button"></button>
                     <h3>portlet Settings</h3>
                  </div>
                  <div class="modal-body">
                     <p>Here will be a configuration form</p>
                  </div>
               </div>
               <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

               <!-- BEGIN PAGE CONTAINER-->
               <div class="container-fluid">
                  <!-- BEGIN PAGE HEADER-->   
                  <div class="row-fluid">
                     <div class="span12">
                        <h3 class="page-title">
                           <?php echo $this_title_page = ( ! empty( $this_title_page ) ) ? $this_title_page : '' ; ?>
                        </h3>
                        <ul class="breadcrumb">
                           <?php if ( ! empty( $this_breadcrumb_page ) ): ?>
                              <?php foreach ( $this_breadcrumb_page as $key => $value ): ?>
                                 <li>
                                    <?php if ( $key == 'Home' ): ?>
                                       <i class="icon-home"></i>
                                    <?php endif ?>
                                    <a href="<?php echo $value ?>"><?php echo $key ?></a>
                                    <?php if ( end( $this_breadcrumb_page ) != $value ): ?>
                                       <span class="icon-angle-right"></span>
                                    <?php endif ?>
                                 </li>								
                              <?php endforeach ?>
                           <?php endif ?>
                        </ul>
                     </div>
                  </div>
                  <!-- END PAGE HEADER-->
                  <!-- BEGIN PAGE CONTENT-->

                  <?php if ( isset( $page_content ) ) {echo $page_content;} ?> 

                  <!-- END PAGE CONTENT-->         
               </div>
               <!-- END PAGE CONTAINER-->
            </div>
            <!-- END PAGE -->  
         </div>
         <!-- END CONTAINER -->

         <!-- BEGIN FOOTER -->
         <div class="footer">
            2015 &copy; , Mr.Cherdpong All Rights Reserved.
            <div class="span pull-right">
               <span class="go-top"><i class="icon-angle-up"></i></span>
            </div>
         </div>

         <?php $this->load->view( 'site-admin/inc_html_foot' ); ?>