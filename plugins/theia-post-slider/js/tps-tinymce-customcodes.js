(function () {
    tinymce.create('tinymce.plugins.theiaPostSliderPlugin', {
        init: function (ed, url) {
            ed.addButton('tps_header', {
                title: 'Add the Theia Post Slider header',
                image: url + '/../images/tinymce-customcodes/tps-shortcodes-header.png',
                onclick: function () {
                    ed.selection.setContent('[tps_header]' + ed.selection.getContent() + '[/tps_header]');
                }
            });
            ed.addButton('tps_title', {
                title: 'Add a Theia Post Slider title',
                image: url + '/../images/tinymce-customcodes/tps-shortcodes-title.png',
                onclick: function () {
                    ed.selection.setContent('[tps_title]' + ed.selection.getContent() + '[/tps_title]');
                }
            });
            ed.addButton('tps_footer', {
                title: 'Add the Theia Post Slider footer',
                image: url + '/../images/tinymce-customcodes/tps-shortcodes-footer.png',
                onclick: function () {
                    ed.selection.setContent('[tps_footer]' + ed.selection.getContent() + '[/tps_footer]');
                }
            });
            ed.addButton('tps_start_button', {
                title: 'Add a button that starts the slideshow',
                image: url + '/../images/tinymce-customcodes/tps-shortcodes-start-button.png',
                onclick: function () {
                    ed.selection.setContent('[tps_start_button label="Start slideshow" style="" class=""]');
                }
            });
        },
        createControl: function (n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('theiaPostSlider', tinymce.plugins.theiaPostSliderPlugin);
})();