<?php if ($pager->hasPrevious()) : ?>
    <a href="<?= $pager->getPrevious() ?>" class="btn btn-secondary">Previous</a>
<?php else : ?>
    <button class="btn btn-secondary" disabled>Previous</button>
<?php endif ?>

<?php if ($pager->hasNext()) : ?>
    <a href="<?= $pager->getNext() ?>" class="btn btn-secondary">Next</a>
<?php else : ?>
    <button class="btn btn-secondary" disabled>Next</button>
<?php endif ?>
