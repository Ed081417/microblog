//Post success alert
$(document).ready(function(){
    $('.alert-primary').fadeIn().delay(3000).fadeOut();

    $('.alert-success').fadeIn().delay(3000).fadeOut();

    $('.alert-danger').fadeIn().delay(3000).fadeOut();  

});




//Validate form before submit
// $(document).ready(function(){
//     $('#formSubmit').click(function(e){
//         e.preventDefault();
//         $.ajaxSetup({
//             headers: {
//                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
//             }
//         });
//         $.ajax({
//             url: "{{ url('/posts') }}",
//             method: 'post',
//             data: {
//                 title: $('#title').val(),
//                 description: $('#description').val(),
//             },
//             success: function(result){
//                 if(result.errors)
//                 {
//                     $('.alert-danger').html('');

//                     $.each(result.errors, function(key, value){
//                         $('.alert-danger').show();
//                         $('.alert-danger').append('<li>'+value+'</li>');
//                     });
//                 }
//                 else
//                 {
//                     $('.alert-danger').hide();
//                     $('#postModal').modal('hide');
//                 }
//             }
//         });
//     });
// });