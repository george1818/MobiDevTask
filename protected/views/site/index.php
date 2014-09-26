<?php
/* @var $this SiteController */
?>
<div id="out"><?=$out;?></div>
<div id="contentLeft">
    <div class="contentIndex">
        <div class="titleIndex"><?=$response->full_name;?></div>
        <div class="infoIndex">Description: <?=$response->description;?></div>
        <div class="infoIndex">wachers : <?=$response->watchers;?></div>
        <div class="infoIndex">forks : <?=$response->forks;?></div>
        <div class="infoIndex">open issues : <?=$response->open_issues;?></div>
        <div class="infoIndex">homepage : <?=$response->homepage;?></div>
        <div class="infoIndex">GitHub repo : <?=$response->url;?></div>
        <div class="infoIndex">Created at : <?=$response->created_at;?></div>
    </div>
</div>
<div id="contentRight">
    <div class="contentIndex">
        <div class="titleIndex">Contributors:</div>
        <div id="contribInfo">
            <?php
            $i=0;
            foreach($contributors as $contributor) {
                if(++$i > 8) {
                    break;
                }
                ?>
                <div class="contributor">
                    <?php echo CHtml::form();
                    echo CHtml::hiddenField('id', $contributor->id);
                    $label = $contributor->liked ? "UnLike" : "Like";
                    echo CHtml::ajaxSubmitButton($label, '', array(
                            'type' => 'post',
                            'replace' => '#contr' . $contributor->id,
                        ),
                        array(
                            'type' => 'submit', 'class' => 'contribLike', 'id' => 'contr' . $contributor->id
                        ));
                    echo CHtml::endForm();?>
                    <div class="contribUser"><?php echo CHtml::link($contributor->login,array('site/infoUser','name_user'=>$contributor->login));?></a></div>
                </div>
            <?php }?>
        </div>
    </div>
</div>