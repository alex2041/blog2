<?
use yii\widgets\LinkPager;
?>

    <div class="post-index">
        <? foreach($models as $post): ?>
            <?= $this->render('_post', ['post' => $post]); ?>
        <? endforeach; ?>
    </div>

<div class="navigator">
    <?=LinkPager::widget([
        'pagination' => $pages,
        'firstPageLabel' => '<i class="glyphicon glyphicon-grain"></i>',
        'lastPageLabel'  => '<i class="glyphicon glyphicon-grain"></i>',
        'nextPageLabel'  => false,
        'prevPageLabel'  => false,
    ]);?>
</div>