//Post success alert
$(document).ready(function(){
    $('.alert-primary').fadeIn().delay(3000).fadeOut();
});

//Update Post Modal
// $(document).ready(function(){
//     $(document).on('click', '.updateBtn', function() {
//         //$('#updateModal').modal('show');
//         var post_id = $(this).val();
//         alert(post_id);
//     })
// });


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