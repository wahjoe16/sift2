$(document).ready(function(){
    // Konfirmasi Delete
    $(".delete").click(function(){
        var module = $(this).attr("module");
        var module_id = $(this).attr("module_id");
        var module_name = $(this).attr("module_name");
        Swal.fire({
            title: 'Anda yakin?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
            }
          })
    })
});