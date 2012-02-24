<?php
if (!isset($ini))
{
    require_once'../Ini.php';
    $ini = new Ini();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="author" content="Przemyslaw Lis" />
        <title>Concerto Platform</title>
        <link rel="stylesheet" href="css/styles.css" />

        <script type="text/javascript" src="js/lib/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="js/lib/jquery-ui/ui/minified/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/lib/selectmenu/jquery.ui.selectmenu.js"></script>
        <script type="text/javascript" src="js/lib/jquery.json-2.3.min.js"></script>
        <script type="text/javascript" src="js/lib/loadmask/jquery.loadmask.min.js"></script>
        
        <link rel="stylesheet" href="js/lib/loadmask/jquery.loadmask.css" />
        <link rel="stylesheet" href="lib/CodeMirror/lib/codemirror.css" />
        <link rel="stylesheet" href="lib/CodeMirror/theme/night.css" />
        <link rel="stylesheet" href="js/lib/jquery-ui/themes/base/jquery.ui.tooltip.css" />
        <link rel="stylesheet" href="js/lib/selectmenu/jquery.ui.selectmenu.css" />
        
        <script src="../js/ConcertoMethods.js"></script>
        <script src="../js/Concerto.js"></script>

        <script src="js/OModule.js"></script>
        <script src="js/Methods.js"></script>
        <script src="js/User.js"></script>
        <script src="js/UserGroup.js"></script>
        <script src="js/UserType.js"></script>
        <script src="js/Template.js"></script>
        <script src="js/Table.js"></script>
        <script src="js/Test.js"></script>
        <script src="js/CustomSection.js"></script>
        <script src="lib/ckeditor/ckeditor.js"></script>
        <script src="lib/ckeditor/adapters/jquery.js"></script>
        <script src="js/lib/jquery.metadata.js"></script>
        <script src="js/lib/jquery-tablesorter.min.js"></script>
        <script src="js/lib/jquery-tablesorter-pager.js"></script>
        <script src="js/lib/jquery.tablesorter.filter.js"></script>
        <script src="lib/CodeMirror/lib/codemirror.js"></script>
        <script src="lib/CodeMirror/mode/htmlmixed/htmlmixed.js"></script>
        <script src="lib/CodeMirror/mode/r/r.js"></script>
        <script src="js/lib/jquery-ui-dialog-ckeditor-patch.js"></script>
        <script src="js/lib/fileupload/jquery.iframe-transport.js"></script>
        <script src="js/lib/fileupload/jquery.fileupload.js"></script>
        <script src="js/lib/themeswitcher/jquery.themeswitcher.min.js"></script>
        <script src="lib/jfeed/build/dist/jquery.jfeed.js"></script>

        <script>User.sessionID='<?= session_id(); ?>';</script>
        <script>
            
            $(function(){
                $('#switcher').themeswitcher({
                    loadTheme:"Cupertino",
                    imgpath: "js/lib/themeswitcher/images/",
                    onSelect:function(){
                    }
                });
            })
        </script>
        <?=  Language::load_js_dictionary()?>
    </head>
    <body>
        <div id="switcher"></div>
        <div id="content">
            <?php
            if (user::get_logged_user() == null)
            {
                include 'view/log_in.php';
            }
            else
            {
                include 'view/layout.php';
            }
            ?>
        </div>

        <div id="divLoadingDialog" class="notVisible"></div>
        <div id="divGeneralDialog" class="notVisible"></div>
        <div id="divAddFormDialog" class="notVisible"></div>
    </body>
</html>