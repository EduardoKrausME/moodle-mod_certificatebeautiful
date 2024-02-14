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
    $context = context_system::instance();
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

$l = "8";
if ($id === false) {
    foreach (certificatebeautiful_list_all_models() as $key => $model) {
        echo "<p>{$model['key']} => ";
        echo "<a href='_model/{$model['key']}/index.html?l={$l}'        target='ver'>Ver HTML</a> - ";
        echo "<a href='?id={$key}&t={$model['key']}&l={$l}'             target='edi'>Editar</a> - ";
        echo "<a href='test-pdf.php?id={$key}&t={$model['key']}&l={$l}' target='pdf'>Ver o PDF</a>";
        echo "</p>";
    }

    echo "<p>sumary-secound-page => ";
    echo "<a href='_model/sumary-secound-page/index.html?l={$l}'    target='ver'>Ver HTML</a> - ";
    echo "<a href='?id=-1&t=sumary-secound-page&l={$l}'             target='edi'>Editar</a> - ";
    echo "<a href='test-pdf.php?id=-1&t=sumary-secound-page&l={$l}' target='pdf'>Ver o PDF</a>";
    echo "</p>";

    echo "<h4><a href='test-pdf.php?id=-2' target='ver'>Abrir todos os certificados</a></p>";

    die();
} else {
    if ($id == -1) {
        $content = file_get_contents("_model/sumary-secound-page/index.html");
        $html = str_replace("../../", "/mod/certificatebeautiful/_editor/", $content);
        $html = str_replace('<tbody', '<tbody data-gjs-selectable="false" data-gjs-highlightable="false" data-gjs-hoverable="false"', $html);
        $html = str_replace('<tr', '<tr data-gjs-selectable="false" data-gjs-highlightable="false" data-gjs-hoverable="false"', $html);

        echo '<div id="gjs" style="height:0; overflow:hidden" >';
        echo $html;
        echo '</div>';
    } else {
        $model = certificatebeautiful_list_all_models()[$id];
        $content = file_get_contents("_model/{$model['key']}/index.html");
        $html = str_replace("../../", "/mod/certificatebeautiful/_editor/", $content);
        $html = str_replace('<tbody', '<tbody data-gjs-selectable="false" data-gjs-highlightable="false" data-gjs-hoverable="false"', $html);
        $html = str_replace('<tr', '<tr data-gjs-selectable="false" data-gjs-highlightable="false" data-gjs-hoverable="false"', $html);
        $html = str_replace('<table', '<table draggable="false"', $html);

        echo '<div id="gjs" style="height:0; overflow:hidden" >';
        echo $html;
        echo '</div>';
    }
}

require_once("editor-grapesjs.script.php");
?>
</body>
</html>
