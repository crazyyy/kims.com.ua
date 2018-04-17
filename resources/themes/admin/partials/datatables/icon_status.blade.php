<div class="col-xs-2 col-xs-offset-5">
    @if ($model->{$field} == true)
        <i class="glyphicon glyphicon-ok green"></i>
    @else
        @if (empty($only_true))
            <i class="glyphicon glyphicon-remove red"></i>
        @endif
    @endif
</div>