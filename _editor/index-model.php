<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Edit Page</title>
    <link rel="stylesheet" href="stylesheets/toastr.css">
    <link rel="stylesheet" href="stylesheets/grapes.css">
    <link rel="stylesheet" href="stylesheets/grapesjs-preset-webpage.css">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link href="stylesheets/grapick.css" rel="stylesheet">

    <script src="js/jquery.js"></script>
    <script src="js/toastr.js"></script>
    <script src="js/grapes.js"></script>
    <script src="js/plugins/grapesjs-preset-webpage.js"></script>
    <script src="js/plugins/grapesjs-blocks-basic.js"></script>
    <script src="js/plugins/grapesjs-custom-code.js"></script>
    <script src="js/plugins/grapesjs-parser-postcss.js"></script>
    <script src="js/plugins/grapesjs-tui-image-editor.js"></script>
    <script src="js/plugins/grapesjs-style-bg.js"></script>
    <script src="js/plugins/grapesjs-blocks-table.js"></script>
    <script src="js/plugins/grapesjs-style-border.js"></script>

    <?php

    require_once('../../../config.php');
    require_login();
    $context=context_system::instance();
    require_capability('mod/certificatebeautiful:addinstance', $context);

    require_once("{$CFG->dirroot}/mod/certificatebeautiful/classes/fonts/font_util.php");
    $fontList = \mod_certificatebeautiful\fonts\font_util::mpdf_list_fonts();

    echo "<style>{$fontList['css']}</style>"
    ?>
</head>
<body>

<?php
$id = optional_param('id', false, PARAM_INT);
$page = optional_param('page', 0, PARAM_INT);

require_once("{$CFG->dirroot}/mod/certificatebeautiful/lib.php");

