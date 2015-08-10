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
            <li>
               <!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
               <!-- <form class="sidebar-search">
                  <div class="input-box">
                     <a href="javascript:;" class="remove"></a>
                     <input type="text" placeholder="Search..." />            
                     <input type="button" class="submit" value=" " />
                  </div>
               </form> -->
               <!-- END RESPONSIVE QUICK SEARCH FORM -->
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
                  <ul class="sub" >
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Home Setting' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/home' ) ?>">Home Setting</a>
                     </li>
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Slider List' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/home/slider_list' ) ?>">Slider List</a>
                     </li>
         <!--             <li class="<?php echo $hover = ( $hover_sub_menu == 'Banner List' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/home/banner_list' ) ?>">Banner List</a>
                     </li> -->
                  </ul>                   
               </li>




            <?php endif ?>
			
            <?php if ( $this->modules_model->is_activated( 'products' ) AND $check_job != 000 ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'Products' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                  <a href="javascript:;">
                     <i class="icon-leaf"></i>
                     <span class="title">Products</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'Products' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Products Category' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/products/table_category' ) ?>">Products Category</a>
                     </li>
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Products List' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/products' ) ?>">Products List</a>
                     </li>
                  </ul>                  
               </li>
            <?php endif ?>

            <?php if ( $this->modules_model->is_activated( 'service' )  ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'Engineering Service' ) ? 'has-sub active open' : 'has-sub ' ; ?>"> <!--  active -->
                  <a href="javascript:;">
                     <i class="icon-cogs"></i> 
                     <span class="title">Engineering Service</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'Engineering Service' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Content Service' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/service/content' ) ?>">Content Service</a>
                     </li>
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Engineering Service List' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/service' ) ?>">Engineering Service List</a>
                     </li>
                  </ul>
               </li>
            <?php endif ?>   


            <?php if ( $this->modules_model->is_activated( 'about' ) AND $check_job != 000 ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'About' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/about') ?>">
                  <i class="icon-inbox"></i> 
                  <span class="title">About Us</span>
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
			<?php if ( $this->modules_model->is_activated( 'promotion' ) AND $check_job != 000 ): ?> 
              <!--  <li class="<?php echo $hover = ( $hover_menu == 'Promotion' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                  <a href="javascript:;">
                     <i class="icon-bookmark-empty"></i> 
                     <span class="title">Promotion</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'Promotion' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Promotion Category' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/promotion/category' ) ?>">Promotion Category</a>
                     </li>
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Promotion List' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/promotion' ) ?>">Promotion List</a>
                     </li>
                  </ul>                  
               </li> -->
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
					      <!-- <li class="<?php echo $hover = ( $hover_sub_menu == 'Recipes SubCategory' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/recipes/subcategory' ) ?>">Recipes SubCategory</a>
                     </li> -->
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
			
            <?php if ( $this->modules_model->is_activated( 'career' ) AND $check_job != 000 ): ?>
               <li class="has-sub <?php echo $hover = ( $hover_menu == 'Career' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/career') ?>">
                  <i class="icon-briefcase"></i> 
                  <span class="title">Career</span>
                  </a>
               </li>
            <?php endif ?>

            <?php if ( $this->modules_model->is_activated( 'background' ) AND $check_job != 000 ): ?>
               <li class="has-sub <?php echo $hover = ( $hover_menu == 'Background' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/background') ?>">
                     <i class="icon-picture"></i> 
                     <span class="title">Background</span>
                  </a>
               </li>
            <?php endif ?>
			
