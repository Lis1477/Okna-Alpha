/**
 * @license Copyright (c) 2003-2019, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.filebrowserBrowseUrl = '/adm/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
	config.filebrowserImageBrowseUrl = '/adm/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
	config.filebrowserFlashBrowseUrl = '/adm/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
	config.filebrowserUploadUrl = '/adm/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
	config.filebrowserImageUploadUrl = '/adm/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
	config.filebrowserFlashUploadUrl = '/adm/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';

config.indentClasses = ["ul-grey", "ul-red", "text-red", "ul-content-red", "circle", "style-none", "decimal", "paragraph-portfolio-top", "ul-portfolio-top", "url-portfolio-top", "text-grey"];
config.protectedSource.push(/<(style)[^>]*>.*<\/style>/ig);
config.protectedSource.push(/<(script)[^>]*>.*<\/script>/ig);// разрешить теги <script>
config.protectedSource.push(/<\?[\s\S]*?\?>/g);// разрешить php-код
config.protectedSource.push(/<!--dev-->[\s\S]*<!--\/dev-->/g);
config.allowedContent = true; /* all tags */

config.basicEntities = false;


};
