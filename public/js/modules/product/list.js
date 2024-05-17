$(function () {
    $("#listProduct").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $('[data-mask]').inputmask()
});

function deleteProduct(productId){
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
                  data: { productId },
                  Headers:{
                      token: $('meta[name="csrf_token"]').attr('content')
                  },
                  success: function (data) {
                      if (data.status === 200) {
                          toastr.success('Product delete successfully');
                          $(`#productId_${productId}`).remove();
                      } else {
                          toastr.error('Product delete Error');
                      }
                  }
  
  
              });
  
          }
        });
      /* toastr.error('Error the Document Attachemente wasn\'t removed'); */
  }

  function showDataProduct(productId){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: 'getProduct',
        data: { productId },
        Headers:{
            token: $('meta[name="csrf_token"]').attr('content')
        },
        success: function (data) {
            if (data.status === 200) {
                showDataInModal(data.data)
            } else {
                toastr.error('User delete Error');
            }
        }


    });

}

function showDataInModal(data){
    const dataProduct=JSON.parse(data);
 
    //console.log(dataUser);
    const modalBody=document.getElementById('modalProductBody');
    /*modalBody.childNodes.forEach((node)=>{
    node.remove();
    });*/
    modalBody.innerHTML=`
        <div class='container'>
            <h3 class='text-center'>Datos Del Producto</h3>
            <div class='row'>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Producto</label>
                    <p class="alert alert-success text-center">
                                ${dataProduct['name']}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Producto</label>
                    <p class="alert alert-success text-center">
                                ${dataProduct['category']}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Producto</label>
                    <p class="alert alert-success text-center">
                                ${dataProduct['cost_price']}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Producto</label>
                    <p class="alert alert-success text-center">
                                ${dataProduct['increase']}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Stock</label>
                    <p class="alert alert-success text-center">
                        ${dataProduct['stock']}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <img src=${"http://127.0.0.1:8000/" + dataProduct['product_image']} width='100px'>
                    
                </div>

            </div>
            <div class="row">
                <div class="col-md-12 mb-3 m-auto">
                <label for="username" class="form-label">Description</label>
                <p class="alert alert-success text-center">
                    ${dataProduct['description']}
                </p>
                
                </div>
            </div>

        </div>
        
       

    `;

    $('#modalProduct').modal('show');

}

function modalClose(modalId){
    $(`#${modalId}`).modal('hide');
}