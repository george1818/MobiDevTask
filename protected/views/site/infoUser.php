<div id="out"><?php echo $out;?></div>
<div class="contentInfo">
    <div id="avatarUser">
        <div id="infoUserLike">
            <?php echo CHtml::form();
            echo CHtml::hiddenField('id', $response->id);
            $label = $response->liked ? "UnLike" : "Like";
            echo CHtml::ajaxSubmitButton($label, '', array(
                    'type' => 'post',
                    'replace' => '#contr' . $response->id,
                ),
                array(
                    'type' => 'submit', 'class' => 'LikeUser', 'id' => 'contr' . $response->id
                ));
            echo CHtml::endForm();?>
        </div>
    </div>
    <div id="infoName"><? echo($response->name); ?></div>
    <div class="infoUser"><? echo($response->login); ?></div>
    <div class="infoUser">Company : <? echo($response->company); ?></div>
    <div class="infoUser">Blog : <a href="<?php echo($response->blog); ?>"><? echo($response->blog); ?></a></div>
    <div class="infoCount">Followers : <? echo($response->followers); ?></div>
</div>