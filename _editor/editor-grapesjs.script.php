<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Editor for certificatebeautiful.
 *
 * @package     mod_certificatebeautiful
 * @copyright   2024 Eduardo Kraus https://eduardokraus.com/
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
$langs = [
    "grapsjs-assetmanager-addbutton" => "Add image",
    "grapsjs-assetmanager-modaltitle" => "Select image",
    "grapsjs-assetmanager-uploadtitle" => "Drop files here or click to upload",
    "grapsjs-attachment" => "Attachment",
    "grapsjs-certificate_confirm_clear" => "Are you sure you want to clear the canvas?",
    "grapsjs-certificate_page_save" => "Save certificate page",
    "grapsjs-certificate_page_test" => "Test PDF",
    "grapsjs-clear" => "Clear canvas",
    "grapsjs-decoration" => "Decorations",
    "grapsjs-devicemanager-device" => "Device",
    "grapsjs-devicemanager-devices-desktop" => "Desktop",
    "grapsjs-devicemanager-devices-mobilelandscape" => "Mobile, landscape mode",
    "grapsjs-devicemanager-devices-mobileportrait" => "Mobile, portrait mode",
    "grapsjs-devicemanager-devices-tablet" => "Tablet",
    "grapsjs-dimensions" => "Dimensions",
    "grapsjs-domcomponents-names-" => "Box",
    "grapsjs-domcomponents-names-body" => "Body",
    "grapsjs-domcomponents-names-cell" => "Table Cell",
    "grapsjs-domcomponents-names-comment" => "Comment",
    "grapsjs-domcomponents-names-image" => "Image",
    "grapsjs-domcomponents-names-label" => "Label",
    "grapsjs-domcomponents-names-link" => "Link",
    "grapsjs-domcomponents-names-map" => "Map",
    "grapsjs-domcomponents-names-row" => "Table Row",
    "grapsjs-domcomponents-names-section" => "Section",
    "grapsjs-domcomponents-names-table" => "Table",
    "grapsjs-domcomponents-names-tbody" => "Table Body",
    "grapsjs-domcomponents-names-text" => "Text",
    "grapsjs-domcomponents-names-tfoot" => "Table Footer",
    "grapsjs-domcomponents-names-thead" => "Table Header",
    "grapsjs-domcomponents-names-video" => "Video",
    "grapsjs-domcomponents-names-wrapper" => "Body",
    "grapsjs-edit_code" => "Edit code",
    "grapsjs-edit_code_paste_here_html" => "Paste your HTML/CSS here and click Import",
    "grapsjs-fullscreen" => "Full Screen",
    "grapsjs-general" => "General",
    "grapsjs-open_block" => "Blocks",
    "grapsjs-open_layers" => "Layers",
    "grapsjs-open_sm" => "Style Manager",
    "grapsjs-panels-buttons-titles-export-template" => "View Code",
    "grapsjs-panels-buttons-titles-fullscreen" => "Fullscreen",
    "grapsjs-panels-buttons-titles-open-blocks" => "Open Blocks",
    "grapsjs-panels-buttons-titles-open-layers" => "Open Layer Manager",
    "grapsjs-panels-buttons-titles-open-sm" => "Open Style Manager",
    "grapsjs-panels-buttons-titles-open-tm" => "Settings",
    "grapsjs-panels-buttons-titles-preview" => "Preview",
    "grapsjs-panels-buttons-titles-sw-visibility" => "Show Components",
    "grapsjs-position" => "Position",
    "grapsjs-preview" => "Preview",
    "grapsjs-redo" => "Redo",
    "grapsjs-repeat" => "Repeat",
    "grapsjs-selectormanager-emptystate" => "- State -",
    "grapsjs-selectormanager-label" => "Classes",
    "grapsjs-selectormanager-selected" => "Selected",
    "grapsjs-selectormanager-states-active" => "Click",
    "grapsjs-selectormanager-states-hover" => "Hover",
    "grapsjs-selectormanager-states-nth-of-type-2n" => "Even/Odd",
    "grapsjs-settings" => "Settings",
    "grapsjs-show_border" => "Show Borders",
    "grapsjs-size" => "Size",
    "grapsjs-stylemanager-empty" => "Select an element to use the style manager",
    "grapsjs-stylemanager-filebutton" => "Images",
    "grapsjs-stylemanager-layer" => "Layer",
    "grapsjs-stylemanager-properties-align-content" => "Align Content",
    "grapsjs-stylemanager-properties-align-items" => "Align Items",
    "grapsjs-stylemanager-properties-align-self" => "Align Self",
    "grapsjs-stylemanager-properties-background" => "Background",
    "grapsjs-stylemanager-properties-background-attachment" => "Background Attachment",
    "grapsjs-stylemanager-properties-background-color" => "Background Color",
    "grapsjs-stylemanager-properties-background-image" => "Background Image",
    "grapsjs-stylemanager-properties-background-position" => "Background Position",
    "grapsjs-stylemanager-properties-background-repeat" => "Background Repeat",
    "grapsjs-stylemanager-properties-background-size" => "Background Size",
    "grapsjs-stylemanager-properties-border" => "Border",
    "grapsjs-stylemanager-properties-border-bottom-left" => "Border Bottom Left",
    "grapsjs-stylemanager-properties-border-bottom-right" => "Border Bottom Right",
    "grapsjs-stylemanager-properties-border-color" => "Border Color",
    "grapsjs-stylemanager-properties-border-radius" => "Border Radius",
    "grapsjs-stylemanager-properties-border-radius-bottom-left" => "Border Radius Bottom Left",
    "grapsjs-stylemanager-properties-border-radius-bottom-right" => "Border Radius Bottom Right",
    "grapsjs-stylemanager-properties-border-radius-top-left" => "Border Radius Top Left",
    "grapsjs-stylemanager-properties-border-radius-top-right" => "Border Radius Top Right",
    "grapsjs-stylemanager-properties-border-style" => "Border Style",
    "grapsjs-stylemanager-properties-border-top-left" => "Border Top Left",
    "grapsjs-stylemanager-properties-border-top-right" => "Border Top Right",
    "grapsjs-stylemanager-properties-border-width" => "Border Width",
    "grapsjs-stylemanager-properties-bottom" => "Bottom",
    "grapsjs-stylemanager-properties-box-shadow" => "Box Shadow",
    "grapsjs-stylemanager-properties-box-shadow-blur" => "Box Shadow Blur",
    "grapsjs-stylemanager-properties-box-shadow-color" => "Box Shadow Color",
    "grapsjs-stylemanager-properties-box-shadow-h" => "Box Shadow: Horizontal",
    "grapsjs-stylemanager-properties-box-shadow-spread" => "Box Shadow Spread",
    "grapsjs-stylemanager-properties-box-shadow-type" => "Box Shadow Type",
    "grapsjs-stylemanager-properties-box-shadow-v" => "Box Shadow: Vertical",
    "grapsjs-stylemanager-properties-color" => "Color",
    "grapsjs-stylemanager-properties-display" => "Display",
    "grapsjs-stylemanager-properties-flex-basis" => "Flex Basis",
    "grapsjs-stylemanager-properties-flex-direction" => "Flex Direction",
    "grapsjs-stylemanager-properties-flex-grow" => "Flex Grow",
    "grapsjs-stylemanager-properties-flex-shrink" => "Flex Shrink",
    "grapsjs-stylemanager-properties-flex-wrap" => "Flex Wrap",
    "grapsjs-stylemanager-properties-float" => "Float",
    "grapsjs-stylemanager-properties-font-family" => "Font Family",
    "grapsjs-stylemanager-properties-font-size" => "Font Size",
    "grapsjs-stylemanager-properties-font-weight" => "Font Weight",
    "grapsjs-stylemanager-properties-height" => "Height",
    "grapsjs-stylemanager-properties-justify-content" => "Justify Content",
    "grapsjs-stylemanager-properties-left" => "Left",
    "grapsjs-stylemanager-properties-letter-spacing" => "Letter Spacing",
    "grapsjs-stylemanager-properties-line-height" => "Line Height",
    "grapsjs-stylemanager-properties-margin" => "Margin",
    "grapsjs-stylemanager-properties-margin-bottom" => "Margin Bottom",
    "grapsjs-stylemanager-properties-margin-left" => "Margin Left",
    "grapsjs-stylemanager-properties-margin-right" => "Margin Right",
    "grapsjs-stylemanager-properties-margin-top" => "Margin Top",
    "grapsjs-stylemanager-properties-max-height" => "Max Height",
    "grapsjs-stylemanager-properties-max-width" => "Max Width",
    "grapsjs-stylemanager-properties-order" => "Order",
    "grapsjs-stylemanager-properties-padding" => "Padding",
    "grapsjs-stylemanager-properties-padding-bottom" => "Padding Bottom",
    "grapsjs-stylemanager-properties-padding-left" => "Padding Left",
    "grapsjs-stylemanager-properties-padding-right" => "Padding Right",
    "grapsjs-stylemanager-properties-padding-top" => "Padding Top",
    "grapsjs-stylemanager-properties-perspective" => "Perspective",
    "grapsjs-stylemanager-properties-position" => "Position",
    "grapsjs-stylemanager-properties-right" => "Right",
    "grapsjs-stylemanager-properties-text-align" => "Text Alignment",
    "grapsjs-stylemanager-properties-text-shadow" => "Text Shadow",
    "grapsjs-stylemanager-properties-text-shadow-blur" => "Text Shadow Blur",
    "grapsjs-stylemanager-properties-text-shadow-color" => "Text Shadow Color",
    "grapsjs-stylemanager-properties-text-shadow-h" => "Text Shadow: Horizontal",
    "grapsjs-stylemanager-properties-text-shadow-v" => "Text Shadow: Vertical",
    "grapsjs-stylemanager-properties-top" => "Top",
    "grapsjs-stylemanager-properties-transform" => "Transform",
    "grapsjs-stylemanager-properties-transform-rotate-x" => "Transform Rotate X",
    "grapsjs-stylemanager-properties-transform-rotate-y" => "Transform Rotate Y",
    "grapsjs-stylemanager-properties-transform-rotate-z" => "Transform Rotate Z",
    "grapsjs-stylemanager-properties-transform-scale-x" => "Transform Scale X",
    "grapsjs-stylemanager-properties-transform-scale-y" => "Transform Scale Y",
    "grapsjs-stylemanager-properties-transform-scale-z" => "Transform Scale Z",
    "grapsjs-stylemanager-properties-transition" => "Transition",
    "grapsjs-stylemanager-properties-transition-duration" => "Transition Duration",
    "grapsjs-stylemanager-properties-transition-property" => "Transition Property",
    "grapsjs-stylemanager-properties-transition-timing-function" => "Transition Timing Function",
    "grapsjs-stylemanager-properties-width" => "Width",
    "grapsjs-stylemanager-sectors-decorations" => "Decorations",
    "grapsjs-stylemanager-sectors-dimension" => "Dimension",
    "grapsjs-stylemanager-sectors-extra" => "Extra",
    "grapsjs-stylemanager-sectors-flex" => "Flex",
    "grapsjs-stylemanager-sectors-general" => "General",
    "grapsjs-stylemanager-sectors-layout" => "Layout",
    "grapsjs-stylemanager-sectors-typography" => "Typography",
    "grapsjs-tipografia" => "Typography",
    "grapsjs-traitmanager-empty" => "Select an element to use the trait manager",
    "grapsjs-traitmanager-label" => "Component Settings",
    "grapsjs-traitmanager-traits-options-target-_blank" => "New window",
    "grapsjs-traitmanager-traits-options-target-false" => "This window",
    "grapsjs-undo" => "Undo",
    "grapsjs-width" => "Width",
];
function get_lang_string($item, $component) {
    global $langs;
    return $langs[$item];
}
?>

