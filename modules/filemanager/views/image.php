<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8"/>
<title>Image Manager</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/themes/smoothness/jquery-ui.css">
<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url( 'public/js/jquery-ui/css/smoothness/jquery-ui.css' )  ?>"> -->
<!--<link rel="stylesheet" href="<?php echo $assets_url; ?>/jquery-ui-1.8.23/css/themes/smoothness/jquery-ui.css"/>-->
<link type="text/css" rel="stylesheet" href="<?php echo $assets_url; ?>/elfinder/css/elfinder.min.css"/>
<link type="text/css" rel="stylesheet" href="<?php echo $assets_url; ?>/elfinder/css/theme.css"/>
<style>
html, body {
	margin: 0;
	overflow: hidden;
}
/* make elfinder allways fit windows */
html, body, #image-manager, .elfinder-workzone > .ui-resizable, .elfinder-workzone .elfinder-cwd-wrapper {
	height: 100%;
}
</style>
</head>
<body>
    
    <div id="image-manager"></div>
	
	
	<script src="<?php echo $assets_url; ?>/js/jquery-1.8.3.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.23/jquery-ui.min.js"></script>
	<script src="<?php echo $assets_url; ?>/elfinder/js/elfinder.min.js"></script>
	
	<script>
	function getUrlParam(paramName) {
		var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
		var match = window.location.search.match(reParam) ;
		return (match && match.length > 1) ? match[1] : '' ;
	}
	
	var finder = $('#image-manager').elfinder({
		url             : '<?php echo $connector_url; ?>',
		height          : 'auto',
		onlyMimes       : <?php echo $allowed_mimes; ?>,
		resizeable      : false,
		rememberLastDir : false,
		getFileCallback : function(file) {
			var CKEditorFuncNum = getUrlParam('CKEditorFuncNum'),
					callback = getUrlParam('callback');
			
			try {
				// callback for CKEditor mode
				if (CKEditorFuncNum) 
				{
    				window.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, file.url);
				} else if (window.target_object) {
					console.log(arguments);
					window.opener.jQuery(window.target_object).trigger('getFileCallback', file);
				}
			} catch(e) {
				alert(e);
			} finally {
				// close windows when its done
				window.close();
			}
		},
		handlers        : {
			'load' : function(e, instance){
				// make elfinder allways fit windows
				setTimeout(function(){
					instance.ui.workzone.find('[style]').css('height', '');
				}, 1000);
			}
		}
	});
	</script>
	
</body>
</html>