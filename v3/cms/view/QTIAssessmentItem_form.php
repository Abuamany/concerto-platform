<?php
/*
  Concerto Platform - Online Adaptive Testing Platform
  Copyright (C) 2011-2012, The Psychometrics Centre, Cambridge University

  This program is free software; you can redistribute it and/or
  modify it under the terms of the GNU General Public License
  as published by the Free Software Foundation; version 2
  of the License, and not any of the later versions.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if (!isset($ini)) {
    require_once'../../Ini.php';
    $ini = new Ini();
}
$logged_user = User::get_logged_user();
if ($logged_user == null) {
    echo "<script>location.reload();</script>";
    die(Language::string(278));
}

//////////
$class_name = "QTIAssessmentItem";
$edit_caption = Language::string(462);
$new_caption = Language::string(463);
//////////

if (!$logged_user->is_module_writeable($class_name))
    die(Language::string(81));

$oid = 0;
if (isset($_POST['oid']) && $_POST['oid'] != 0)
    $oid = $_POST['oid'];

$btn_cancel = "<button class='btnCancel' onclick='" . $class_name . ".uiEdit(0)'>" . Language::string(23) . "</button>";
$btn_delete = "<button class='btnDelete' onclick='" . $class_name . ".uiDelete($oid)'>" . Language::string(94) . "</button>";
$btn_save = "<button class='btnSave' onclick='" . $class_name . ".uiSave()'>" . Language::string(95) . "</button>";

$caption = "";
$buttons = "";
if ($oid > 0) {
    $oid = $_POST['oid'];
    $obj = $class_name::from_mysql_id($oid);

    if (!$logged_user->is_object_editable($obj))
        die(Language::string(81));

    $caption = $edit_caption . " #" . $oid;
    $buttons = $btn_cancel . $btn_save . $btn_delete;
}
else {
    $obj = new $class_name();
    $caption = $new_caption;
    $buttons = "";
}

if ($oid != 0) {
    ?>
    <script>
        $(function(){
            Methods.iniIconButton("#btnExpand<?= $class_name ?>Description","arrowthick-1-s");
            Methods.iniIconButton(".btnGoToTop","arrow-1-n");
            Methods.iniIconButton(".btnCancel", "cancel");
            Methods.iniIconButton(".btnSave", "disk");
            Methods.iniIconButton(".btnDelete", "trash");
    <?php
    if ($class_name::$exportable && $oid > 0) {
        ?>
                    Methods.iniIconButton(".btnExport", "arrowthickstop-1-n");
                    Methods.iniIconButton(".btnUpload", "gear");        
        <?php
    }
    ?>
            QTIAssessmentItem.formCodeMirror = Methods.iniCodeMirror("form<?= $class_name ?>TextareaXML", "xml", false,"845px");
    <?php if ($oid != -1) { ?>
                Methods.iniCKEditor("#form<?= $class_name ?>TextareaDescription");
    <?php } ?>
            Methods.iniTooltips();
        });
    </script>

    <div class="padding ui-widget-content ui-corner-all margin">
        <table>
            <caption class="ui-widget-header"><?= $caption ?></caption>
            <tr>
                <td class="noWrap horizontalPadding tdFormLabel">* <?= Language::string(70) ?>:</td>
                <td><span class="tooltip spanIcon ui-icon ui-icon-help" title="<?= Language::string(464) ?>"></span></td>
                <td class="fullWidth">
                    <div class="horizontalMargin">
                        <input type="text" id="form<?= $class_name ?>InputName" value="<?= $obj->name ?>" class="fullWidth ui-widget-content ui-corner-all" />
                    </div>
                </td>
            </tr>
            <tr>
                <td class="noWrap horizontalPadding tdFormLabel"><?= Language::string(97) ?>:</td>
                <td><span class="tooltip spanIcon ui-icon ui-icon-help" title="<?= Language::string(98) ?>"></span></td>
                <td>
                    <div class="horizontalMargin" align="center"><button id="btnExpand<?= $class_name ?>Description" class="btnExpand fullWidth" onclick="Methods.toggleExpand('#form<?= $class_name ?>DivDescription', this)"><?= Language::string(97) ?></button></div>
                    <div class="horizontalMargin" align="center" id="form<?= $class_name ?>DivDescription" style="display:none;">
                        <textarea id="form<?= $class_name ?>TextareaDescription" name="form<?= $class_name ?>TextareaDescription" class="fullWidth ui-widget-content ui-corner-all"><?= htmlspecialchars(stripslashes($obj->description)) ?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="noWrap horizontalPadding tdFormLabel"><?= Language::string(465) ?>:</td>
                <td><span class="tooltip spanIcon ui-icon ui-icon-help" title="<?= Language::string(466) ?>"></span></td>
                <td>
                    <div class="horizontalMargin">
                        <textarea id="form<?= $class_name ?>TextareaXML" name="form<?= $class_name ?>TextareaXML"><?= htmlspecialchars(stripslashes($obj->XML)) ?></textarea>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="noWrap horizontalPadding tdFormLabel"><?= Language::string(72) ?>:</td>
                <td><span class="tooltip spanIcon ui-icon ui-icon-help" title="<?= Language::string(467) ?>"></span></td>
                <td>
                    <div class="horizontalMargin">
                        <select id="form<?= $class_name ?>SelectSharing" class="fullWidth ui-widget-content ui-corner-all">
                            <?php foreach (DS_Sharing::get_all() as $share) {
                                ?>
                                <option value="<?= $share->id ?>" <?= ($share->id == $obj->Sharing_id ? "selected" : "") ?>><?= $share->get_name() ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </td>
            </tr>

            <?php if ($oid > 0 && $logged_user->is_ownerhsip_changeable($obj)) {
                ?>
                <tr>
                    <td class="noWrap horizontalPadding tdFormLabel"><?= Language::string(71) ?>:</td>
                    <td><span class="tooltip spanIcon ui-icon ui-icon-help" title="<?= Language::string(468) ?>"></span></td>
                    <td>
                        <div class="horizontalMargin">
                            <select id="form<?= $class_name ?>SelectOwner" class="fullWidth ui-widget-content ui-corner-all">
                                <option value="0" <?= (!$obj->has_Owner() ? "selected" : "") ?>>&lt;<?= Language::string(73) ?>&gt;</option>
                                <?php
                                $sql = $logged_user->mysql_list_rights_filter("User", "`User`.`lastname` ASC");
                                $z = mysql_query($sql);
                                while ($r = mysql_fetch_array($z)) {
                                    $owner = User::from_mysql_id($r[0]);
                                    ?>
                                    <option value="<?= $owner->id ?>" <?= ($obj->Owner_id == $owner->id ? "selected" : "") ?>><?= $owner->get_full_name() ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                </tr>
            <?php } ?>

            <tr>
                <td colspan="3" align="center">
                    <?= $buttons ?>
                </td>
            </tr>
        </table>
    </div>
    <?php
    if ($oid != -1) {
        ?>
        <div class="divFormFloatingBar" align="right">
            <div class="ui-widget-content ui-corner-tl table">
                <button class="btnGoToTop" onclick="location.href='#'"><?= Language::string(442) ?></button>
                <?= $btn_cancel ?>
                <?= $btn_delete ?>
                <?= $btn_save ?>
                <?php
                if ($class_name::$exportable && $oid > 0) {
                    ?>
                    <button class="btnExport" onclick="<?= $class_name ?>.uiExport(<?= $oid ?>)"><?= Language::string(443) ?></button>
                    <button class="btnUpload" onclick="<?= $class_name ?>.uiUpload(<?= $oid ?>)"><?= Language::string(383) ?></button>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="padding margin ui-state-error " align="center"><?= Language::string(123) ?></div>
    <?php
}
?>