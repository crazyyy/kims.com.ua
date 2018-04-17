<div class="message-container">
    <?php if($messages->has('error')): ?>
        <?php foreach($messages->get('error') as $message): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message; ?>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if($messages->has('warning')): ?>
        <?php foreach($messages->get('warning') as $message): ?>
            <div class="alert alert-dismissable alert-warning">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $message; ?>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if($messages->has('info')): ?>
		<?php foreach($messages->get('info') as $message): ?>
			<div class="alert alert-dismissable alert-info">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $message; ?>

			</div>
		<?php endforeach; ?>
	<?php endif; ?>

	<?php if($messages->has('success')): ?>
		<?php foreach($messages->get('success') as $message): ?>
			<div class="alert alert-dismissable alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?php echo $message; ?>

			</div>
		<?php endforeach; ?>
	<?php endif; ?>
</div>