<script type="text/javascript">

    var editor = grapesjs.init({
        dragMode        : 'absolute',
        height          : '100%',
        container       : '#gjs',
        fromElement     : true,
        showOffsets     : true,
        storageManager  : false,
        assetManager    : {
            embedAsBase64 : true,
            assets        : [],
        },
        selectorManager : {componentFirst : true},
        styleManager    : {
            sectors : [
                {
                    name       : '<?php echo get_lang_string("grapsjs-general", "certificatebeautiful") ?>',
                    properties : [
                        'display',
                        {extend : 'position', type : 'select'},
                        'top',
                        'right',
                        'left',
                        'bottom',
                    ],
                },
                {
                    name       : '<?php echo get_lang_string("grapsjs-dimensions", "certificatebeautiful") ?>',
                    open       : false,
                    properties : [
                        'width',
                        'height',
                        'max-width',
                        'min-width',
                        'max-height',
                        'min-height',
                        'margin',
                        'padding'
                    ],
                },
                {
                    name       : '<?php echo get_lang_string("grapsjs-tipografia", "certificatebeautiful") ?>',
                    open       : false,
                    properties : [
                        {
                            property : 'font-family',
                            type     : 'select',
                            name     : 'Font',
                            options  : [
                                {id : "Arial", label : 'Arial', value : 'Arial, Helvetica, sans-serif'},
                                <?php echo $fontList['options'] ?>
                            ]
                        },
                        'font-size',
                        'font-weight',
                        'letter-spacing',
                        'color',
                        'line-height',
                        {
                            extend  : 'text-align',
                            options : [
                                {id : 'left', label : 'Esquerda', className : 'fa fa-align-left'},
                                {id : 'center', label : 'Centro', className : 'fa fa-align-center'},
                                {id : 'right', label : 'Direita', className : 'fa fa-align-right'},
                                {id : 'justify', label : 'Justificar', className : 'fa fa-align-justify'}
                            ],
                        },
                        {
                            property : 'text-decoration',
                            type     : 'radio',
                            default  : 'none',
                            options  : [
                                {id : 'none', label : 'Nenhum', className : 'fa fa-times'},
                                {id : 'underline', label : 'Sublinhado', className : 'fa fa-underline'},
                                {id : 'line-through', label : 'Riscado', className : 'fa fa-strikethrough'}
                            ],
                        },
                        {
                            property : 'text-transform',
                            type     : 'radio',
                            default  : 'none',
                            options  : [
                                {id : 'none', label : 'x'},
                                {id : 'capitalize', label : 'Tt'},
                                {id : 'lowercase', label : 'tt'},
                                {id : 'uppercase', label : 'TT'}
                            ]
                        }
                    ]
                },
                {
                    name       : '<?php echo get_lang_string("grapsjs-stylemanager-properties-background", "certificatebeautiful") ?>',
                    open       : false,
                    properties : [
                        'background',
                    ],
                },
                {
                    name       : '<?php echo get_lang_string("grapsjs-decoration", "certificatebeautiful") ?>',
                    open       : false,
                    properties : [
                        'opacity',
                        'border-radius',
                        'border',
                    ],
                }
            ],
        },
        plugins         : [
            'grapesjs-blocks-basic',
            'grapesjs-custom-code',
            'grapesjs-parser-postcss',
            'grapesjs-tui-image-editor',
            'grapesjs-style-bg',
            'grapesjs-preset-webpage',
            'grapesjs-blocks-table',
            'grapesjs-style-border'
        ],
        pluginsOpts     : {
            'grapesjs-blocks-basic'     : {
                flexGrid : false,
                blocks   : ['column1', 'text', 'link', 'image']
            },
            'grapesjs-tui-image-editor' : {
                script : [
                    './js/tui/tui-code-snippet.js',
                    './js/tui/tui-color-picker.js',
                    './js/tui/tui-image-editor.js'
                ],
                style  : [
                    './stylesheets/tui/tui-color-picker.css',
                    './stylesheets/tui/tui-image-editor.css',
                ],
            },
            'grapesjs-blocks-table'     : {
                'containerId' : '#gjs'
            },
            'grapesjs-preset-webpage'   : {
                modalImportTitle   : '<?php echo get_lang_string("grapsjs-edit_code", "certificatebeautiful") ?>',
                modalImportLabel   : '<div style="margin-bottom: 10px; font-size: 13px;"><?php echo get_lang_string("grapsjs-edit_code_paste_here_html", "certificatebeautiful") ?></div>',
                modalImportContent : function(editor) {
                    var html = editor.getHtml();
                    html = html.split(/<body.*?>/).join('');
                    html = html.split('</body>').join('');

                    var css = editor.getCss();
                    css = css.split(/\*.*?}/s).join('');
                    css = css.split(/body.*?}/s).join('');
                    css = css.split(/\[data-gjs-type="?wrapper"?]\s?>\s?#/).join('#');
                    css = css.split(/\[data-gjs-type="?wrapper"?]\s?>\s/).join('');

                    return `${html}\n<style>\n${css}</style>`;
                },
            },
        },
        i18n            : {
            locale         : 'en',
            detectLocale   : false,
            localeFallback : 'en',
            messages       : {
                en : {
                    assetManager    : {
                        addButton   : "<?php echo get_lang_string('grapsjs-assetmanager-addbutton', "certificatebeautiful") ?>",
                        modalTitle  : "<?php echo get_lang_string('grapsjs-assetmanager-modaltitle', "certificatebeautiful") ?>",
                        uploadTitle : "<?php echo get_lang_string('grapsjs-assetmanager-uploadtitle', "certificatebeautiful") ?>"
                    },
                    domComponents   : {
                        names : {
                            ""      : "<?php echo get_lang_string('grapsjs-domcomponents-names-', "certificatebeautiful") ?>",
                            wrapper : "<?php echo get_lang_string('grapsjs-domcomponents-names-wrapper', "certificatebeautiful") ?>",
                            text    : "<?php echo get_lang_string('grapsjs-domcomponents-names-text', "certificatebeautiful") ?>",
                            comment : "<?php echo get_lang_string('grapsjs-domcomponents-names-comment', "certificatebeautiful") ?>",
                            image   : "<?php echo get_lang_string('grapsjs-domcomponents-names-image', "certificatebeautiful") ?>",
                            video   : "<?php echo get_lang_string('grapsjs-domcomponents-names-video', "certificatebeautiful") ?>",
                            label   : "<?php echo get_lang_string('grapsjs-domcomponents-names-label', "certificatebeautiful") ?>",
                            link    : "<?php echo get_lang_string('grapsjs-domcomponents-names-link', "certificatebeautiful") ?>",
                            map     : "<?php echo get_lang_string('grapsjs-domcomponents-names-map', "certificatebeautiful") ?>",
                            tfoot   : "<?php echo get_lang_string('grapsjs-domcomponents-names-tfoot', "certificatebeautiful") ?>",
                            tbody   : "<?php echo get_lang_string('grapsjs-domcomponents-names-tbody', "certificatebeautiful") ?>",
                            thead   : "<?php echo get_lang_string('grapsjs-domcomponents-names-thead', "certificatebeautiful") ?>",
                            table   : "<?php echo get_lang_string('grapsjs-domcomponents-names-table', "certificatebeautiful") ?>",
                            row     : "<?php echo get_lang_string('grapsjs-domcomponents-names-row', "certificatebeautiful") ?>",
                            cell    : "<?php echo get_lang_string('grapsjs-domcomponents-names-cell', "certificatebeautiful") ?>",
                            section : "<?php echo get_lang_string('grapsjs-domcomponents-names-section', "certificatebeautiful") ?>",
                            body    : "<?php echo get_lang_string('grapsjs-domcomponents-names-wrapper', "certificatebeautiful") ?>"
                        }
                    },
                    deviceManager   : {
                        device  : "<?php echo get_lang_string('grapsjs-devicemanager-device', "certificatebeautiful") ?>",
                        devices : {
                            desktop         : "<?php echo get_lang_string('grapsjs-devicemanager-devices-desktop', "certificatebeautiful") ?>",
                            tablet          : "<?php echo get_lang_string('grapsjs-devicemanager-devices-tablet', "certificatebeautiful") ?>",
                            mobileLandscape : "<?php echo get_lang_string('grapsjs-devicemanager-devices-mobilelandscape', "certificatebeautiful") ?>",
                            mobilePortrait  : "<?php echo get_lang_string('grapsjs-devicemanager-devices-mobileportrait', "certificatebeautiful") ?>"
                        }
                    },
                    panels          : {
                        buttons : {
                            titles : {
                                preview           : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-preview', "certificatebeautiful") ?>",
                                fullscreen        : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-fullscreen', "certificatebeautiful") ?>",
                                "sw-visibility"   : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-sw-visibility', "certificatebeautiful") ?>",
                                "export-template" : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-export-template', "certificatebeautiful") ?>",
                                "open-sm"         : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-open-sm', "certificatebeautiful") ?>",
                                "open-tm"         : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-open-tm', "certificatebeautiful") ?>",
                                "open-layers"     : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-open-layers', "certificatebeautiful") ?>",
                                "open-blocks"     : "<?php echo get_lang_string('grapsjs-panels-buttons-titles-open-blocks', "certificatebeautiful") ?>"
                            }
                        }
                    },
                    selectorManager : {
                        label      : "<?php echo get_lang_string('grapsjs-selectormanager-label', "certificatebeautiful") ?>",
                        selected   : "<?php echo get_lang_string('grapsjs-selectormanager-selected', "certificatebeautiful") ?>",
                        emptyState : "<?php echo get_lang_string('grapsjs-selectormanager-emptystate', "certificatebeautiful") ?>",
                        states     : {
                            hover             : "<?php echo get_lang_string('grapsjs-selectormanager-states-hover', "certificatebeautiful") ?>",
                            active            : "<?php echo get_lang_string('grapsjs-selectormanager-states-active', "certificatebeautiful") ?>",
                            "nth-of-type(2n)" : "<?php echo get_lang_string('grapsjs-selectormanager-states-nth-of-type-2n', "certificatebeautiful") ?>"
                        }
                    },
                    styleManager    : {
                        empty      : "<?php echo get_lang_string('grapsjs-stylemanager-empty', "certificatebeautiful") ?>",
                        layer      : "<?php echo get_lang_string('grapsjs-stylemanager-layer', "certificatebeautiful") ?>",
                        fileButton : "<?php echo get_lang_string('grapsjs-stylemanager-filebutton', "certificatebeautiful") ?>",
                        sectors    : {
                            general     : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-general', "certificatebeautiful") ?>",
                            layout      : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-layout', "certificatebeautiful") ?>",
                            typography  : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-typography', "certificatebeautiful") ?>",
                            decorations : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-decorations', "certificatebeautiful") ?>",
                            extra       : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-extra', "certificatebeautiful") ?>",
                            flex        : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-flex', "certificatebeautiful") ?>",
                            dimension   : "<?php echo get_lang_string('grapsjs-stylemanager-sectors-dimension', "certificatebeautiful") ?>"
                        },
                        properties : {
                            float                        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-float', "certificatebeautiful") ?>",
                            display                      : "<?php echo get_lang_string('grapsjs-stylemanager-properties-display', "certificatebeautiful") ?>",
                            position                     : "<?php echo get_lang_string('grapsjs-stylemanager-properties-position', "certificatebeautiful") ?>",
                            top                          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-top', "certificatebeautiful") ?>",
                            right                        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-right', "certificatebeautiful") ?>",
                            left                         : "<?php echo get_lang_string('grapsjs-stylemanager-properties-left', "certificatebeautiful") ?>",
                            bottom                       : "<?php echo get_lang_string('grapsjs-stylemanager-properties-bottom', "certificatebeautiful") ?>",
                            width                        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-width', "certificatebeautiful") ?>",
                            height                       : "<?php echo get_lang_string('grapsjs-stylemanager-properties-height', "certificatebeautiful") ?>",
                            "max-width"                  : "<?php echo get_lang_string('grapsjs-stylemanager-properties-max-width', "certificatebeautiful") ?>",
                            "max-height"                 : "<?php echo get_lang_string('grapsjs-stylemanager-properties-max-height', "certificatebeautiful") ?>",
                            margin                       : "<?php echo get_lang_string('grapsjs-stylemanager-properties-margin', "certificatebeautiful") ?>",
                            "margin-top"                 : "<?php echo get_lang_string('grapsjs-stylemanager-properties-margin-top', "certificatebeautiful") ?>",
                            "margin-right"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-margin-right', "certificatebeautiful") ?>",
                            "margin-left"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-margin-left', "certificatebeautiful") ?>",
                            "margin-bottom"              : "<?php echo get_lang_string('grapsjs-stylemanager-properties-margin-bottom', "certificatebeautiful") ?>",
                            padding                      : "<?php echo get_lang_string('grapsjs-stylemanager-properties-padding', "certificatebeautiful") ?>",
                            "padding-top"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-padding-top', "certificatebeautiful") ?>",
                            "padding-left"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-padding-left', "certificatebeautiful") ?>",
                            "padding-right"              : "<?php echo get_lang_string('grapsjs-stylemanager-properties-padding-right', "certificatebeautiful") ?>",
                            "padding-bottom"             : "<?php echo get_lang_string('grapsjs-stylemanager-properties-padding-bottom', "certificatebeautiful") ?>",
                            "font-family"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-font-family', "certificatebeautiful") ?>",
                            "font-size"                  : "<?php echo get_lang_string('grapsjs-stylemanager-properties-font-size', "certificatebeautiful") ?>",
                            "font-weight"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-font-weight', "certificatebeautiful") ?>",
                            "letter-spacing"             : "<?php echo get_lang_string('grapsjs-stylemanager-properties-letter-spacing', "certificatebeautiful") ?>",
                            color                        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-color', "certificatebeautiful") ?>",
                            "line-height"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-line-height', "certificatebeautiful") ?>",
                            "text-align"                 : "<?php echo get_lang_string('grapsjs-stylemanager-properties-text-align', "certificatebeautiful") ?>",
                            "text-shadow"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-text-shadow', "certificatebeautiful") ?>",
                            "text-shadow-h"              : "<?php echo get_lang_string('grapsjs-stylemanager-properties-text-shadow-h', "certificatebeautiful") ?>",
                            "text-shadow-v"              : "<?php echo get_lang_string('grapsjs-stylemanager-properties-text-shadow-v', "certificatebeautiful") ?>",
                            "text-shadow-blur"           : "<?php echo get_lang_string('grapsjs-stylemanager-properties-text-shadow-blur', "certificatebeautiful") ?>",
                            "text-shadow-color"          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-text-shadow-color', "certificatebeautiful") ?>",
                            "border-top-left"            : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-top-left', "certificatebeautiful") ?>",
                            "border-top-right"           : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-top-right', "certificatebeautiful") ?>",
                            "border-bottom-left"         : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-bottom-left', "certificatebeautiful") ?>",
                            "border-bottom-right"        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-bottom-right', "certificatebeautiful") ?>",
                            "border-radius-top-left"     : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-radius-top-left', "certificatebeautiful") ?>",
                            "border-radius-top-right"    : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-radius-top-right', "certificatebeautiful") ?>",
                            "border-radius-bottom-left"  : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-radius-bottom-left', "certificatebeautiful") ?>",
                            "border-radius-bottom-right" : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-radius-bottom-right', "certificatebeautiful") ?>",
                            "border-radius"              : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-radius', "certificatebeautiful") ?>",
                            border                       : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border', "certificatebeautiful") ?>",
                            "border-width"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-width', "certificatebeautiful") ?>",
                            "border-style"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-style', "certificatebeautiful") ?>",
                            "border-color"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-border-color', "certificatebeautiful") ?>",
                            "box-shadow"                 : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow', "certificatebeautiful") ?>",
                            "box-shadow-h"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow-h', "certificatebeautiful") ?>",
                            "box-shadow-v"               : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow-v', "certificatebeautiful") ?>",
                            "box-shadow-blur"            : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow-blur', "certificatebeautiful") ?>",
                            "box-shadow-spread"          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow-spread', "certificatebeautiful") ?>",
                            "box-shadow-color"           : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow-color', "certificatebeautiful") ?>",
                            "box-shadow-type"            : "<?php echo get_lang_string('grapsjs-stylemanager-properties-box-shadow-type', "certificatebeautiful") ?>",
                            background                   : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background', "certificatebeautiful") ?>",
                            "background-color"           : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background-color', "certificatebeautiful") ?>",
                            "background-image"           : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background-image', "certificatebeautiful") ?>",
                            "background-repeat"          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background-repeat', "certificatebeautiful") ?>",
                            "background-position"        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background-position', "certificatebeautiful") ?>",
                            "background-attachment"      : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background-attachment', "certificatebeautiful") ?>",
                            "background-size"            : "<?php echo get_lang_string('grapsjs-stylemanager-properties-background-size', "certificatebeautiful") ?>",
                            transition                   : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transition', "certificatebeautiful") ?>",
                            "transition-property"        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transition-property', "certificatebeautiful") ?>",
                            "transition-duration"        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transition-duration', "certificatebeautiful") ?>",
                            "transition-timing-function" : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transition-timing-function', "certificatebeautiful") ?>",
                            perspective                  : "<?php echo get_lang_string('grapsjs-stylemanager-properties-perspective', "certificatebeautiful") ?>",
                            transform                    : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform', "certificatebeautiful") ?>",
                            "transform-rotate-x"         : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform-rotate-x', "certificatebeautiful") ?>",
                            "transform-rotate-y"         : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform-rotate-y', "certificatebeautiful") ?>",
                            "transform-rotate-z"         : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform-rotate-z', "certificatebeautiful") ?>",
                            "transform-scale-x"          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform-scale-x', "certificatebeautiful") ?>",
                            "transform-scale-y"          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform-scale-y', "certificatebeautiful") ?>",
                            "transform-scale-z"          : "<?php echo get_lang_string('grapsjs-stylemanager-properties-transform-scale-z', "certificatebeautiful") ?>",
                            "flex-direction"             : "<?php echo get_lang_string('grapsjs-stylemanager-properties-flex-direction', "certificatebeautiful") ?>",
                            "flex-wrap"                  : "<?php echo get_lang_string('grapsjs-stylemanager-properties-flex-wrap', "certificatebeautiful") ?>",
                            "justify-content"            : "<?php echo get_lang_string('grapsjs-stylemanager-properties-justify-content', "certificatebeautiful") ?>",
                            "align-items"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-align-items', "certificatebeautiful") ?>",
                            "align-content"              : "<?php echo get_lang_string('grapsjs-stylemanager-properties-align-content', "certificatebeautiful") ?>",
                            order                        : "<?php echo get_lang_string('grapsjs-stylemanager-properties-order', "certificatebeautiful") ?>",
                            "flex-basis"                 : "<?php echo get_lang_string('grapsjs-stylemanager-properties-flex-basis', "certificatebeautiful") ?>",
                            "flex-grow"                  : "<?php echo get_lang_string('grapsjs-stylemanager-properties-flex-grow', "certificatebeautiful") ?>",
                            "flex-shrink"                : "<?php echo get_lang_string('grapsjs-stylemanager-properties-flex-shrink', "certificatebeautiful") ?>",
                            "align-self"                 : "<?php echo get_lang_string('grapsjs-stylemanager-properties-align-self', "certificatebeautiful") ?>"
                        }
                    },
                    traitManager    : {
                        empty  : "<?php echo get_lang_string('grapsjs-traitmanager-empty', "certificatebeautiful") ?>",
                        label  : "<?php echo get_lang_string('grapsjs-traitmanager-label', "certificatebeautiful") ?>",
                        traits : {
                            options : {
                                target : {
                                    false  : "<?php echo get_lang_string('grapsjs-traitmanager-traits-options-target-false', "certificatebeautiful") ?>",
                                    _blank : "<?php echo get_lang_string('grapsjs-traitmanager-traits-options-target-_blank', "certificatebeautiful") ?>"
                                }
                            }
                        }
                    }
                }
            }
        }
    });

    editor.getConfig().showDevices = 0;
    editor.Panels.addPanel({id : "devices-c"}).get("buttons").add([
        {
            id        : "block-save",
            className : "btn-salvar padding-0",
            label     : `<form id="form-save" method="post" target="_top" style="display:none;"
                               action="<?php echo $CFG->wwwroot ?>/mod/certificatebeautiful/manage-model-editpage.php?id=<?php echo $id ?>&page=<?php echo $page ?>">
                             <input type="hidden" name="sesskey" value="<?php echo sesskey() ?>">
                             <input type="hidden" name="htmldata" id="form-htmldata">
                             <input type="hidden" name="cssdata" id="form-cssdata">
                             <button type="submit" class="btn-salvar gjs-pn-btn gjs-pn-active gjs-four-color">
                                 <i class='fa fa-save'></i>&nbsp;
                                 <?php echo get_lang_string('grapsjs-certificate_page_save', "certificatebeautiful") ?>
                            </button>
                         </form>
                         <form id="form-testpdf" method="post" target="testpdf" style="display:none;"
                               action="test-pdf.php?id=<?php echo $id ?>">
                             <input type="hidden" name="sesskey" value="<?php echo sesskey() ?>">
                             <input type="hidden" name="htmldata" id="testpdf-htmldata">
                             <input type="hidden" name="cssdata" id="testpdf-cssdata">
                             <button type="submit" class="btn-salvar gjs-pn-btn gjs-pn-active gjs-four-color">
                                 <i class='fa fa-file-pdf-o'></i>&nbsp;
                                 <?php echo get_lang_string('grapsjs-certificate_page_test', "certificatebeautiful") ?>
                            </button>
                         </form>`,
        }
    ]);

    function updateForm() {
        var html = editor.getHtml();
        html = html.split(/<body.*?>/).join('');
        html = html.split('</body>').join('');

        var css = editor.getCss();
        css = css.split(/\*.*?}/s).join('');
        css = css.split(/body.*?}/s).join('');
        css = css.split(/\[data-gjs-type="?wrapper"?]\s?>\s?#/).join('#');
        css = css.split(/\[data-gjs-type="?wrapper"?]\s?>\s/).join('');

        $("#form-htmldata").val(html);
        $("#form-cssdata").val(css);
        $("#form-save").show(300);

        $("#testpdf-htmldata").val(html);
        $("#testpdf-cssdata").val(css);
        $("#form-testpdf").show(300);
    };
    editor.on('update', updateForm);

    // A block for the custom component
    editor.BlockManager.add('qr-code', {
        // https://grapesjs.com/docs/api/components.html#iscomponent
        label    : 'QR Code',
        content  : `
              <div class="qr-code-block"
                   data-gjs-type="text"
                   draggable="false"
                   data-gjs-copyable="false"
                   style="position:absolute;top:0;left:0;width:100px;">
                  <img src="<?php echo $CFG->wwwroot ?>/mod/certificatebeautiful/_editor/img/qr-code.svg" width="100%"
                       data-gjs-selectable="false"
                       data-gjs-highlightable="false"
                       data-gjs-hoverable="false"
                       data-gjs-editable="false"/>
                  <div data-gjs-selectable="false"
                       data-gjs-highlightable="false"
                       data-gjs-hoverable="false"
                       data-gjs-editable="false"
                       style="font-size:12px;text-align:center">{$CERTIFICATE->code}</div>
              </div>`,
        media    : `<svg class="svg-item-replace" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="m0 8h8v-8h-8zm1.334-6.667h5.332v5.333h-5.332zm1.332 1.334h2.668v2.667h-2.668zm13.334 5.333h8v-8h-8zm1.332-6.667h5.334v5.333h-5.334zm1.334 1.334h2.666v2.667h-2.666zm-18.666 21.333h8v-8h-8zm1.334-6.667h5.332v5.334h-5.332zm1.332 1.334h2.668v2.666h-2.668zm20 2.666h1.334v2.667h-2.668v-4h1.334zm0-4h1.334v1.334h-1.334zm0-1.333v1.333h-1.334v-1.333zm-13.332 2.667h1.332v5.333h-1.332zm-5.334-9.334v2.667h-2.668v-1.333h-1.332v-1.333zm5.334-4h1.332v1.333h-1.332zm3.998-4v2.667h-1.332v-4h2.666v1.333zm-3.998 0h1.332v1.333h-1.332zm13.332 10.667h1.334v2.667h-2.668v-1.334h1.334zm-1.334-2.667v1.333h-2.666v2.667h-2.666v-1.333h1.332v-2.667zm-9.332 5.334h-1.334v-1.334h-1.332v-1.333h2.666zm8 2.666h1.332v1.334h-1.332zm2.666-6.666v1.333h-1.334v-1.333zm-12 4v1.333h-1.332v-1.333zm8 6.666h1.334v2.667h-2.668v-2.667zm-4 0h1.334v1.334h-1.334v1.333h-2.666v-1.333h1.332v-1.334zm0-1.333v-1.333h2.666v1.333zm0-6.667h1.334v4h-1.334v1.334h-1.334v1.333h-1.332v-2.667h-1.334v-1.333h4v-1.333h-1.334v-1.334zm-12 0v1.334h-1.332v-1.334zm16 5.334h-1.334v-1.334h1.334zm1.334-2.667h-2.668v-1.333h2.668zm-13.334-6.667h1.334v1.333h-1.334v1.334h1.334v2.667h-1.334v-1.334h-1.332v1.334h-1.334v-2.667h1.332v-2.667zm4 0v-2.667h4v4h-2.666v-1.333h1.332v-1.333h-1.332v1.333zm0-5.333h1.334v1.333h-1.334zm-1.332 5.333h1.332v1.333h-1.332zm3.998-4v-1.333h1.334v1.333z"/>
                    </svg>`,
        category : "Basic",
    });

    editor.on("component:selected", function(component) {
        component.set("resizable", true);
    });

    <?php echo \mod_certificatebeautiful\local\help\help_base::get_editor_components(); ?>

    var pn = editor.Panels;

    // Update canvas-clear command
    editor.Commands.add('canvas-clear', function() {
        if (confirm("<?php echo get_lang_string('grapsjs-certificate_confirm_clear', "certificatebeautiful") ?>")) {
            editor.runCommand('core:canvas-clear');
            setTimeout(function() {
                localStorage.clear()
            }, 0)
        }
    });

    // Simple warn notifier
    var origWarn = console.warn;
    toastr.options = {
        closeButton       : true,
        preventDuplicates : true,
        showDuration      : 250,
        hideDuration      : 150
    };
    console.warn = function(msg) {
        if (msg.indexOf('[undefined]') == -1) {
            toastr.warning(msg);
        }
        origWarn(msg);
    };

    // Add and beautify tooltips
    [
        ['sw-visibility', '<?php echo get_lang_string('grapsjs-show_border', "certificatebeautiful") ?>'],
        ['preview', '<?php echo get_lang_string('grapsjs-preview', "certificatebeautiful") ?>'],
        ['fullscreen', '<?php echo get_lang_string('grapsjs-fullscreen', "certificatebeautiful") ?>'],
        ['undo', '<?php echo get_lang_string('grapsjs-undo', "certificatebeautiful") ?>'],
        ['redo', '<?php echo get_lang_string('grapsjs-redo', "certificatebeautiful") ?>'],
        ['canvas-clear', '<?php echo get_lang_string('grapsjs-clear', "certificatebeautiful") ?>']
    ].forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title : item[1], 'data-tooltip-pos' : 'bottom'});
    });
    [
        ['open-sm', '<?php echo get_lang_string('grapsjs-open_sm', "certificatebeautiful") ?>'],
        ['open-layers', '<?php echo get_lang_string('grapsjs-open_layers', "certificatebeautiful") ?>'],
        ['open-blocks', '<?php echo get_lang_string('grapsjs-open_block', "certificatebeautiful") ?>']
    ].forEach(function(item) {
        pn.getButton('views', item[0]).set('attributes', {title : item[1], 'data-tooltip-pos' : 'bottom'});
    });
    var titles = document.querySelectorAll('*[title]');

    for (var i = 0; i < titles.length; i++) {
        var el = titles[i];
        var title = el.getAttribute('title');
        title = title ? title.trim() : '';
        if (!title)
            break;
        el.setAttribute('data-tooltip', title);
        el.setAttribute('title', '');
    }

    editor.on('load', function() {
        var $ = grapesjs.$;

        // Show borders by default
        pn.getButton('options', 'sw-visibility').set('active', 1);

        // Load and show settings and style manager
        var openTmBtn = pn.getButton('views', 'open-tm');
        openTmBtn && openTmBtn.set('active', 1);
        var openSm = pn.getButton('views', 'open-sm');
        openSm && openSm.set('active', 1);

        // Remove trait view
        pn.removeButton('views', 'open-tm');

        // Add Settings Sector
        var traitsSector = $('<div class="gjs-sm-sector no-select">' +
            '<div class="gjs-sm-sector-title"><span class="icon-settings fa fa-cog"></span> <span class="gjs-sm-sector-label"><?php echo get_lang_string('grapsjs-settings', "certificatebeautiful") ?></span></div>' +
            '<div class="gjs-sm-properties" style="display: none;"></div></div>');
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        // traitsProps.append($('.gjs-trt-traits'));
        $('.gjs-sm-sectors').before(traitsSector);
        traitsSector.find('.gjs-sm-sector-title').on('click', function() {
            var traitStyle = traitsProps.get(0).style;
            var hidden = traitStyle.display == 'none';
            if (hidden) {
                traitStyle.display = 'block';
            } else {
                traitStyle.display = 'none';
            }
        });

        // Open block manager
        var openBlocksBtn = editor.Panels.getButton('views', 'open-blocks');
        openBlocksBtn && openBlocksBtn.set('active', 1);

        updateForm();
    });

</script>
