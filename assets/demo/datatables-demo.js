$(document).ready(function () {

    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function () {
        var title = $(this).text();
        if(title != 'Műveletek') {
            $(this).html( '<input type="text" style="width: 100px;" placeholder="Search '+title+'" />' );
        } else {
            $(this).html('');
        }
    } );

    var table = $('#example').DataTable({

    "processing": true,
    "serverSide": true,
    "ajax": "getData.php",

    "columnDefs": [ {
      "targets": -1,
      "data": null,
      "defaultContent": "<button id='buttonEdit'>Edit</button><button id='buttonDelete'>Delete</button>"
    } ],

    "pageLength": 20,
    "language": {
      "url": "//cdn.datatables.net/plug-ins/1.11.5/i18n/hu.json"
    },

    initComplete: function () {
        // Apply the search
        this.api().columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        } );
    }

  });

  $('#example tbody').on( 'click', '#buttonEdit', function () {
    var data = table.row( $(this).parents('tr') ).data();
    // alert( data[0] );
    window.location = 'edit.php?emp_no=' + data[0];
  } );

   $('#example tbody').on( 'click', '#buttonDelete', function () {
    var data = table.row( $(this).parents('tr') ).data();
    // alert( data[0] );
    window.location = 'controllers/delete.php?emp_no=' + data[0];
   } );

});