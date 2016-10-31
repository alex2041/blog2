<div class="row" style="line-height: 45px">
    <div class="col-md-2 colN" style="padding-left: 0">
        <div id="icons">
            <a href="https://instagram.com/alexeyavdeev41" target="_blank"><img src="/img/site/icon/instagramBlack.png" width="40px" height="40px" alt="instagram"></a>
            <a href="https://github.com/alex2041/" target="_blank"><img src="/img/site/icon/githubBlack.png" width="40px" height="40px" alt="github"></a>
        </div>
    </div>
    <div class="col-md-3 colN text-center fHead"><?= $f_id ? $folders[$f_id]->name : 'All notes'; ?></div>
    <div class="col-md-7 colN" style="padding-right: 5px;">
        <span class="fHead" id="nName"><?= $models[$n_id]->name ?></span>
        <div id="icons2">
            <a href="/post"><img src="/img/site/icon/post.png" width="30px" height="30px" alt="notes"></a>
        </div>
    </div>
</div>
<div class="row rowM">
    <div class="col-md-2 colM p0">
        <div class="fHead<?= $f_id ? '' : ' selectNote'; ?>"><div class="ihf">All notes</div></div>
        <? foreach ($folders as $folder): ?>
            <div class="fHead<?= ($f_id == $folder->id) ? ' selectNote' : '' ?>" f_id="<?= $folder->id; ?>"><div class="ihf"><?= $folder->name; ?></div></div>
        <? endforeach; ?>
    </div>
    <div class="col-md-3 colM p0 pre-scrollable" id="notes">
        <? foreach ($models as $model): ?>
            <div class="noteP <?= ($n_id == $model->id) ? 'selectNote' : '' ?>" note_id="<?= $model->id; ?>">
                <div class="ihf">
                    <a class="anchor" id="<?= $model->id; ?>"></a>
                    <strong><?= $model->name; ?></strong>
                    <br>
                    <span style="float: left"><?= date('d.m.y', $model->create_time); ?></span>
                    <span class="text-muted nCont"><? $content = explode("\n", $model->content); echo $content[0]; ?></span>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <div class="col-md-7 colM pre-scrollable">
        <div id="nContent"><?= $models[$n_id]->content; ?></div>
    </div>
</div>
