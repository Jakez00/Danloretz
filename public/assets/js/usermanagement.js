$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



$('#adduser').on('click','#adduser', function(){
    
    $.ajax({
        type: 'POST',
        url: 'user-management/add',
        cache: false,
        data: $('#formadduser').serialize(),
        dataType:'json',
        success: function(response){
            if(response.Error == 1){
                Swal.fire(
                  'Error!',
                   response.message,
                  'error'
                )
              }
              else if(response.Error == 0){
                $("#name").val("");
                $("#email").val("");
                $("#pass1").val("");
                $("#pass2").val("");

                Swal.fire(
                  'Saved!',
                   response.message,
                  'success'
                )
                $("#adduser").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });

})

$('#edituser').on('click','#edituser', function(){
    
    $.ajax({
        type: 'POST',
        url: 'user-management/edit',
        cache: false,
        data: $('#formedituser').serialize(),
        dataType:'json',
        success: function(response){
            if(response.Error == 1){
                Swal.fire(
                  'Error!',
                   response.message,
                  'error'
                )
              }
              else if(response.Error == 0){
                Swal.fire(
                  'Saved!',
                   response.message,
                  'success'
                )
                $("#edituser").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });

})

$(document).on('click','#edit', function(){
    var id = $(this).closest('tr').find('#id').val()

    $.ajax({
        url: 'user-management/detail',
        method: 'GET',
        data: { id:id},
        success: function(response) {
            $('#formedituser').find('input[name="id"]').val(response.id)
            $('#formedituser').find('input[name="ename"]').val(response.firstname)
            $('#formedituser').find('input[name="eemail"]').val(response.email)
            $('#formedituser').find('select[name="erole"]').val(response.role)
        }
    });

})


$(document).on('click','#delete', function(){

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'POST',
                url: 'user-management/delete',
                cache: false,
                data: {id:id},
                dataType:'json',
                success: function(){
                    Swal.fire({
                        title: 'Deleted!',
                        text: "User has been deleted",
                        icon: 'success',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                      }).then(() => {
                            window.location.reload();
                      })
                }
            });
          
        }
      })
})