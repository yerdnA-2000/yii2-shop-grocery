<?php
/**
 * @var $category array
 */
?>
<li <?php
if (isset($category['children'])):
    echo 'class="dropdown"';
endif ?>>
    <a href="<?= \yii\helpers\Url::to(['category/show', 'id' => $category['id']]) ?>"
        <?php
        if (isset($category['children'])):
            echo 'class="dropdown-toggle" data-toggle="dropdown"';
        endif ?>>
        <?= $category['title'] ?>
    </a>
    <?php if (isset($category['children'])): ?>
        <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
            <div class="w3ls_vegetables">
                <ul>
                    <?= $this->getMenuHTML($category['children']) ?>
                </ul>
            </div>
        </div>
    <?php endif ?>
</li>
