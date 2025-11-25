tinyMCE.init({
    mode: "textareas", // important
	editor_selector: "editor-instance",	// important
     
	valid_elements: '*[*]',
	height: "350",
    content_css : "/new/include/css/grid.css,/new/include/css/template.css,/new/include/css/base.css,/new/include/css/layout.css",

    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen ",
        "insertdatetime media nonbreaking save table contextmenu directionality",
        "emoticons template paste textcolor h3 Twocolumns"
    ],
    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media | forecolor backcolor h3 Twocolumns",
    image_advtab: true,
    
    file_browser_callback: function(field, url, type, win) {
        tinyMCE.activeEditor.windowManager.open({
            file: 'kcfinder/browse.php?opener=tinymce4&field=' + field + '&type=' + type,
            title: 'Image manager',
            width: 700,
            height: 500,
            inline: true,
            close_previous: false
        }, {
            window: win,
            input: field
        });
        return false;
    }

});