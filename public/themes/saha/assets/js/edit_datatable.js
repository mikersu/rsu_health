
// $(document).ready(function() {
     

// /*===============================================
// =            Delete Data !! About it            =
// ===============================================*/

// var oTable_about =    $('.datatable_about').dataTable( {
//                                                 "aoColumns": [
//                                                                 { "sWidth": "10%" },
//                                                                 { "sWidth": "70%" },
//                                                                 { "sWidth": "10%" },
//                                                                 { "sWidth": "10%" }
//                                                             ],
//                                                             "aaSorting": [[ 0, "desc" ]]
//                                             } );


// $('.datatable_about a.delete_data').live('click', function (e) {
//     e.preventDefault();


//     if (confirm("Are you sure to delete this row ? ") == false) 
//     {
//         return;
//     }

//     set_url = window.location.origin;

//     data_url = $(this).attr( 'data-url' );

//     c_this = $(this);

//     $.ajax({
//         type: "GET",
//         url: data_url,
//         success: function(data) 
//         {  
//             if ( data == 1 ) 
//             {
//                 var nRow = c_this.parents('tr')[0];
//                 oTable_about.fnDeleteRow(nRow);
//                 // alert("Deleted Success !");
//                 html = ''; 
//                 html += '<div class="alert alert-success">';
//                 html += '<button class="close" data-dismiss="alert"></button>';
//                 html += '<strong>Success! </strong>';
//                 html += 'The page has been save success.';
//                 html += '</div>';
//                 $('.before_show_log').before( html );    
//             }
//             else
//             {
//                 alert("Deleted Error ! , Please try again.");
//             }


//         }
//     });

// });   
// /*-----  End of end data table About  ------*/





// /*=============================================
// =            Section comment block            =
// =============================================*/

//     $('.datatable_news').dataTable( {
//     "aoColumns": [
//         { "sWidth": "12%" },
//         { "sWidth": "45%" },
//         { "sWidth": "7%" },
//         { "sWidth": "6%" },
//         { "sWidth": "7%" },
//         { "sWidth": "7%" },
//         { "sWidth": "7%" }
//     ]
// } );




















// });



















