/**
 * @license Copyright (c) 2003-2015, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
    // Define changes to default configuration here.
    // For complete reference see:
    // http://docs.ckeditor.com/#!/api/CKEDITOR.config

    // The toolbar groups arrangement, optimized for two toolbar rows.
    config.toolbarGroups = [
        { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
        { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
        { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
        { name: 'links', groups: [ 'links' ] },
        { name: 'insert', groups: [ 'insert' ] },
        { name: 'others', groups: [ 'others' ] },
        { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
        { name: 'align', groups: [ 'align' ] },
        { name: 'paragraph', groups: [ 'blocks', 'list', 'indent', 'bidi', 'paragraph' ] },
        { name: 'styles', groups: [ 'styles' ] },
        { name: 'tools', groups: [ 'tools' ] },
    ];
    config.removeButtons = 'Subscript,Superscript,About,Strike,Cut,Copy,Paste,PasteText,PasteFromWord,Scayt,Anchor,SpecialChar';

    config.extraPlugins = 'div,stylesheetparser,justify,font';

    config.allowedContent = true;

    config.toolbarCanCollapse = true;
    config.toolbarStartupExpanded = false;

    config.format_tags = 'h1;h2;h3;h4;h5;h6;p;pre';

    config.bodyClass = 'container-fluid';
    config.contentsCss = ['/css/app.bundle.css', '/css/app.css'];

    config.filebrowserBrowseUrl      = '/elfinder/ckeditor';
    config.filebrowserImageBrowseUrl = '/elfinder/ckeditor';
};