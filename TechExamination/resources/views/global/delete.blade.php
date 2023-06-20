<script>
   
    $(document).on('click', '.delete_record', function() {

        var confirmation = confirm('Are you sure you want to delete record');
        if (confirmation) {
            $(this).closest('form').submit();
        } else {
            return false;
        }
    })
</script>