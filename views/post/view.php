<?
use yii\bootstrap\Modal;
use yii\helpers\Html;
?>

<?
$this->title = $post->title;
?>

<?
Modal::begin([
    'id' => 'gallery',
    'header' => '<span class="mh"></span>',
    'footer' => Html::button('<span class="glyphicon glyphicon-hand-left" aria-hidden="true"></span>PREV', ['class' => 'btn btn-info pull-left prev']).
        Html::button('NEXT<span class="glyphicon glyphicon-hand-right" aria-hidden="true"></span>', ['class' => 'btn btn-info next']),
    'size' => Modal::SIZE_LARGE,
    'options' => ['class' => 'text-center'],
    'clientOptions' => ['class' => 'gfhfghfghfg'],
]);

echo 11111;

Modal::end();
?>

<div class="post">
    <div class="post_title"><a href="/post/view?id=<?= $post->id ?>"><?= $post->title; ?></a></div>
    <div class="post_data"><?= date('d M Y', $post->create_time); ?></div>
    <div class="clear"></div>
    <div class="post_content" style="color: <?= color() ?> "><div class="ps psview"><?= $post->scontent.$post->fcontent;?></div></div>
</div>