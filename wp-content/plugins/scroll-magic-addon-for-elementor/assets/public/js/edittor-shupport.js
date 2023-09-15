"use strict";

(function ($) {

    function addCustomCss(css, view) {
        const model = view.getEditModel(),
            customCSS = model.get('settings').get('custom_css'),
            attributes = model.get('settings').attributes;
        let default_css = '{',
            transform_css = 'transform:',
            group1 = ['width', 'height',],
            group2 = ['background-color', 'color', 'opacity', 'display', 'transform-origin'],
            group3 = ['rotateX', 'rotateY', 'rotateZ', 'skewY', 'skewX'],
            group4 = ['translateX', 'translateY', 'translateZ'];
        Object.keys(attributes).forEach(function (item) {
            if (item == null && item !== 0) {
            } else {
                if (item.indexOf("wpmp-def_") > -1) {
                    var nameCSS = item.replace(/wpmp-def_/, '');
                    if (group1.indexOf(nameCSS) > -1) {

                        default_css += nameCSS + ':' + attributes[item] + 'px;';

                    } else if (group2.indexOf(nameCSS) > -1) {

                        default_css += nameCSS + ':' + attributes[item] + ';';

                    } else if (group3.indexOf(nameCSS) > -1) {

                        transform_css += nameCSS + '(' + attributes[item] + 'deg)';

                    } else if (group4.indexOf(nameCSS) > -1) {

                        transform_css += nameCSS + '(' + attributes[item] + 'px)';

                    } else {

                        transform_css += nameCSS + '(' + attributes[item] + ')';

                    }
                }
            }

        });
        if (transform_css !== 'transform:') {
            default_css += transform_css + ";";
        }

        if (default_css === '{') {
            return;
        } else {
            default_css += '}';
            default_css = '.elementor-element.elementor-element-' + view.model.id + ' .elementor-widget-container *:not(.scrollMagicControl)' + default_css;
        }

        return default_css;
    }

    function addPageCustomCss() {
        let customCSS = elementor.settings.page.model.get('custom_css');
        if (customCSS) {
            customCSS = customCSS.replace(/selector/g, elementor.config.settings.page.cssWrapperSelector);
            elementor.settings.page.getControlsCSS().elements.$stylesheetElement.append(customCSS);
        }
    }

    // elementor.hooks.addFilter('editor/style/styleText', addCustomCss);


    function addEffect(panel, model) {

    }
    elementor.hooks.addFilter('editor/style/styleText', addCustomCss);
})(jQuery);