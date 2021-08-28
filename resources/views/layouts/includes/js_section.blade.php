<!-- Button back -->
<script>
    $(function () {
        $("#back").click(function () {
            window.history.back();
        });
    });
</script>

<script>

    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('.dataTables tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" style="width: 100%;" placeholder="Search '+title+'" />' );
        } );



        // DataTable
        var table = $('.dataTables').DataTable({
            stateSave: true,
            responsive:true,
        });

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $('input', this.footer() ).on( 'keyup change', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        //search in the top
        {
            var r = $('.dataTables tfoot tr');
            r.find('th').each(function(){
                $(this).css('padding', 8);
            });
            $('.dataTables thead').append(r);
            //$('#search_0').css('text-align', 'center');
        }

        // Restore state
        var state = table.state.loaded();

        if ( state ) {
            table.columns().eq( 0 ).each( function ( colIdx ) {
                var colSearch = state.columns[colIdx].search;

                if ( colSearch.search ) {
                    $( 'input', table.column( colIdx ).footer() ).val( colSearch.search );
                }
            } );

            table.draw();
        }


    } );

</script>

<script>
    window.onresize = function(event)
    {
        document.location.reload(true);
    }
</script>
