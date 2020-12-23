$(document).ready(function() {
  $('body').on("click", ".modalLink", function(e) {
    e.preventDefault();
    $('.modal-backdrop').show();
    $("#showDetaildModal").show();
    $("div.modal-dialog").removeClass('modal-md');
    $("div.modal-dialog").removeClass('modal-lg');
    $("div.modal-dialog").removeClass('modal-bg');
    $("div.modal-dialog").removeClass('modal-big');
    var modal_size = $(this).attr('data-modal-size');
    if (modal_size !== '' && typeof modal_size !== typeof undefined && modal_size !== false) {
      $("#modalSize").addClass(modal_size);
    } else {
      $("#modalSize").addClass('modal-md');
    }
    var title = $(this).attr('title');
    $("#showDetaildModalTile").text(title);
    var data_title = $(this).attr('data-original-title');
    $("#showDetaildModalTile").text(data_title);
    //$("#showDetaildModal").modal('show');
    $('div.ajaxLoader').show();
    $.ajax({
      type: "GET",
      url: $(this).attr('href'),
      success: function(data) {
        $("#showDetaildModalBody").html(data);
        $("#showDetaildModal").modal('show');
      }
    });
  });
});

$( ".add_to_cart" ).click(function(e) {
  e.preventDefault();

            //alert($(this).attr("value"));

            var formData = {
              id: $(this).attr("value")
            };
            $.ajax({
              type: "GET",
              data: formData,
            //dataType: 'json',
            url: 'add-to-cart',
            success: function(data) {
              // alert(data);
              //console.log(data);
              $(".wrapper").html('');
              $(".wrapper").show();
              $(".wrapper").html(data);
            },
            error: function(data) {
              console.log('Error:', data);
            }
          });
          });






$(".remove_checkout").click(function(e) {
  e.preventDefault();
  
  var r = confirm("Are You Sure To delete This Test ?");
  if (r == true) {


    var $row = $(this).parent().parent();
    var rowid = $(this).data("row-id");

    var formData = {
      id: $(this).attr("value")
    };
    $.ajax({
      type: "GET",
      data: formData,
            //dataType: 'json',
            url: 'remove_cart_test',
            success: function(data) {
               //alert(data);
               $row.remove();
               // if(data){
               //   window.location.href = '{{ route('checkout')}}";
               // }

              // $(this).closest('tr').remove();
            },
            error: function(data) {
              console.log('Error:', data);
            }
          });
  } else {
    return false;
  }
});


// $( ".remove_cart_test" ).click(function(e) {
//   e.preventDefault();

//   var $row = $(this).parent().parent();
//   var rowid = $(this).data("row-id");

//   var formData = {
//     id: $(this).attr("value")
//   };
//   $.ajax({
//     type: "GET",
//     data: formData,
//       //dataType: 'json',
//       url: 'remove_cart_test',
//       success: function(data) {
//          //alert(data);
//          $row.remove();
//         // $(this).closest('tr').remove();
//       },
//       error: function(data) {
//         console.log('Error:', data);
//       }
//     });
// });



// function doSomething() {
//  $.ajax({
//   type: "GET",
//   data: formData,
//       //dataType: 'json',
//       url: 'clear_test_cart',
//       success: function(data) {
       
//       },
//       error: function(data) {
//         console.log('Error:', data);
//       }
//     });
// }

//    window.onload = function () {
//       doSomething(); //Make sure the function fires as soon as the page is loaded
//       //setTimeout(doSomething, 5000); //Then set it to run again after ten minutes
//       setInterval(doSomething,900000);
//     }


// $( ".remove_cart_test" ).click(function(e){

//                     e.preventDefault();

//                     var $row = $(this).parent().parent();
//                     var rowid = $(this).data("row-id");
//                     //alert(rowid);

//                     var formData = {
//                       id: $(this).attr("value")
//                     };
//                     $.ajax({
//                       type: "GET",
//                       data: formData,
//             //dataType: 'json',
//             url: 'remove_cart_test',
//             success: function(data) {
//                //alert(data);
//                $row.remove();
//               // $(this).closest('tr').remove();
//           },
//           error: function(data) {
//             console.log('Error:', data);
//           }
//       });
//                   });


