<?php

class TpsAdmin_VectorIconsPicker
{
    public static function render($optionGroup, array $options)
    {
        $icons = TpsOptions::get_vector_icons();

        ?>
        <div class="tps-vector-icons-picker">
            <select class="_icons-picker"
                    name="<?php echo $optionGroup ?>[theme_font_name]">
                <?php
                foreach ($icons as $name => $icon) {
                    $displayName = ucwords(str_replace('-', ' ', $name));

                    switch ($icon['type']) {
                        case 'font':
                            $leftIcon = TpsOptions::get_span_for_font_icon($icon['leftClass']);
                            $rightIcon = TpsOptions::get_span_for_font_icon($icon['rightClass']);
                            break;

                        case 'svg':
                        default:
                            $leftIcon = TpsOptions::get_svg_for_icon($name, 'left');
                            $rightIcon = TpsOptions::get_svg_for_icon($name, 'right');
                            break;
                    }

                    if ($name === 'None') {
                        $leftIcon = '';
                        $rightIcon = '';
                    }

                    ?>
                    <option data-type="svg" <?php echo $name == $options['theme_font_name'] ? ' selected' : '' ?>
                            value="<?php echo $name ?>"
                            data-left-icon="<?php echo htmlspecialchars($leftIcon) ?>"
                            data-right-icon="<?php echo htmlspecialchars($rightIcon) ?>">
                        <?php echo $displayName ?>
                    </option>
                    <?php
                }
                ?>
            </select>
            <input type="hidden"
                   id="tps_theme_vector_left_icon"
                   name="<?php echo $optionGroup ?>[theme_vector_left_icon]"
                   value="<?php echo htmlspecialchars($options['theme_vector_left_icon']); ?>">
            <input type="hidden"
                   id="tps_theme_vector_right_icon"
                   name="<?php echo $optionGroup ?>[theme_vector_right_icon]"
                   value="<?php echo htmlspecialchars($options['theme_vector_right_icon']); ?>">
        </div>

        <script type="text/javascript">
            var slimVectorIconsPicker;
            var vectorIconsData = {};

            jQuery(document).ready(function ($) {
                var picker = $('.tps-vector-icons-picker ._icons-picker');
                var data = [];
                picker.find('option').each(function () {
                    vectorIconsData[$(this).attr('value')] = {
                        leftIcon: $(this).attr('data-left-icon'),
                        rightIcon: $(this).attr('data-right-icon')
                    };

                    data.push({
                        innerHTML: $(this).attr('data-left-icon') + $(this).attr('data-right-icon') + $(this).html(),
                        text: $(this).html(),
                        value: $(this).attr('value'),
                        selected: $(this).attr('selected')
                    });
                });

                slimVectorIconsPicker = new SlimSelect({
                    select: picker[0],
                    valuesUseText: false,
                    data: data
                });

                picker.on('change', function () {
                    // Update font codes.
                    var selected = vectorIconsData[slimVectorIconsPicker.selected()];
                    $('#tps_theme_vector_left_icon').attr('value', selected.leftIcon);
                    $('#tps_theme_vector_right_icon').attr('value', selected.rightIcon);
                    if (selected.leftIcon === '') {
                        $('.theiaPostSlider_nav ._buttons ._button span').each(function () {
                            if (!$(this).text().trim().length) {
                                $(this).css("margin", "0");
                            }
                        });
                    }
                });
            });
        </script>
        <?php
    }
}