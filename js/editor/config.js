/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.language = 'ru';
	config.uiColor = '#F6f6f6';

config.extraPlugins = 'youtube';


	//config.skin = 'chris';
	config.enterMode = CKEDITOR.ENTER_BR;

	

	config.toolbar_Admin =
	[
    { name: 'document',    items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
    { name: 'clipboard',   items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
    { name: 'editing',     items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
    { name: 'forms',       items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    '/',
    { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
    { name: 'paragraph',   items : [ 'NumberedList','BulletedList','-','Outdent','Indent','-','Blockquote','CreateDiv','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
    { name: 'links',       items : [ 'Link','Unlink','Anchor' ] },
    { name: 'insert',      items : [ 'Youtube','Table','HorizontalRule','Smiley','SpecialChar','PageBreak' ] },
    '/',
    { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
    { name: 'colors',      items : [ 'TextColor','BGColor' ] },
    { name: 'tools',       items : [ 'Maximize', 'ShowBlocks' ] }
	];
	
	config.toolbar_User =
	[
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','Templates','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','ImageButton','Youtube','Link','Unlink','Anchor','Table','HorizontalRule','Smiley','SpecialChar','TextColor','BGColor'] },
    '/',

    { name: 'styles',      items : [ 'Styles','Format','Font','FontSize' ] },
    { name: 'tools',       items : [ 'Maximize','SelectAll','RemoveFormat','Preview' ] }
	];
	
	config.toolbar_Comment =
	[
	{ name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','Undo','Redo','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','ImageButton','Youtube','Link','Unlink','Anchor','Smiley','SpecialChar','TextColor','BGColor',' - ','Font','FontSize'] },
	];



config.toolbar = 'User';
config.toolbarCanCollapse = false;
};
