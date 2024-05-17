$(function () {
    $("#listProvider").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });

    $('[data-mask]').inputmask();

    /*const listButton=document.getElementsByClassName("showData");
    for(let i=0;i<listButton.length;i++){
        listButton[i].addEventListener('click',(e)=>{
            
           showDataProvider(e.target.value);
        })
    }*/
});

function deleteProvider(providerId){
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
            url: 'providerDestroy',
            data: { providerId },
            Headers:{
                token: $('meta[name="csrf_token"]').attr('content')
            },
            success: function (data) {
                if (data.status === 200) {
                    toastr.success('User delete successfully');
                    $(`#providerId_${providerId}`).remove();
                } else {
                    toastr.error('User delete Error');
                }
            }

        });
    }
        });
    
}

function showDataProvider(providerId){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: 'getProvider',
                data: { providerId },
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
    const dataProvider=JSON.parse(data);
    const modalBody=document.getElementById('modalProviderBody');
    /*modalBody.childNodes.forEach((node)=>{
        node.remove();
    });*/
    modalBody.innerHTML=`
    <div class="mb-3">
    <label  class="col-form-label">
        First Name: ${dataProvider['first_name']}
    </label>
    </div>
    <div class="mb-3">
    <label  class="col-form-label">
    Last Name: ${dataProvider['last_name']}
</label>
    </div>
    <div class="mb-3">
    <label  class="col-form-label">
    Address: ${dataProvider['address']}
</label>
    </div>
    <div class="mb-3">
    <label  class="col-form-label">
    DNI: ${dataProvider['dni']}
</label>
    </div>
    <div class="mb-3">
    <label  class="col-form-label">
    Mobile: ${dataProvider['mobile']}
</label>
    </div>
    
    `;
    $('#modalProvider').modal('show');
   
}
