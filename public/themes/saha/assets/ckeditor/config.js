/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

var script = document.currentScript.src;

var res = script.replace( "config.js", "bizidea.js" ); 

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

    config.allowedContent = true;
    config.enterMode = CKEDITOR.ENTER_P;
    config.shiftEnterMode = CKEDITOR.ENTER_BR;
    config.autoParagraph = false;   
    config.extraPlugins = 'templates'; 
    config.templates = 'bizidea';      // ชื่อ template collection
    config.templates_files = [res]; // ไฟล์ template
    config.basicEntities = false;
    
};
