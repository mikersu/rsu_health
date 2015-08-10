  <script type="text/javascript" src="<?php echo $this->theme_path; ?>share-js/nprogress/nprogress.js"></script> 
  <link rel="stylesheet" type="text/css" href="<?php echo $this->theme_path; ?>share-js/nprogress/nprogress.css" />
  
    <script type="text/javascript" >

        NProgress.start();
        setTimeout(function() { NProgress.done(); }, 1000);


        $(function() {


            $('body').click(function(event) 
            {
                if ( $('.alert').hasClass('alert-success') ) 
                {
                    $('.alert-success').fadeOut('slow');
                };
            });



            if ( $('.this_ckeditor').hasClass('ckeditor') ) 
            {

                CKEDITOR.replace('detail', {
                            filebrowserBrowseUrl : '<?php echo site_url('filemanager/image'); ?>',
                            // filebrowserBrowseUrl : '../filemanager/image',
                            // width: 650,
                            // height:300,
                            enterMode: 2,
                            toolbar : [
                                { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ] },
                                { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
                                { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Scayt' ] },
                                '/',
                                { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Strike', '-', 'RemoveFormat' ] },
                                { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote'] },
                                { name: 'netclub', items: [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock' ] },
                                { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
                                { name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
                                '/',
                                { name: 'styles', items: [ 'Styles', 'Format' ,'Font','FontSize','TextColor','BGColor'] },
                                { name: 'tools', items: [ 'Maximize' ] },
                                { name: 'others', items: [ '-' ] },
                                { name: 'about', items: [ 'About' ] }
                            ]
                            
                });

            }


            $('#mark_sort').attr('style', '');


        });     

    </script>        


	</body>
	
</html>
