<?php //$parent = isset($category['childs']); ?>
<li>
    <a href="/category/<?=$category['alias'];?>"><?=$category['title'];?></a>
    <?php if(isset($category['childs'])): ?>
        <ul>
            <?= $this->getMenuHTML($category['childs']); ?>
        </ul>
    <?php endif; ?>
</li>