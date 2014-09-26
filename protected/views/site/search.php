<div id="out"><?= $out; ?></div>
<div id="foundInfo">
    <div class="titleIndex">For search term "<?= $request; ?>" found : <?= $response->total_count; ?></div>
    <?php
    if ($response->items) {
    foreach ($response->items as $item) {
        ?>
        <div class="foundInfo">
            <div class="foundAlight">
                <div class="foundBottomTop">
                    <div class="foundName">
                        <?php echo CHtml::link($item->full_name, array('site/info', 'id_project' => $item->id)); ?>
                    </div>
                    <div class="foundLinkHome">
                        <a href='<?= $item->homepage; ?>'><?= $item->homepage; ?></a>
                    </div>
                    <div class="foundLink">
                        <?php echo CHtml::link($item->owner->login, array('site/infoUser', 'name_user' => $item->owner->login)); ?>
                    </div>
                </div>
                <div class="foundStatDescription"><?= $item->description; ?></div>
                <div class="foundBottomTop">
                    <div class="foundStat">watchers : <?= $item->watchers; ?></div>
                    <div class="foundStat">forks : <?= $item->forks; ?></div>
                </div>
                <div id="searchLike">
                    <?php echo CHtml::form();
                    echo CHtml::hiddenField('id', $item->id);
                    $label = $item->liked ? "UnLike" : "Like";
                    echo CHtml::ajaxSubmitButton($label, '', array(
                            'type' => 'post',
                            'replace' => '#contr' . $item->id,
                        ),
                        array(
                            'type' => 'submit', 'class' => 'contribLike', 'id' => 'contr' . $item->id
                        ));
                    echo CHtml::endForm();?>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php } ?>
</div>

