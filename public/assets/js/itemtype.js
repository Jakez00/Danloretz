$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



$('#additem').on('click','#addtype', function(){

    $.ajax({
        type: 'POST',
        url: 'itemcatergory/add',
        cache: false,
        data: $('#formadditem').serialize(),
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
                $("#description").val("");
                $("#location").val("");
                Swal.fire(
                  'Saved!',
                   response.message,
                  'success'
                )
                $("#additem").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });

})

$('#edititem').on('click','#edititem', function(){
    
    $.ajax({
        type: 'POST',
        url: 'itemcatergory/edit',
        cache: false,
        data: $('#formedititem').serialize(),
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
                $("#edititem").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });

})

$(document).on('click','#edit', function(){
    var id = $(this).closest('tr').find('#id').val()

    $.ajax({
        url: 'itemcatergory/detail',
        method: 'GET',
        data: { id:id},
        success: function(response) {
            $('#formedititem').find('input[name="id"]').val(id)
            $('#formedititem').find('input[name="ename"]').val(response.name)
            $('#formedititem').find('textarea[name="edescription"]').val(response.description)
        }
    });

})


$(document).on('click','#delete', function(){
  var id = $(this).closest('tr').find('#id').val()
  var name = $(this).closest('tr').find('#name').val()

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
                url: 'itemcatergory/delete',
                cache: false,
                data: {id:id, name:name},
                dataType:'json',
                success: function(){
                    Swal.fire({
                        title: 'Deleted!',
                        text: "Store has been deleted",
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