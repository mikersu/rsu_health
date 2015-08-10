		<section>
            <article>
            	<div class="container header_page">
                	<h2>
                    	<?php echo lang_get('<span class="Helve_BdC">THAI ROONG RUENG</span><br/><span class="sub Helve_C">CHILLI SAUCE Company Limited</span>'); ?>
                    </h2>
                    <div class="breadcrumb">
                    	<a href="<?php echo site_url('home');?>"><?php echo lang_get('Home'); ?></a>
						<a href="<?php echo site_url('test');?>"><?php echo lang_get('Test'); ?></a>
                        <a href="<?php echo site_url('test/detail/'.$show_data['id']);?>" class="active"><?php echo $show_data['title'];?></a>
                    </div>
                </div>
                <div class="main_content default detail" id="test">
                    <div class="container">
						<div class="head">
                            <h1>
                                <span class="Helve_BdC page_name"><?php echo $show_data['title'];?></span>
                                <span class="date"><?php echo date('d/m/Y',$show_data['test_date']);?></span>
                            </h1>
                            <?php
							// $next='';
							// $previous='';
							// 	foreach($data_list as $key=>$value){
							// 		if($next==''){
							// 			if($value->order_sort > $show_data['order_sort']){
							// 			$next='<a href="'.site_url('test/detail/'.$value->id).'" class="Helve_M">'.lang_get('Test Previous').'</a>';
										
							// 			}
							// 		}
									
							// 		if($previous==''){
							// 			if($value->order_sort < $show_data['order_sort']){
							// 			$previous='<a href="'.site_url('test/detail/'.$value->id).'" class="Helve_M">'.lang_get('Test Next').'</a>';
							// 			}
							// 		}
									
							// 	}
							// if($previous!='' || $next!=''){
							// 	echo '<div class="nav_page">';
							// 	if($previous=='')
							// 	$previous='<a href="javascript:void(0);" class="Helve_M disable">'.lang_get('Test Previous').'</a>';
							// 	echo $previous;
							// 	if($next=='')
							// 	$next='<a href="javascript:void(0);" class="Helve_M disable">'.lang_get('Test Next').'</a>';
							// 	echo $next;
							// 	echo '</div>';
							// }
          

                            // header('Content-Type: text/html; charset=utf-8');

                            // echo "-----------------------------------<br><br><br><br><br>";

                        
                         
                            echo '<div class="nav_page">';

                            foreach ( $data_list as $key => $value ) {
                                

                                if ( $value->test_id == $show_data['test_id'] ) {
                                    
                                    if ( ! empty( $data_list[$key-1]->test_id ) ) {
                                        echo $Previous='<a href="'.site_url('test/detail/'.$data_list[$key-1]->test_id).'" class="Helve_M">'.lang_get('Test Previous').'</a>';
                                    }
                                    if ( ! empty( $data_list[$key+1]->test_id ) ) {
                                        echo $next = '<a href="'.site_url('test/detail/'.$data_list[$key+1]->test_id).'" class="Helve_M">'.lang_get('Test Next').'</a>';
                                    }


                                }
                                
                            }

                            echo '</div>';






							?>
                        </div>
                        <div class="view">
                        	<!-- Nav tabs -->
                            <ul class="nav nav-tabs">
                              <li class="active"><a href="#tab_image" data-toggle="tab"><?php echo lang_get('Picture'); ?></a></li>
							  <?php
							  if($show_data['youtube_id']!='' || $show_data['file_video']!='')
                              echo '<li><a href="#tab_video" data-toggle="tab">'.lang_get('Video').'</a></li>';
							  ?>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <div class="tab-pane fade in active" id="tab_image">
                              		<!-- ---- -->
                                    <div id="gallery" class="content">
                                        <div class="slideshow-container">
                                            <div id="loading" class="loader"></div>
                                            <div id="slideshow" class="slideshow"></div>
                                        </div>
                                    </div>
                                    <div id="thumbs" class="navigation">
                                        <ul class="thumbs noscript">
                                            <?php foreach($gallery_list as $key => $gallery){?>
                                            <li>
                                                <a class="thumb" name="leaf" href="<?php echo site_url().str_replace("\\",'/',$gallery['image']);?>" title="">
                                                    <img src="<?php echo site_url().str_replace("\\",'/',$gallery['image']);?>" alt="" width="272" height="172"/>
                                                </a>
                                            </li>
											<?php }?>
                                        </ul>
                                        
                                      <!--   <div class="thumb_nav">
                                            <a class="pageLink prev" style="visibility: hidden;" href="#" title="<?php echo lang_get('Previous')?>"></a>
                                            <a class="pageLink next" style="visibility: hidden;" href="#" title="<?php echo lang_get('Next')?>"></a>
                                        </div>
                                        -->
                                    </div>
                                    <!-- ---- -->
                              </div>
                              <?php
								if($show_data['youtube_id']!='' || $show_data['file_video']!=''){
								echo '<div class="tab-pane fade" id="tab_video">';
									if($show_data['file_video']!=''){
									echo '<center>
											<video width="700" height="394"	autoplay="autoplay"	controlbar="none" id="container">
											<source src="'.base_url($show_data['file_video']).'" type="video/mp4; codecs=\'avc1.42E01E, mp4a.40.2\'">
											</video>';
									echo '<script type="text/javascript">';
									echo '		jwplayer("container").setup({';
									echo '			width: 554,';
									echo '			height: 350,';
									echo '			file: "'.base_url($show_data['file_video']).'",';
									echo '			logo: "",';
									echo '			controlbar: "none",';
									echo '			autostart: true,';
									echo '			icons: false,';
									echo '			modes: [';
									echo '			{ type: "flash", src: "'.base_url('public/js/jwplayer/jwplayer.flash.swf').'" },';
									echo '			{ type: "html5"},';
									echo '			{ type: "download" }';
									echo '			]';
									echo '		});';
									echo '	</script>';
									echo '</center>';
									}else{
									?>
                              		<iframe width="554" height="350" src="//www.youtube.com/embed/<?php echo $show_data['youtube_id'];?>?controls=0&showinfo=0&wmode=transparent" frameborder="0" wmode="Opaque" allowfullscreen></iframe>
									<?php }
									
								echo '</div>';
								}?>
                            </div>
                        </div>
                        <div class="detail">
                        	<div class="topic"><?php echo $show_data['title'];?></div>
                            <p class="indent"><?php echo $show_data['detail'];?></p>
                            <!-- Go to www.addthis.com/dashboard to customize your tools -->
                            <div class="addthis_sharing_toolbox"></div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
	<script type="text/javascript">
        jQuery(document).ready(function($) {
            // We only want these styles applied when javascript is enabled
            $('div.content').css('display', 'block');

            // Initially set opacity on thumbs and add
            // additional styling for hover effect on thumbs
            var onMouseOutOpacity = 1;
            $('#thumbs ul.thumbs li, div.navigation a.pageLink').opacityrollover({
                mouseOutOpacity:   onMouseOutOpacity,
                mouseOverOpacity:  1.0,
                fadeSpeed:         'fast',
                exemptionSelector: '.selected'
            });
            
            // Initialize Advanced Galleriffic Gallery
            var gallery = $('#thumbs').galleriffic({
                delay:                     2500,
                numThumbs:                 4,
                preloadAhead:              10,
                enableTopPager:            false,
                enableBottomPager:         false,
                imageContainerSel:         '#slideshow',
                controlsContainerSel:      '#controls',
                captionContainerSel:       '#caption',
                loadingContainerSel:       '#loading',
                renderSSControls:          true,
                renderNavControls:         true,
                playLinkText:              'Play Slideshow',
                pauseLinkText:             'Pause Slideshow',
                prevLinkText:              '&lsaquo; Previous Photo',
                nextLinkText:              'Next Photo &rsaquo;',
                nextPageLinkText:          'Next &rsaquo;',
                prevPageLinkText:          '&lsaquo; Prev',
                enableHistory:             true,
                autoStart:                 false,
                syncTransitions:           true,
                defaultTransitionDuration: 900,
                onSlideChange:             function(prevIndex, nextIndex) {
                    // 'this' refers to the gallery, which is an extension of $('#thumbs')
                    this.find('ul.thumbs').children()
                        .eq(prevIndex).fadeTo('fast', onMouseOutOpacity).end()
                        .eq(nextIndex).fadeTo('fast', 1.0);

                    // Update the photo index display
                    this.$captionContainer.find('div.photo-index')
                        .html('Photo '+ (nextIndex+1) +' of '+ this.data.length);
                },
                onPageTransitionOut:       function(callback) {
                    this.fadeTo('fast', 0.0, callback);
                },
                onPageTransitionIn:        function() {
                    var prevPageLink = this.find('a.prev').css('visibility', 'hidden');
                    var nextPageLink = this.find('a.next').css('visibility', 'hidden');
                    
                    // Show appropriate next / prev page links
                    if (this.displayedPage > 0)
                        prevPageLink.css('visibility', 'visible');

                    var lastPage = this.getNumPages() - 1;
                    if (this.displayedPage < lastPage)
                        nextPageLink.css('visibility', 'visible');

                    this.fadeTo('fast', 1.0);
                }
            });

            /**************** Event handlers for custom next / prev page links **********************/

            gallery.find('a.prev').click(function(e) {
                gallery.previousPage();
                e.preventDefault();
            });

            gallery.find('a.next').click(function(e) {
                gallery.nextPage();
                e.preventDefault();
            });

            /****************************************************************************************/

            /**** Functions to support integration of galleriffic with the jquery.history plugin ****/

            // PageLoad function
            // This function is called when:
            // 1. after calling $.historyInit();
            // 2. after calling $.historyLoad();
            // 3. after pushing "Go Back" button of a browser
            function pageload(hash) {
                // alert("pageload: " + hash);
                // hash doesn't contain the first # character.
                if(hash) {
                    $.galleriffic.gotoImage(hash);
                } else {
                    gallery.gotoIndex(0);
                }
            }

            // Initialize history plugin.
            // The callback is called at once by present location.hash. 
            $.historyInit(pageload, "advanced.html");

            // set onlick event for buttons using the jQuery 1.3 live method
            $("a[rel='history']").live('click', function(e) {
                if (e.button != 0) return true;

                var hash = this.href;
                hash = hash.replace(/^.*#/, '');

                // moves to a new page. 
                // pageload is called at once. 
                // hash don't contain "#", "?"
                $.historyLoad(hash);

                return false;
            });

            /****************************************************************************************/
        });
    </script>