<!--             <?php if ( $this->modules_model->is_activated( 'member' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Member' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/member') ?>">
                     <i class="icon-user"></i> 
                     <span class="title">Member</span>
                  </a>
               </li>
            <?php endif ?>	  -->


            <?php if ( $this->modules_model->is_activated( 'subscribe_news' ) AND $check_job != 000 ): ?>
               <li class="has-sub <?php echo $hover = ( $hover_menu == 'Subscribe News' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/subscribe_news') ?>">
                  <i class="icon-bookmark-empty"></i> 
                  <span class="title">Subscribe News</span>
                  </a>
               </li>
            <?php endif ?>          

            <?php if ( $this->modules_model->is_activated( 'gallery' ) AND $check_job != 000 ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'Gallery' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                  <a href="javascript:;">
                     <i class="icon-bookmark-empty"></i> 
                     <span class="title">Gallery</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'Gallery' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Gallery Image' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/gallery/gallery_image' ) ?>">Gallery Image</a>
                     </li>
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Gallery Video' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/gallery/gallery_video' ) ?>">Gallery Video</a>
                     </li>
                  </ul>                  
               </li>
            <?php endif ?>
			
			<?php if ( $this->modules_model->is_activated( 'media' ) AND $check_job != 000 ){ ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Media' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/media') ?>">
                     <i class="icon-bookmark-empty"></i> 
                     <span class="title">Media</span>
                  </a>
               </li>
            <?php } ?>
			
            <?php if ( $this->modules_model->is_activated( 'faqs' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'FAQ' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/faqs') ?>">
                     <i class="icon-bookmark-empty"></i> 
                     <span class="title">FAQ</span>
                  </a>
               </li>
            <?php endif ?>

            <?php if ( $this->modules_model->is_activated( 'newsletter' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Newsletter' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/newsletter') ?>">
                     <i class="icon-bookmark-empty"></i> 
                     <span class="title">Newsletter</span>
                  </a>
               </li>
            <?php endif ?>
              
            <?php if ( $this->modules_model->is_activated( 'social' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Social' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/social') ?>">
                     <i class="icon-bookmark-empty"></i>
                     <span class="title">Social</span>
                  </a>
               </li>
            <?php endif ?>  
		
			
			<?php if ( $this->modules_model->is_activated( 'type_setting' ) AND $check_job != 000 ): ?> 
              <!--  <li class="<?php echo $hover = ( $hover_menu == 'Type Setting' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                  <a href="javascript:;">
                     <i class="icon-cogs"></i> 
                     <span class="title">Type Setting</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'Type Setting' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
					<?php if ( $this->modules_model->is_activated( 'contactus' ) AND $check_job != 000 ){ ?> 
                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Subject Contact Type' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/type_setting/table_type/subject_contact_type' ) ?>">Subject Contact Type</a>
                     </li>
					<?php }
					if ( $this->modules_model->is_activated( 'jobs' AND $check_job != 000 ) ){
					?>
					 <li class="<?php echo $hover = ( $hover_sub_menu == 'Business Type' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/type_setting/table_type/business_type' ) ?>">Business Type</a>
                     </li>
					<?php } ?> 
                  </ul>                  

               </li> -->

            <?php endif ?>

            <?php if ( $this->modules_model->is_activated( 'webboard' ) AND $check_job != 000 ): ?>
<!--                <li class="<?php echo $hover = ( $hover_menu == 'Webboard' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/webboard') ?>">
                     <i class="icon-cogs"></i> 
                     <span class="title">Webboard</span>
                  </a>
               </li> -->


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


            <?php if ( $this->modules_model->is_activated( 'contactus' ) AND $check_job != 000 ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'Contact Us' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                  <a href="javascript:;">
                     <i class="icon-map-marker"></i> 
                     <span class="title">Contact Us</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'Contact Us' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
                     <!-- <li class="<?php echo $hover = ( $hover_sub_menu == 'Contact Form' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/contactus/contact_table' ) ?>">Contact Form</a>
                     </li> -->

                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Subject Contact' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/contactus' ) ?>">Subject Contact</a>
                     </li>

                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Form Contact' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/contactus/contact_table' ) ?>">Form Contact</a>
                     </li>

                     <li class="<?php echo $hover = ( $hover_sub_menu == 'Setting E-mail' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/contactus/setting_email' ) ?>">Setting E-mail</a>
                     </li>

                  </ul>                  

               </li>

            <?php endif ?>


            <?php if ( $this->modules_model->is_activated( 'member' )  ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'Member' ) ? 'has-sub active open' : 'has-sub ' ; ?>"> <!--  active -->
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


            <?php if ( $this->modules_model->is_activated( 'report' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Report' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/report') ?>">
                     <i class="icon-cogs"></i> 
                     <span class="title">Report</span>
                  </a>
               </li>
            <?php endif ?>

            <?php if ( $this->modules_model->is_activated( 'seotag' ) ): ?> 
               <li class="<?php echo $hover = ( $hover_menu == 'SEO Tag Setting' ) ? 'has-sub active open' : 'has-sub ' ; ?>">
                  <a href="javascript:;">
                     <i class="icon-cogs"></i> 
                     <span class="title">SEO Tag Setting</span>
                     <span class="arrow <?php echo $hover = ( $hover_menu == 'SEO Tag Setting' ) ? 'open' : '' ; ?>"></span>
                  </a>
                  <ul class="sub" >
					<?php if ( $this->modules_model->is_activated( 'intro_page' )  ){ ?>          
<!-- 					<li class="<?php echo $hover = ( $hover_sub_menu == 'page_intro' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/seotag/index/page_intro' ) ?>">Page Intro</a>
                     </li> -->
               <?php }
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
					if ( $this->modules_model->is_activated( 'jobs' ) ){
					?>
     <!--                 <li class="<?php echo $hover = ( $hover_sub_menu == 'page_jobs' ) ? 'active' : '' ; ?>">
                        <a href="<?php echo site_url( 'site-admin/seotag/index/page_jobs' ) ?>">Page Jobs</a>
                     </li> -->
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


<!--             <?php if ( $this->modules_model->is_activated( 'setting' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Setting' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/setting') ?>">
                     <i class="icon-cogs"></i> 
                     <span class="title">Setting Delete Cache</span>
                  </a>
               </li>
            <?php endif ?> -->
                 

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


<!--             <?php if ( $this->modules_model->is_activated( 'calendar' ) AND $check_job != 000 ): ?>
               <li class="<?php echo $hover = ( $hover_menu == 'Calendar' ) ? 'active' : '' ; ?>">
                  <a href="<?php echo site_url('site-admin/calendar') ?>">
                     <i class="icon-cogs"></i> 
                     <span class="title">Calendar</span>
                  </a>
               </li>
            <?php endif ?> -->

            <!-- SET ECHO MENU MODULE -->
            <?php //echo $this->modules_model->load_admin_nav(); ?> 
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
<!--                      <li>
                        <i class="icon-home"></i>
                        <a href="index.html">Home</a> 
                        <span class="icon-angle-right"></span>
                     </li>
                     <li>
                        <a href="#">Form Stuff</a>
                        <span class="icon-angle-right"></span>
                     </li>
                     <li><a href="#">Form Components</a></li> -->
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
      2013 &copy; , Bizidea Co.,Ltd. All Rights Reserved.
      <div class="span pull-right">
         <span class="go-top"><i class="icon-angle-up"></i></span>
      </div>
   </div>
		
   

<?php $this->load->view( 'site-admin/inc_html_foot' ); ?>