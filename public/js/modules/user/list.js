$(function () {
    $("#listUser").DataTable({
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

    $('[data-mask]').inputmask()
});
function deleteUser(userId){
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
                url: 'userDestroy',
                data: { userId },
                Headers:{
                    token: $('meta[name="csrf_token"]').attr('content')
                },
                success: function (data) {
                    if (data.status === 200) {
                        toastr.success('User delete successfully');
                        $(`#userId_${userId}`).remove();
                    } else {
                        toastr.error('Error to show data user');
                    }
                }


            });

        }
      });
    /* toastr.error('Error the Document Attachemente wasn\'t removed'); */
}

function showDataUser(userId){
    $.ajax({
        type: "GET",
        dataType: "json",
        url: 'getUser',
        data: { userId },
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
    const dataUser=JSON.parse(data);
    const rutaServe='http://127.0.0.1:8000/';
    //console.log(dataUser);
    const modalBody=document.getElementById('modalUserBody');
    /*modalBody.childNodes.forEach((node)=>{
    node.remove();
    });*/
    modalBody.innerHTML=`
        <div class='container'>
            <h3 class='text-center'>Datos Del Usuario</h3>
            <div class='row'>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">Usuario</label>
                    <p class="alert alert-success text-center">
                                ${dataUser['username']}
                    </p>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="username" class="form-label">email</label>
                    <p class="alert alert-success text-center">
                    ${dataUser['email']}
                </p>
                </div>

            </div>

        </div>
        
       

    `;

    if(dataUser['first_name']){
        modalBody.innerHTML+=`
                <div class='container'>
                    <h3 class='text-center'>Datos Personales</h3>
                    <div class='row'>
                        <div class="col-md-6 mb-3">
                            <label for="first_name" class="form-label">Nombre</label>
                            <p class="alert alert-success text-center">
                                ${dataUser['first_name']}
                            </p>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="last_name" class="form-label">Apellido</label>
                            <p class="alert alert-success text-center">
                                ${dataUser['last_name']}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="dni" class="form-label">dni</label>
                            <p class="alert alert-success text-center">
                                ${dataUser['dni']}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="mobile" class="form-label">Móvil</label>
                            <p class="alert alert-success text-center">
                                ${dataUser['mobile']}
                            </p>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Dirección</label>
                            <p class="alert alert-success text-center">
                                ${dataUser['address']}
                            </p>
                           
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="address" class="form-label">Avatar</label>
                          
                            <div>
                                <img src= "${rutaServe+dataUser['avatar']}"
                                style="width:30px;higth:30px;" / >
                                
                            </div>
                            
                           
                        </div>

                    </div>

                </div>
          
        `
    }else{
        modalBody.innerHTML+=`
            <div class='container mt-5'>
               <h2 class='alert alert-success text-center'> Sin datos personales</h2> 
            </div>
        `
    }
    $('#modalUser').modal('show');

}

function modalClose(){
    $('#modalUser').modal('hide');
}

/* function showUser(id){
    emptyModal();
    $.ajax({
        type: "GET",
        dataType: "json",
        url: '/user/show',
        data: {
            id
        },
        success: function (data) {
            debugger
            if (data.status === 200) {
                $('.userDataJSName').val(data.name)
                $('.userUsernameJS').val(data.username)
                $('#showUser').modal('toggle')
            }
        }
    });
}

function emptyModal(){
    $('.userDataJSName').val('')
    $('.userUsernameJS').val('')
}
 */
