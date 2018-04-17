<script>
    CKEDITOR.replace('<?php echo $id; ?>',
        {
            filebrowserImageBrowseUrl: '<?php echo route('admin.elfinder.ckeditor4'); ?>'
        }
    );
</script>