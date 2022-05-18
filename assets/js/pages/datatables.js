$(document).ready(function() {
    
    "use strict";
    $('#zero-conf').DataTable({
        order: [],
        columnDefs: [{
            "targets": 'no-sort',
            "orderable": false,
        }],
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6],
                    page: 'current'
                }
            },
            {
                extend: 'pdfHtml5',
                download: 'open',
                exportOptions: {
                    columns: [0,1,2,3,4,5,6],
                    page: 'current'
                },

            },
        ]
    });

    $('#complex-header').DataTable();

    var groupColumn = 2;
    var table = $('#row-grouping').DataTable({
        "columnDefs": [
            { "visible": false, "targets": groupColumn }
        ],
        "order": [[ groupColumn, 'asc' ]],
        "displayLength": 25,
        "drawCallback": function ( settings ) {
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        }
    } );
 
    // Order by the grouping
    $('#row-grouping tbody').on( 'click', 'tr.group', function () {
        var currentOrder = table.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            table.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            table.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
    
    var t = $('#add-row').DataTable();
    var counter = 1;
 
    $('#addRow').on( 'click', function (e) {
        t.row.add( [
            counter +'.1',
            counter +'.2',
            counter +'.3',
            counter +'.4',
            counter +'.5'
        ] ).draw( false );
        counter++;
        e.preventDefault();
    } );
 
    // Automatically add a first row of data
    $('#addRow').click();
});