<?php

use CodeIgniter\Pager\PagerRenderer;

/*
 * @var PagerRenderer $pager
 */
$pager->setSurroundCount(2);
?>

<nav aria-label="<?php echo lang('Pager.pageNavigation'); ?>">
    <ul class="pagination mb-0">
        <?php if ($pager->hasPrevious()) { ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $pager->getFirst(); ?>"
                aria-label="<?php echo lang('Pager.first'); ?>">
                <span aria-hidden="true"><?php echo lang('Pager.first'); ?></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?php echo $pager->getPrevious(); ?>"
                aria-label="<?php echo lang('Pager.previous'); ?>">
                <span aria-hidden="true"><?php echo lang('Pager.previous'); ?></span>
            </a>
        </li>
        <?php } ?>

        <?php foreach ($pager->links() as $link) { ?>
        <li class="page-item <?php echo $link['active'] ? 'active' : ''; ?>">
            <a class="page-link" href="<?php echo $link['uri']; ?>">
                <?php echo $link['title']; ?>
            </a>
        </li>
        <?php } ?>

        <?php if ($pager->hasNext()) { ?>
        <li class="page-item">
            <a class="page-link" href="<?php echo $pager->getNext(); ?>" aria-label="<?php echo lang('Pager.next'); ?>">
                <span aria-hidden="true"><?php echo lang('Pager.next'); ?></span>
            </a>
        </li>
        <li class="page-item">
            <a class="page-link" href="<?php echo $pager->getLast(); ?>" aria-label="<?php echo lang('Pager.last'); ?>">
                <span aria-hidden="true"><?php echo lang('Pager.last'); ?></span>
            </a>
        </li>
        <?php } ?>
    </ul>
</nav>