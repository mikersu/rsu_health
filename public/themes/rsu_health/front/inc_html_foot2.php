<?php 
$logo_company_footer = $this->content_config_model->get( 'logo_company_footer' ); 
$logo_company_footer = base_url().call_image_site( $logo_company_footer , 61 , 19 );

$company_name = $this->content_config_model->get( 'company_name' ); 
$company_name = ( ! empty( $company_name ) ) ? $company_name : 'APE' ;
?>
        </article>
    </section>
    <footer>
      <div class="footer">
          <div class="container">
              <img src="<?php echo $logo_company_footer ?>" class="logo"/>
                © 2013 CopyRight by <?php echo $company_name ?> , Powered by  
                <a  target="blank" rel="dofollow" title="รับทําเว็บไซต์" alt="รับทําเว็บไซต์" href="http://bizidea.co.th">Biz Idea</a>
                <div class="footer__back">
                  <a href="javascript:void(0)" class="hoverOpa" id="top"><?php echo lang_get('GO TO TOP') ?></a>
                </div>
            </div>
        </div>
    </footer>  

</body>
</html>