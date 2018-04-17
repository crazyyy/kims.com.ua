<ol class="breadcrumb">
    <li class="first">
        <a href="<?php echo route('admin.home'); ?>"><i class="fa fa-home"></i> <?php echo app('translator')->get('labels.home'); ?></a>
    </li>
    <?php foreach($breadcrumbs as $i => $data): ?>

        <li <?php echo ($i == count($breadcrumbs)-1 ? 'class="active"':''); ?>>
            <?php if($data['url']): ?>
                <a href="<?php echo $data['url']; ?>"><?php echo $data['name']; ?></a>
            <?php else: ?>
                <?php echo $data['name']; ?>

            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ol>

