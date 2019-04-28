(function() {
    tinymce.PluginManager.add('wp_facebook_popup', function( editor, url ) {
        editor.addButton( 'wp_facebook_popup', {
            title: 'Hide Facebook Popup On this Page / Post',
            icon: 'icon wp_facebook_popup',
            onclick: function() {
                editor.insertContent("[hidefbpopup]");
            }
        });
    });
})();