<div class="col-xs-2 col-xs-offset-5">
    <?php if($model->{$field} == true): ?>
        <i class="glyphicon glyphicon-ok green"></i>
    <?php else: ?>
        <?php if(empty($only_true)): ?>
            <i class="glyphicon glyphicon-remove red"></i>
        <?php endif; ?>
    <?php endif; ?>
</div>