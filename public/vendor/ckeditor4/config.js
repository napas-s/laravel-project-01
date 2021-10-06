/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {

    config.language = 'th';
	config.height = 500;

	// Define changes to default configuration here.
	// For complete reference see:
	// https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html

	// The toolbar groups arrangement, optimized for two toolbar rows.
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];

    config.extraPlugins =  'image2,justify,panelbutton,colorbutton,iframe,wordcount,find,lineheight,copyformatting,video,textindent,bidi,article' ;

	config.removePlugins = 'image,about';
	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	// config.removeDialogTabs = 'image:advanced;link:advanced';
    //uploadfile
	config.filebrowserBrowseUrl = '/vendor/ckeditor4/plugins/ckfinder/ckfinder.html';
    config.filebrowserImageBrowseUrl = '/vendor/ckeditor4/plugins/ckfinder/ckfinder.html?type=Images';
    config.filebrowserFlashBrowseUrl = '/vendor/ckeditor4/plugins/ckfinder/ckfinder.html?type=Flash';
    config.filebrowserUploadUrl = '/vendor/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
    config.filebrowserImageUploadUrl = '/vendor/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
    config.filebrowserFlashUploadUrl = '/vendor/ckeditor4/plugins/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};


CKEDITOR.addCss('.cke_editable img { max-width: 100% !important; height: auto !important; }');
