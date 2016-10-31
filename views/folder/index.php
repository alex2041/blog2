<?

use app\models\Note;
use yii\helpers\Url;

?>

<?
$this->registerJs("

    $('.folder').click(function (e) {
    location.href = '" . Url::to(['note/index']) . "?id=' + $(this).closest('div').attr('folder_id');
    });

");
?>
<div class="note-index">
    <div class="noteHead">
        <span class="noteName">Folders</span>
    </div>
    <div class="folders">
    <? foreach($models as $folder): ?>
        <div class="folder" folder_id="<?= $folder->id ?>">
            <div class="nameFolder"><?= $folder->name ?></div>
            <div class="countNote">
                <?= Note::countNoteByFolderId($folder->id) ?>
                <img src="/img/site/icon/arrowGray.png" alt="arrow" style="height: 14px;">
            </div>
        </div>
    <? endforeach; ?>
    </div>
</div>