$l = "3";
if ($id === false) {
    foreach (certificatebeautiful_list_all_models() as $key => $model) {
        echo "<p>{$model['key']} => ";
        echo "<a href='_model/{$model['key']}/index.html?l={$l}'            target='ver'>Ver HTML</a> - ";
        echo "<a href='?id={$key}&t={$model['key']}&l={$l}'                 target='edi'>Editar</a> - ";
        echo "<a href='test-pdf.php?id={$key}&t={$model['key']}&l={$l}'  target='pdf'>Ver o PDF</a>";
        echo "</p>";
    }

    echo "<p>sumary-secound-page => ";
    echo "<a href='_model/sumary-secound-page/index.html?l={$l}'            target='ver'>Ver HTML</a> - ";
    echo "<a href='?id=-1&t=sumary-secound-page&l={$l}'                 target='edi'>Editar</a> - ";
    echo "<a href='test-pdf.php?id=-1&t=sumary-secound-page&l={$l}'  target='pdf'>Ver o PDF</a>";
    echo "</p>";

    die();
} else {
    if ($id == -1) {
        $content = file_get_contents("_model/sumary-secound-page/index.html");
        $html = str_replace("../../", "/mod/certificatebeautiful/_editor/", $content);

        echo '<div id="gjs" style="height:0; overflow:hidden" >';
        echo $html;
        echo '</div>';
    } else {
        $model = certificatebeautiful_list_all_models()[$id];
        $content = file_get_contents("_model/{$model['key']}/index.html");
        $html = str_replace("../../", "/mod/certificatebeautiful/_editor/", $content);

        echo '<div id="gjs" style="height:0; overflow:hidden" >';
        echo $html;
        echo "<style>[data-gjs-type=wrapper] > * * {position: initial !important;}</style>";
        echo '</div>';
    }
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
            upload        : './upload.php',
            uploadName    : 'files',
        },
        selectorManager : {componentFirst : true},
        styleManager    : {
            sectors : [
                {
                    name       : '<?php echo get_string("grapsjs-general", 'certificatebeautiful') ?>',
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
                    name       : '<?php echo get_string("grapsjs-dimensions", 'certificatebeautiful') ?>',
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
                    name       : '<?php echo get_string("grapsjs-tipografia", 'certificatebeautiful') ?>',
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
                        }
                    ],
                },
                {
                    name       : '<?php echo get_string("grapsjs-stylemanager-properties-background", 'certificatebeautiful') ?>',
                    open       : false,
                    properties : [
                        'background',
                    ],
                },
                {
                    name       : '<?php echo get_string("grapsjs-decoration", 'certificatebeautiful') ?>',
                    open       : false,
                    properties : [
                        'opacity',
                        'border-radius',
                        'border',
                    ],
                },
                {
                    name       : 'Extra',
                    open       : false,
                    buildProps : [
                        'transition',
                        'perspective',
                        'transform'
                    ],
                },
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
                modalImportTitle   : '<?php echo get_string("grapsjs-edit_code", 'certificatebeautiful') ?>',
                modalImportLabel   : '<div style="margin-bottom: 10px; font-size: 13px;"><?php echo get_string("grapsjs-edit_code_paste_here_html", 'certificatebeautiful') ?></div>',
                modalImportContent : function(editor) {
                    var html = editor.getHtml();
                    html = html.split(/<body.*?>/).join('');
                    html = html.split('</body>').join('');

                    var css = editor.getCss();
                    css = css.split(/\*.*?}/s).join('');
                    css = css.split(/body.*?}/s).join('');
                    css = css.split(/\[data-gjs-type="?wrapper"?]\s?>\s?#/).join('#');

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
                        addButton   : "<?php echo get_string('grapsjs-assetmanager-addbutton', 'certificatebeautiful') ?>",
                        modalTitle  : "<?php echo get_string('grapsjs-assetmanager-modaltitle', 'certificatebeautiful') ?>",
                        uploadTitle : "<?php echo get_string('grapsjs-assetmanager-uploadtitle', 'certificatebeautiful') ?>"
                    },
                    domComponents   : {
                        names : {
                            ""      : "<?php echo get_string('grapsjs-domcomponents-names-', 'certificatebeautiful') ?>",
                            wrapper : "<?php echo get_string('grapsjs-domcomponents-names-wrapper', 'certificatebeautiful') ?>",
                            text    : "<?php echo get_string('grapsjs-domcomponents-names-text', 'certificatebeautiful') ?>",
                            comment : "<?php echo get_string('grapsjs-domcomponents-names-comment', 'certificatebeautiful') ?>",
                            image   : "<?php echo get_string('grapsjs-domcomponents-names-image', 'certificatebeautiful') ?>",
                            video   : "<?php echo get_string('grapsjs-domcomponents-names-video', 'certificatebeautiful') ?>",
                            label   : "<?php echo get_string('grapsjs-domcomponents-names-label', 'certificatebeautiful') ?>",
                            link    : "<?php echo get_string('grapsjs-domcomponents-names-link', 'certificatebeautiful') ?>",
                            map     : "<?php echo get_string('grapsjs-domcomponents-names-map', 'certificatebeautiful') ?>",
                            tfoot   : "<?php echo get_string('grapsjs-domcomponents-names-tfoot', 'certificatebeautiful') ?>",
                            tbody   : "<?php echo get_string('grapsjs-domcomponents-names-tbody', 'certificatebeautiful') ?>",
                            thead   : "<?php echo get_string('grapsjs-domcomponents-names-thead', 'certificatebeautiful') ?>",
                            table   : "<?php echo get_string('grapsjs-domcomponents-names-table', 'certificatebeautiful') ?>",
                            row     : "<?php echo get_string('grapsjs-domcomponents-names-row', 'certificatebeautiful') ?>",
                            cell    : "<?php echo get_string('grapsjs-domcomponents-names-cell', 'certificatebeautiful') ?>",
                            section : "<?php echo get_string('grapsjs-domcomponents-names-section', 'certificatebeautiful') ?>",
                            body    : "<?php echo get_string('grapsjs-domcomponents-names-wrapper', 'certificatebeautiful') ?>"
                        }
                    },
                    deviceManager   : {
                        device  : "<?php echo get_string('grapsjs-devicemanager-device', 'certificatebeautiful') ?>",
                        devices : {
                            desktop         : "<?php echo get_string('grapsjs-devicemanager-devices-desktop', 'certificatebeautiful') ?>",
                            tablet          : "<?php echo get_string('grapsjs-devicemanager-devices-tablet', 'certificatebeautiful') ?>",
                            mobileLandscape : "<?php echo get_string('grapsjs-devicemanager-devices-mobilelandscape', 'certificatebeautiful') ?>",
                            mobilePortrait  : "<?php echo get_string('grapsjs-devicemanager-devices-mobileportrait', 'certificatebeautiful') ?>"
                        }
                    },
                    panels          : {
                        buttons : {
                            titles : {
                                preview           : "<?php echo get_string('grapsjs-panels-buttons-titles-preview', 'certificatebeautiful') ?>",
                                fullscreen        : "<?php echo get_string('grapsjs-panels-buttons-titles-fullscreen', 'certificatebeautiful') ?>",
                                "sw-visibility"   : "<?php echo get_string('grapsjs-panels-buttons-titles-sw-visibility', 'certificatebeautiful') ?>",
                                "export-template" : "<?php echo get_string('grapsjs-panels-buttons-titles-export-template', 'certificatebeautiful') ?>",
                                "open-sm"         : "<?php echo get_string('grapsjs-panels-buttons-titles-open-sm', 'certificatebeautiful') ?>",
                                "open-tm"         : "<?php echo get_string('grapsjs-panels-buttons-titles-open-tm', 'certificatebeautiful') ?>",
                                "open-layers"     : "<?php echo get_string('grapsjs-panels-buttons-titles-open-layers', 'certificatebeautiful') ?>",
                                "open-blocks"     : "<?php echo get_string('grapsjs-panels-buttons-titles-open-blocks', 'certificatebeautiful') ?>"
                            }
                        }
                    },
                    selectorManager : {
                        label      : "<?php echo get_string('grapsjs-selectormanager-label', 'certificatebeautiful') ?>",
                        selected   : "<?php echo get_string('grapsjs-selectormanager-selected', 'certificatebeautiful') ?>",
                        emptyState : "<?php echo get_string('grapsjs-selectormanager-emptystate', 'certificatebeautiful') ?>",
                        states     : {
                            hover             : "<?php echo get_string('grapsjs-selectormanager-states-hover', 'certificatebeautiful') ?>",
                            active            : "<?php echo get_string('grapsjs-selectormanager-states-active', 'certificatebeautiful') ?>",
                            "nth-of-type(2n)" : "<?php echo get_string('grapsjs-selectormanager-states-nth-of-type-2n', 'certificatebeautiful') ?>"
                        }
                    },
                    styleManager    : {
                        empty      : "<?php echo get_string('grapsjs-stylemanager-empty', 'certificatebeautiful') ?>",
                        layer      : "<?php echo get_string('grapsjs-stylemanager-layer', 'certificatebeautiful') ?>",
                        fileButton : "<?php echo get_string('grapsjs-stylemanager-filebutton', 'certificatebeautiful') ?>",
                        sectors    : {
                            general     : "<?php echo get_string('grapsjs-stylemanager-sectors-general', 'certificatebeautiful') ?>",
                            layout      : "<?php echo get_string('grapsjs-stylemanager-sectors-layout', 'certificatebeautiful') ?>",
                            typography  : "<?php echo get_string('grapsjs-stylemanager-sectors-typography', 'certificatebeautiful') ?>",
                            decorations : "<?php echo get_string('grapsjs-stylemanager-sectors-decorations', 'certificatebeautiful') ?>",
                            extra       : "<?php echo get_string('grapsjs-stylemanager-sectors-extra', 'certificatebeautiful') ?>",
                            flex        : "<?php echo get_string('grapsjs-stylemanager-sectors-flex', 'certificatebeautiful') ?>",
                            dimension   : "<?php echo get_string('grapsjs-stylemanager-sectors-dimension', 'certificatebeautiful') ?>"
                        },
                        properties : {
                            float                        : "<?php echo get_string('grapsjs-stylemanager-properties-float', 'certificatebeautiful') ?>",
                            display                      : "<?php echo get_string('grapsjs-stylemanager-properties-display', 'certificatebeautiful') ?>",
                            position                     : "<?php echo get_string('grapsjs-stylemanager-properties-position', 'certificatebeautiful') ?>",
                            top                          : "<?php echo get_string('grapsjs-stylemanager-properties-top', 'certificatebeautiful') ?>",
                            right                        : "<?php echo get_string('grapsjs-stylemanager-properties-right', 'certificatebeautiful') ?>",
                            left                         : "<?php echo get_string('grapsjs-stylemanager-properties-left', 'certificatebeautiful') ?>",
                            bottom                       : "<?php echo get_string('grapsjs-stylemanager-properties-bottom', 'certificatebeautiful') ?>",
                            width                        : "<?php echo get_string('grapsjs-stylemanager-properties-width', 'certificatebeautiful') ?>",
                            height                       : "<?php echo get_string('grapsjs-stylemanager-properties-height', 'certificatebeautiful') ?>",
                            "max-width"                  : "<?php echo get_string('grapsjs-stylemanager-properties-max-width', 'certificatebeautiful') ?>",
                            "max-height"                 : "<?php echo get_string('grapsjs-stylemanager-properties-max-height', 'certificatebeautiful') ?>",
                            margin                       : "<?php echo get_string('grapsjs-stylemanager-properties-margin', 'certificatebeautiful') ?>",
                            "margin-top"                 : "<?php echo get_string('grapsjs-stylemanager-properties-margin-top', 'certificatebeautiful') ?>",
                            "margin-right"               : "<?php echo get_string('grapsjs-stylemanager-properties-margin-right', 'certificatebeautiful') ?>",
                            "margin-left"                : "<?php echo get_string('grapsjs-stylemanager-properties-margin-left', 'certificatebeautiful') ?>",
                            "margin-bottom"              : "<?php echo get_string('grapsjs-stylemanager-properties-margin-bottom', 'certificatebeautiful') ?>",
                            padding                      : "<?php echo get_string('grapsjs-stylemanager-properties-padding', 'certificatebeautiful') ?>",
                            "padding-top"                : "<?php echo get_string('grapsjs-stylemanager-properties-padding-top', 'certificatebeautiful') ?>",
                            "padding-left"               : "<?php echo get_string('grapsjs-stylemanager-properties-padding-left', 'certificatebeautiful') ?>",
                            "padding-right"              : "<?php echo get_string('grapsjs-stylemanager-properties-padding-right', 'certificatebeautiful') ?>",
                            "padding-bottom"             : "<?php echo get_string('grapsjs-stylemanager-properties-padding-bottom', 'certificatebeautiful') ?>",
                            "font-family"                : "<?php echo get_string('grapsjs-stylemanager-properties-font-family', 'certificatebeautiful') ?>",
                            "font-size"                  : "<?php echo get_string('grapsjs-stylemanager-properties-font-size', 'certificatebeautiful') ?>",
                            "font-weight"                : "<?php echo get_string('grapsjs-stylemanager-properties-font-weight', 'certificatebeautiful') ?>",
                            "letter-spacing"             : "<?php echo get_string('grapsjs-stylemanager-properties-letter-spacing', 'certificatebeautiful') ?>",
                            color                        : "<?php echo get_string('grapsjs-stylemanager-properties-color', 'certificatebeautiful') ?>",
                            "line-height"                : "<?php echo get_string('grapsjs-stylemanager-properties-line-height', 'certificatebeautiful') ?>",
                            "text-align"                 : "<?php echo get_string('grapsjs-stylemanager-properties-text-align', 'certificatebeautiful') ?>",
                            "text-shadow"                : "<?php echo get_string('grapsjs-stylemanager-properties-text-shadow', 'certificatebeautiful') ?>",
                            "text-shadow-h"              : "<?php echo get_string('grapsjs-stylemanager-properties-text-shadow-h', 'certificatebeautiful') ?>",
                            "text-shadow-v"              : "<?php echo get_string('grapsjs-stylemanager-properties-text-shadow-v', 'certificatebeautiful') ?>",
                            "text-shadow-blur"           : "<?php echo get_string('grapsjs-stylemanager-properties-text-shadow-blur', 'certificatebeautiful') ?>",
                            "text-shadow-color"          : "<?php echo get_string('grapsjs-stylemanager-properties-text-shadow-color', 'certificatebeautiful') ?>",
                            "border-top-left"            : "<?php echo get_string('grapsjs-stylemanager-properties-border-top-left', 'certificatebeautiful') ?>",
                            "border-top-right"           : "<?php echo get_string('grapsjs-stylemanager-properties-border-top-right', 'certificatebeautiful') ?>",
                            "border-bottom-left"         : "<?php echo get_string('grapsjs-stylemanager-properties-border-bottom-left', 'certificatebeautiful') ?>",
                            "border-bottom-right"        : "<?php echo get_string('grapsjs-stylemanager-properties-border-bottom-right', 'certificatebeautiful') ?>",
                            "border-radius-top-left"     : "<?php echo get_string('grapsjs-stylemanager-properties-border-radius-top-left', 'certificatebeautiful') ?>",
                            "border-radius-top-right"    : "<?php echo get_string('grapsjs-stylemanager-properties-border-radius-top-right', 'certificatebeautiful') ?>",
                            "border-radius-bottom-left"  : "<?php echo get_string('grapsjs-stylemanager-properties-border-radius-bottom-left', 'certificatebeautiful') ?>",
                            "border-radius-bottom-right" : "<?php echo get_string('grapsjs-stylemanager-properties-border-radius-bottom-right', 'certificatebeautiful') ?>",
                            "border-radius"              : "<?php echo get_string('grapsjs-stylemanager-properties-border-radius', 'certificatebeautiful') ?>",
                            border                       : "<?php echo get_string('grapsjs-stylemanager-properties-border', 'certificatebeautiful') ?>",
                            "border-width"               : "<?php echo get_string('grapsjs-stylemanager-properties-border-width', 'certificatebeautiful') ?>",
                            "border-style"               : "<?php echo get_string('grapsjs-stylemanager-properties-border-style', 'certificatebeautiful') ?>",
                            "border-color"               : "<?php echo get_string('grapsjs-stylemanager-properties-border-color', 'certificatebeautiful') ?>",
                            "box-shadow"                 : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow', 'certificatebeautiful') ?>",
                            "box-shadow-h"               : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow-h', 'certificatebeautiful') ?>",
                            "box-shadow-v"               : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow-v', 'certificatebeautiful') ?>",
                            "box-shadow-blur"            : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow-blur', 'certificatebeautiful') ?>",
                            "box-shadow-spread"          : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow-spread', 'certificatebeautiful') ?>",
                            "box-shadow-color"           : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow-color', 'certificatebeautiful') ?>",
                            "box-shadow-type"            : "<?php echo get_string('grapsjs-stylemanager-properties-box-shadow-type', 'certificatebeautiful') ?>",
                            background                   : "<?php echo get_string('grapsjs-stylemanager-properties-background', 'certificatebeautiful') ?>",
                            "background-color"           : "<?php echo get_string('grapsjs-stylemanager-properties-background-color', 'certificatebeautiful') ?>",
                            "background-image"           : "<?php echo get_string('grapsjs-stylemanager-properties-background-image', 'certificatebeautiful') ?>",
                            "background-repeat"          : "<?php echo get_string('grapsjs-stylemanager-properties-background-repeat', 'certificatebeautiful') ?>",
                            "background-position"        : "<?php echo get_string('grapsjs-stylemanager-properties-background-position', 'certificatebeautiful') ?>",
                            "background-attachment"      : "<?php echo get_string('grapsjs-stylemanager-properties-background-attachment', 'certificatebeautiful') ?>",
                            "background-size"            : "<?php echo get_string('grapsjs-stylemanager-properties-background-size', 'certificatebeautiful') ?>",
                            transition                   : "<?php echo get_string('grapsjs-stylemanager-properties-transition', 'certificatebeautiful') ?>",
                            "transition-property"        : "<?php echo get_string('grapsjs-stylemanager-properties-transition-property', 'certificatebeautiful') ?>",
                            "transition-duration"        : "<?php echo get_string('grapsjs-stylemanager-properties-transition-duration', 'certificatebeautiful') ?>",
                            "transition-timing-function" : "<?php echo get_string('grapsjs-stylemanager-properties-transition-timing-function', 'certificatebeautiful') ?>",
                            perspective                  : "<?php echo get_string('grapsjs-stylemanager-properties-perspective', 'certificatebeautiful') ?>",
                            transform                    : "<?php echo get_string('grapsjs-stylemanager-properties-transform', 'certificatebeautiful') ?>",
                            "transform-rotate-x"         : "<?php echo get_string('grapsjs-stylemanager-properties-transform-rotate-x', 'certificatebeautiful') ?>",
                            "transform-rotate-y"         : "<?php echo get_string('grapsjs-stylemanager-properties-transform-rotate-y', 'certificatebeautiful') ?>",
                            "transform-rotate-z"         : "<?php echo get_string('grapsjs-stylemanager-properties-transform-rotate-z', 'certificatebeautiful') ?>",
                            "transform-scale-x"          : "<?php echo get_string('grapsjs-stylemanager-properties-transform-scale-x', 'certificatebeautiful') ?>",
                            "transform-scale-y"          : "<?php echo get_string('grapsjs-stylemanager-properties-transform-scale-y', 'certificatebeautiful') ?>",
                            "transform-scale-z"          : "<?php echo get_string('grapsjs-stylemanager-properties-transform-scale-z', 'certificatebeautiful') ?>",
                            "flex-direction"             : "<?php echo get_string('grapsjs-stylemanager-properties-flex-direction', 'certificatebeautiful') ?>",
                            "flex-wrap"                  : "<?php echo get_string('grapsjs-stylemanager-properties-flex-wrap', 'certificatebeautiful') ?>",
                            "justify-content"            : "<?php echo get_string('grapsjs-stylemanager-properties-justify-content', 'certificatebeautiful') ?>",
                            "align-items"                : "<?php echo get_string('grapsjs-stylemanager-properties-align-items', 'certificatebeautiful') ?>",
                            "align-content"              : "<?php echo get_string('grapsjs-stylemanager-properties-align-content', 'certificatebeautiful') ?>",
                            order                        : "<?php echo get_string('grapsjs-stylemanager-properties-order', 'certificatebeautiful') ?>",
                            "flex-basis"                 : "<?php echo get_string('grapsjs-stylemanager-properties-flex-basis', 'certificatebeautiful') ?>",
                            "flex-grow"                  : "<?php echo get_string('grapsjs-stylemanager-properties-flex-grow', 'certificatebeautiful') ?>",
                            "flex-shrink"                : "<?php echo get_string('grapsjs-stylemanager-properties-flex-shrink', 'certificatebeautiful') ?>",
                            "align-self"                 : "<?php echo get_string('grapsjs-stylemanager-properties-align-self', 'certificatebeautiful') ?>"
                        }
                    },
                    traitManager    : {
                        empty  : "<?php echo get_string('grapsjs-traitmanager-empty', 'certificatebeautiful') ?>",
                        label  : "<?php echo get_string('grapsjs-traitmanager-label', 'certificatebeautiful') ?>",
                        traits : {
                            options : {
                                target : {
                                    false  : "<?php echo get_string('grapsjs-traitmanager-traits-options-target-false', 'certificatebeautiful') ?>",
                                    _blank : "<?php echo get_string('grapsjs-traitmanager-traits-options-target-_blank', 'certificatebeautiful') ?>"
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
                                 <?php echo get_string('grapsjs-certificate_page_save', 'certificatebeautiful') ?>
                            </button>
                         </form>
                         <form id="form-testpdf" method="post" target="testpdf" style="display:none;"
                               action="test-pdf.php?id=<?php echo $id ?>">
                             <input type="hidden" name="sesskey" value="<?php echo sesskey() ?>">
                             <input type="hidden" name="htmldata" id="testpdf-htmldata">
                             <input type="hidden" name="cssdata" id="testpdf-cssdata">
                             <button type="submit" class="btn-salvar gjs-pn-btn gjs-pn-active gjs-four-color">
                                 <i class='fa fa-file-pdf-o'></i>&nbsp;
                                 <?php echo get_string('grapsjs-certificate_page_test', 'certificatebeautiful') ?>
                            </button>
                         </form>`,
        }
    ]);
    editor.on('update', function() {
        var html = editor.getHtml();
        html = html.split(/<body.*?>/).join('');
        html = html.split('</body>').join('');

        var css = editor.getCss();
        css = css.split(/\*.*?}/s).join('');
        css = css.split(/body.*?}/s).join('');
        css = css.split(/\[data-gjs-type="?wrapper"?]\s?>\s?#/).join('#');

        $("#form-htmldata").val(html);
        $("#form-cssdata").val(css);
        $("#form-save").show(300);

        $("#testpdf-htmldata").val(html);
        $("#testpdf-cssdata").val(css);
        $("#form-testpdf").show(300);
    });

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
                  <img src="img/qr-code.svg" width="100%"
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

    <?php echo \mod_certificatebeautiful\help\help_base::get_editor_components(); ?>

    var pn = editor.Panels;

    // Update canvas-clear command
    editor.Commands.add('canvas-clear', function() {
        if (confirm("<?php echo get_string('grapsjs-certificate_confirm_clear', 'certificatebeautiful') ?>")) {
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
        ['sw-visibility', '<?php echo get_string('grapsjs-show_border', 'certificatebeautiful') ?>'],
        ['preview', '<?php echo get_string('grapsjs-preview', 'certificatebeautiful') ?>'],
        ['fullscreen', '<?php echo get_string('grapsjs-fullscreen', 'certificatebeautiful') ?>'],
        ['undo', '<?php echo get_string('grapsjs-undo', 'certificatebeautiful') ?>'],
        ['redo', '<?php echo get_string('grapsjs-redo', 'certificatebeautiful') ?>'],
        ['canvas-clear', '<?php echo get_string('grapsjs-clear', 'certificatebeautiful') ?>']
    ].forEach(function(item) {
        pn.getButton('options', item[0]).set('attributes', {title : item[1], 'data-tooltip-pos' : 'bottom'});
    });
    [
        ['open-sm', '<?php echo get_string('grapsjs-open_sm', 'certificatebeautiful') ?>'],
        ['open-layers', '<?php echo get_string('grapsjs-open_layers', 'certificatebeautiful') ?>'],
        ['open-blocks', '<?php echo get_string('grapsjs-open_block', 'certificatebeautiful') ?>']
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
            '<div class="gjs-sm-sector-title"><span class="icon-settings fa fa-cog"></span> <span class="gjs-sm-sector-label"><?php echo get_string('grapsjs-settings', 'certificatebeautiful') ?></span></div>' +
            '<div class="gjs-sm-properties" style="display: none;"></div></div>');
        var traitsProps = traitsSector.find('.gjs-sm-properties');
        traitsProps.append($('.gjs-trt-traits'));
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
    });

</script>
</body>
</html>
