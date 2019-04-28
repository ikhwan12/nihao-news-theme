<?php

/*
 * Copyright 2012-2018, Theia Post Slider, WeCodePixels, http://wecodepixels.com
 */

class TpsAdmin_General
{
    public $showPreview = true;

    public function echoPage()
    {
        $icons = TpsOptions::get_vector_icons();

        ?>
        <form method="post" action="options.php">
            <?php settings_fields('tps_options_general'); ?>
            <?php $options = get_option('tps_general'); ?>

            <table class="form-table">
                <tr valign="top">
                    <th scope="row">
                        <label><?php _e("Theme:", 'theia-post-slider'); ?></label>
                    </th>
                    <td>
                        <label>
                            <input type="radio"
                                   id="tps_theme_type_font"
                                   name="tps_general[theme_type]"
                                   value="font" <?php echo $options['theme_type'] == 'font' ? 'checked' : ''; ?>
                                   onchange="updateSlider()">
                            Vector icons
                            <p class="description">
                                <strong><?php echo count($icons) ?></strong> awesome font and SVG vector icons. Retina-ready. Can be
                                highly customized.
                            </p>
                        </label>
                        <br>
                        <table class="form-table">
                            <tr valign="top">
                                <th scope="row">
                                    Icons:
                                </th>
                                <td>
                                    <?php TpsAdmin_VectorIconsPicker::render('tps_general', $options) ?>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    Color:
                                </th>
                                <td>
                                    <input type="text"
                                           id="tps_theme_font_color"
                                           name="tps_general[theme_font_color]"
                                           value="<?php echo $options['theme_font_color']; ?>">
                                    <script>
                                        jQuery(document).ready(function ($) {
                                            $('#tps_theme_font_color').wpColorPicker({
                                                change: updateSlider,
                                                clear: updateSlider
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    Size (px):
                                </th>
                                <td>
                                    <input type="number"
                                           class="small-text"
                                           id="tps_theme_font_size"
                                           name="tps_general[theme_font_size]"
                                           value="<?php echo htmlentities($options['theme_font_size']); ?>"
                                           onchange="updateSlider()">
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    Background color:
                                </th>
                                <td>
                                    <input type="text"
                                           id="tps_theme_background_color"
                                           name="tps_general[theme_background_color]"
                                           value="<?php echo $options['theme_background_color']; ?>">
                                    <script>
                                        jQuery(document).ready(function ($) {
                                            $('#tps_theme_background_color').wpColorPicker({
                                                change: updateSlider,
                                                clear: updateSlider
                                            });
                                        });
                                    </script>
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    Padding (px):
                                </th>
                                <td>
                                    <input type="number"
                                           class="small-text"
                                           id="tps_theme_padding"
                                           name="tps_general[theme_padding]"
                                           value="<?php echo htmlentities($options['theme_padding']); ?>"
                                           onchange="updateSlider()">
                                </td>
                            </tr>
                            <tr valign="top">
                                <th scope="row">
                                    Border radius (px):
                                </th>
                                <td>
                                    <input type="number"
                                           class="small-text"
                                           id="tps_theme_border_radius"
                                           name="tps_general[theme_border_radius]"
                                           value="<?php echo htmlentities($options['theme_border_radius']); ?>"
                                           onchange="updateSlider()">
                                </td>
                            </tr>
                        </table>
                        <br>

                        <p></p>
                        <br>

                        <label>
                            <input type="radio"
                                   id="tps_theme_type_classic"
                                   name="tps_general[theme_type]"
                                   value="classic" <?php echo $options['theme_type'] == 'classic' ? 'checked' : ''; ?>
                                   onchange="updateSlider()">
                            Classic theme
                            <p class="description">
                                Lots of themes to choose from. Plenty of variations.
                            </p>
                        </label>
                        <br>
                        <select id="tps_theme_classic_name" name="tps_general[theme]" onchange="updateSlider()">
                            <?php
                            foreach (TpsOptions::get_themes() as $key => $value) {
                                $output = '<option value="' . $key . '"' . ($key == $options['theme'] ? ' selected' : '') . '>' . $value . '</option>' . "\n";
                                echo $output;
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="tps_transition_effect"><?php _e("Transition effect:", 'theia-post-slider'); ?></label>
                    </th>
                    <td>
                        <select id="tps_transition_effect"
                                name="tps_general[transition_effect]"
                                onchange="updateSlider()">
                            <?php
                            foreach (TpsOptions::get_transition_effects() as $key => $value) {
                                $output = '<option value="' . $key . '"' . ($key == $options['transition_effect'] ? ' selected' : '') . '>' . $value . '</option>' . "\n";
                                echo $output;
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="tps_transition_speed"><?php _e("Transition duration (ms):", 'theia-post-slider'); ?></label>
                    </th>
                    <td>
                        <input type="number"
                               class="small-text"
                               id="tps_transition_speed"
                               name="tps_general[transition_speed]"
                               value="<?php echo htmlentities($options['transition_speed']); ?>"
                               onchange="updateSlider()"/>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">
                        <label for="tps_custom_css"><?php _e("Custom CSS:", 'theia-post-slider'); ?></label>
                        <p class="description">
                            Useful selectors:<br>
                            .theiaPostSlider_nav ._prev<br>
                            .theiaPostSlider_nav ._next
                        </p>
                    </th>
                    <td>
                        <textarea class="large-text code"
                                  rows="10"
                                  id="tps_custom_css"
                                  name="tps_general[custom_css]"
                                  onchange="updateSlider()"><?php echo $options['custom_css']; ?></textarea>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit"
                       class="button-primary"
                       value="<?php _e('Save All Changes', 'theia-post-slider') ?>"/>
            </p>
        </form>

        <script type="text/javascript">
            function updateSlider() {
                var $ = jQuery;
                var styleId = 'tps_custom_style';
                var styleElement = $('#' + styleId);
                var themeType = $('#tps_theme_type_font').is(':checked') ? 'font' : 'classic';
                var customCss = [];
                var selected = vectorIconsData[slimVectorIconsPicker.selected()];

                // Get custom CSS.
                customCss.push($('#tps_custom_css').val());

                if (themeType == 'font') {
                    var buttonCss = [];

                    // Update background color.
                    var backgroundColor = $('#tps_theme_background_color').val();
                    buttonCss.push("background-color: " + (backgroundColor ? backgroundColor : 'transparent'));

                    // Update padding.
                    var padding = $('#tps_theme_padding').val();
                    buttonCss.push("padding: " + parseInt(padding) + "px");

                    // Update border radius.
                    var borderRadius = $('#tps_theme_border_radius').val();
                    buttonCss.push("border-radius: " + parseInt(borderRadius) + "px");

                    customCss.push(".theiaPostSlider_adminContainer_right .theiaPostSlider_nav ._buttons ._button { " + buttonCss.join(";") + " }");
                }

                // Update theme type options.
                $('.tps-vector-icons-picker ._icons-picker, #tps_theme_font_size, #tps_theme_padding, #tps_theme_border_radius').attr('disabled', themeType != 'font');
                $('#tps_theme_classic_name').attr('disabled', themeType != 'classic');

                // Update CSS file.
                var css = $('#theiaPostSlider-css');
                var val = themeType == 'font' ? 'font-theme.css' : $('#tps_theme_classic_name').val();
                var href = '<?php echo TPS_PLUGINS_URL . 'css/' ?>' + val + '?ver=<?php echo TPS_VERSION ?>';
                if (css.attr('href') != href) {
                    css.attr('href', href);
                }

                if (typeof(slider) != 'undefined') {
                    // Update transition.
                    slider.setTransition({
                        'effect': $('#tps_transition_effect').val(),
                        'speed': parseInt($('#tps_transition_speed').val())
                    });

                    // Update buttons.
                    slider.options.themeType = themeType;
                    slider.options.prevFontIcon = selected.leftIcon;
                    slider.options.nextFontIcon = selected.rightIcon;
                    slider.updateNavigationBars();
                }

                // Update CSS rules.
                var fontSize;
                if (themeType == 'font') {
                    $('.theiaPostSlider_nav').addClass('fontTheme');
                    fontSize = $('#tps_theme_font_size').val();
                } else {
                    $('.theiaPostSlider_nav').removeClass('fontTheme');
                    fontSize = 'inherit';
                }
                customCss.push(
                    '.theiaPostSlider_nav.fontTheme ._prev ._2 span, .theiaPostSlider_nav.fontTheme ._next ._2 span {' +
                    'font-size: ' + fontSize + 'px;' +
                    'line-height: ' + fontSize + 'px;' +
                    '}'
                );
                customCss.push(
                    '.theiaPostSlider_nav.fontTheme ._prev ._2 svg, .theiaPostSlider_nav.fontTheme ._next ._2 svg {' +
                    'width: ' + fontSize + 'px;' +
                    'line-height: ' + fontSize + 'px;' +
                    '}'
                );
                customCss.push('.theiaPostSlider_nav.fontTheme ._prev, .theiaPostSlider_nav.fontTheme ._next { color: ' + $('#tps_theme_font_color').val() + '; }');
                customCss.push('.theiaPostSlider_nav.fontTheme ._prev svg, .theiaPostSlider_nav.fontTheme ._next svg { fill: ' + $('#tps_theme_font_color').val() + '; }');

                // Update custom CSS.
                if (styleElement.length == 0) {
                    styleElement = $('<style id="' + styleId + '"></style>').appendTo('head');
                }
                styleElement.html(customCss.join("\n"));
            }

            jQuery(document).bind('theiaPostSlider.changeSlide', function (event, slideIndex) {
                updateSlider();
            });

            jQuery(document).ready(function ($) {
                updateSlider();
            });

            jQuery('.tps-vector-icons-picker ._icons-picker').on('change', function() {
                updateSlider();
            });
        </script>
        <?php
    }
}
