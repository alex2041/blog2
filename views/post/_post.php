<div class="post">
    <div class="post_title"><a href="/post/view?id=<?= $post->id ?>"><?= $post->title; ?></a></div>
    <div class="post_data"><?= date('d M Y', $post->create_time); ?></div>
    <div class="clear"></div>
    <div class="post_content" style="color: <?= color() ?> "><div class="ps"><?= $post->scontent;?></div></div>
    <? if($post->fcontent): ?>
        <a href="/post/view?id=<?= $post->id ?>" class="gofull"></a>
    <? endif;?>
</div>