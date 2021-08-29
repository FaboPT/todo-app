<!-- Button back -->
<script>
    $(function () {
        $("#back").click(function () {
            window.history.back();
        });
    });
</script>

<script>
    // jQuery UI sortable for the todo list
    $('.todo-list').sortable({
        placeholder: 'sort-highlight',
        handle: '.handle',
        forcePlaceholderSize: true,
        zIndex: 999999
    })
</script>
