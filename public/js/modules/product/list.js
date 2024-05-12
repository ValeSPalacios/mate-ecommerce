$(function () {
    $("#listProduct").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('[data-mask]').inputmask()
});

function deleteProduct(userId){
  /*     debugger */
      Swal.fire({
          title: "Are you sure?",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#F70922",
          cancelButtonColor: "#797374",
          confirmButtonText: "Yes, delete it!"
        }).then((result) => {
          if (result.isConfirmed) {
              $.ajax({
                  type: "GET",
                  dataType: "json",
                  url: 'productDestroy',
                  data: { userId },
                  Headers:{
                      token: $('meta[name="csrf_token"]').attr('content')
                  },
                  success: function (data) {
                      if (data.status === 200) {
                          toastr.success('User delete successfully');
                          $(`#productId_${userId}`).remove();
                      } else {
                          toastr.error('User delete Error');
                      }
                  }
  
  
              });
  
          }
        });
      /* toastr.error('Error the Document Attachemente wasn\'t removed'); */
  }