<?php
if (!isset($ini))
{
    require_once'../../Ini.php';
    $ini = new Ini();
}

$logged_user = User::get_logged_user();
if ($logged_user == null) die(Language::string(81));
?>

<script>
    $(function(){
        Methods.iniIconButton(".btnAdd", "plus");
    })
</script>

<div id="divUsersAccordion" class="margin">
    <h3><a href="#"><?= Language::string(89) ?></a></h3>
    <div>
        <table class="margin ui-widget-content ui-corner-all">
            <tr>
                <?php
                $class_name = "User";
                $class_label = Language::string(89);
                if ($logged_user->is_module_accesible($class_name))
                {
                    ?>
                    <td colspan="2">
                        <div class="fullWidth ui-widget-header" align="center" colspan="2">
                            <h3><?= $class_label ?></h3>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="padding" valign="top">
                        <div align="center" id="div<?= $class_name ?>List"><?php include Ini::$path_internal . 'cms/view/list.php'; ?></div>
                    </td>

                    <td class="padding" valign="top">
                        <?php
                        if ($logged_user->is_module_writeable($class_name))
                        {
                            ?>
                            <div align="center" id="div<?= $class_name ?>Form"><?php include Ini::$path_internal . 'cms/view/' . $class_name . '_form.php'; ?></div><br />
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
    <h3><a href="#"><?= Language::string(90) ?></a></h3>
    <div>
        <table class="margin ui-widget-content ui-corner-all">
            <tr>
                <?php
                $class_name = "UserType";
                $class_label = Language::string(90);
                if ($logged_user->is_module_accesible($class_name))
                {
                    ?>
                    <td colspan="2">
                        <div class="fullWidth ui-widget-header" align="center" colspan="2">
                            <h3><?= $class_label ?></h3>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="padding" valign="top">
                        <div align="center" id="div<?= $class_name ?>List"><?php include Ini::$path_internal . 'cms/view/list.php'; ?></div>
                    </td>

                    <td class="padding" valign="top">
                        <?php
                        if ($logged_user->is_module_writeable($class_name))
                        {
                            ?>
                            <div align="center" id="div<?= $class_name ?>Form"><?php include Ini::$path_internal . 'cms/view/' . $class_name . '_form.php'; ?></div><br />
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
    <h3><a href="#"><?= Language::string(91) ?></a></h3>
    <div>
        <table class="margin ui-widget-content ui-corner-all">
            <tr>
                <?php
                $class_name = "UserGroup";
                $class_label = Language::string(91);
                if ($logged_user->is_module_accesible($class_name))
                {
                    ?>
                    <td colspan="2">
                        <div class="fullWidth ui-widget-header" align="center" colspan="2">
                            <h3><?= $class_label ?></h3>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="padding" valign="top">
                        <div align="center" id="div<?= $class_name ?>List"><?php include Ini::$path_internal . 'cms/view/list.php'; ?></div>
                    </td>

                    <td class="padding" valign="top">
                        <?php
                        if ($logged_user->is_module_writeable($class_name))
                        {
                            ?>
                            <div align="center" id="div<?= $class_name ?>Form"><?php include Ini::$path_internal . 'cms/view/' . $class_name . '_form.php'; ?></div><br />
                        <?php } ?>
                    </td>
                <?php } ?>
            </tr>
        </table>
    </div>
</div>