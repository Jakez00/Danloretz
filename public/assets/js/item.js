$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });



$('#additem').on('click','#add', function(){

    $.ajax({
        type: 'POST',
        url: 'items/add',
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
                $("#price").val("");
                $("#quantity").val("");
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

$('#addstock').on('click','#addstock', function(){

    $.ajax({
        type: 'POST',
        url: 'items/addstock',
        cache: false,
        data: $('#formaddstock').serialize(),
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
                $("#quantity").val("");
                Swal.fire(
                  'Saved!',
                   response.message,
                  'success'
                )
                $("#addstock").on("hidden.bs.modal", function(e){
                  window.location.reload();
                 })
              }
        }
    });

})


$('#additem').on('input','#price', function(){
  const rawValue = $(this).val();
  
  // Remove all non-numeric characters except for the first decimal point
  const numericValue = rawValue.replace(/[^0-9\.]/g, '');

  // Add commas to the number
  const parts = numericValue.split('.');
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  const formattedValue = parts.join('.');

  $(this).val('₱ ' +formattedValue);
})


$('#edititem').on('click','#edititem', function(){
    
    $.ajax({
        type: 'POST',
        url: 'items/edit',
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
        url: 'items/detail',
        method: 'GET',
        data: { id:id},
        success: function(response) {
            $('#formedititem').find('input[name="id"]').val(id)
            $('#formedititem').find('input[name="ename"]').val(response.name)
            $('#formedititem').find('input[name="eprice"]').val('₱ ' + response.price.toLocaleString())
            $('#formedititem').find('input[name="equantity"]').val(response.quantity)
            $('#formedititem').find('textarea[name="edescription"]').val(response.description)
        }
    });

})

$(document).on('click','#stock', function(){
    var id = $(this).closest('tr').find('#id').val()

    $.ajax({
        url: 'items/detail',
        method: 'GET',
        data: { id:id},
        success: function(response) {
            $('#formaddstock').find('input[name="id"]').val(id)
            $('#formaddstock').find('input[name="stockname"]').val(response.name)
        }
    });

})

$('#edititem').on('input','#eprice', function(){
  const rawValue = $(this).val();
  
  // Remove all non-numeric characters except for the first decimal point
  const numericValue = rawValue.replace(/[^0-9\.]/g, '');

  // Add commas to the number
  const parts = numericValue.split('.');
  parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
  const formattedValue = parts.join('.');

  $(this).val('₱ ' +formattedValue);
})

$(document).on('click','#delete', function(){
  var id = $(this).closest('tr').find('#id').val()

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
                url: 'items/delete',
                cache: false,
                data: {id:id, name:name},
                dataType:'json',
                success: function(){
                    Swal.fire({
                        title: 'Deleted!',
                        text: "Item has been deleted",
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