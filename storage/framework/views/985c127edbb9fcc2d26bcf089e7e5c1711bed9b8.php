<?php if(empty($src)): ?>
    <?php $src = $no_image; ?>
<?php endif; ?>

<?php if(empty($attributes['width'])): ?>
    <?php $attributes['width'] = 100; ?>
<?php endif; ?>

<?php if(empty($attributes['height'])): ?>
    <?php $attributes['height'] = 100; ?>
<?php endif; ?>

<img src="<?php echo thumb($src, $attributes['width'], $attributes['height']); ?>"
    <?php if(!empty($attributes) && count('attributes')): ?>
        <?php foreach($attributes as $key => $value): ?>
            <?php echo $key; ?>="<?php echo $value; ?>"
        <?php endforeach; ?>
    <?php endif; ?>
/>