

$(document).ready(function(){
    /* debugger */
    $('[data-mask]').inputmask()
   /*  $('.name')
    $('#name') */
   
    //Permite mostrar el nombre de la imagen cuando actualizamos los datos
    //del usuario cliente desde su vista
    /*document.getElementById('avatar').addEventListener('change',(e)=>{
       const labelDataImg= document.getElementById("avatarNameFile")
       console.log(e.target.files[0]);
        labelDataImg.innerText=e.target.files[0].name;
       
})*/
});

/**
 * Controla que los campos del formulario sean válidos
 * @param {Boolean} newUser Determina si el formulario se usará para un nuevo usuario o una actualización
 * @returns {Boolean} Retorna true si todos los campos del formulario son válidos
 */
function validateForm(newUser=true) {

    let flag = true;

    //controla que el nombre no esté vacío. 
    if ($('#first_name').val() == ""){
        flag = chekedInputOrFields("first_name");
        placeErrorsTags('first_name','errorName','Coloque un nombre por favor');
    }
        
   /*  if ($('#first_name').val() == "")
        flag = chekedInputOrFields("first_name"); */

    if ($('#last_name').val() == ""){
        flag = chekedInputOrFields("last_name");
        placeErrorsTags('last_name','errorLastName','Coloque un apellido por favor');
    }
      
    
    //si es un usuario nuevo, debe aplicar específicos controles
   if(newUser){
        controlFieldsIfNewUser();
   }
   
   

    if ($('#password').val() == ""){
        flag = chekedInputOrFields("password");
        placeErrorsTags('password','errorUserPass','Coloque una contraseña')
    }
      

    /*if ($('#role').val() == null)
        flag = chekedInputOrFields("role");*/

    if ($('#dni').val() == ""){
        flag = chekedInputOrFields("dni");
        placeErrorsTags('dni','errorUserDni','Coloque un dni. Por favor.');
    }
       

   
   
       

    if ($('#address').val() == ""){
        flag = chekedInputOrFields("address");
        placeErrorsTags('address','errorUserAddress','Coloque una dirección.');
    
    }
    
    if ($('#mobile').val() == ""){
        flag = chekedInputOrFields("mobile");
        placeErrorsTags('mobile','errorUserMobile','Coloque un teléfono válido');
    }
      

    if ($('#date_of_birth').val() == ""){
        flag = chekedInputOrFields("date_of_birth");
        placeErrorsTags('date_of_birth','errorUserBirth','Elija su fecha de nacimiento');

    }
       

    return flag;
}










/**
 * Señala las etiquetas y aplica required a los input si hay errores.
 * @param {String} classOrIdJquery El id y class del elemento al que se le aplicarán los estilos y atributos
 * @return {Boolean} Retorna false para indicar que si se entró en esta función es que hubo un error
 */
function chekedInputOrFields(classOrIdJquery) {

    $(`#${classOrIdJquery}`).attr('required', true);
/*     $('#'+classOrIdJquery).attr('required',true); */
    $(`.${classOrIdJquery}`).css('color', 'red');


    /*     $(`.${classOrIdJquery}`).css('display', 'inline');
    $(`.${classOrIdJquery}`).text('Error in '+classOrIdJquery); */
    return false;
}

function removeErrosTags(){
    
}

/**
 * Coloca una etiqueta en el DOM para señalar el error
 * @param {Sttring} idTag El id de la etiqueta a la que se le aplicará el error
 * @param {String} nameErrorTag El nombre con el que se identificará la etiqueta con el error
 * @param {String} msgError El mensaje de error mostrado 
 */
function placeErrorsTags(idTag,nameErrorTag,msgError){
    const previusErrorTag=document.getElementById(nameErrorTag);
    let inputTag=document.getElementById(idTag);
    if(previusErrorTag!==null) previusErrorTag.remove();
    let errorTag=document.createElement('small');
    errorTag.setAttribute('id',nameErrorTag);
    errorTag.classList.add('errorTag');
    errorTag.innerText=msgError;
   errorTag.style.color="red";
   switch(idTag){
     case 'mobile':
        inputTag.parentNode.parentNode.append(errorTag);
        break;
     default:
        inputTag.parentNode.append(errorTag);
   }
   
    
    
}

/**
 * Permite controlar campos específicos cuando se va a agregar un nuevo usuario
 */
function controlFieldsIfNewUser(){
    const email =$('#email').val();
    if (email == "" ){
        flag = chekedInputOrFields("email");
        placeErrorsTags('email','errorUserEmail','Coloque un email por favor');
    }else {
        flag = validateEmail(email);
        !flag?placeErrorsTags('email','errorUserEmail','El email ingresado no es válido'):'';
    }

    if ($('#username').val() == ""){
        flag = chekedInputOrFields("username");
        placeErrorsTags('username','errorUserName','Coloque un nombre de usuario por favor');
    }
    if ($('#role').val()<=0){
        flag = chekedInputOrFields("role");
        placeErrorsTags('role','errorRole','Seleccione un rol.');
    }

     //controla si existe el input para el avatar
     let archivoInput = document.getElementById('avatar');
     /* let files = document.getElementById('avatar').files; */
 
     //si no es distinto de null, permite modificar el avatar
     if(archivoInput!==null){
         //coloco el error para el avatar aquí porque usando la función placeErrorTag me da errores
         //Tuve que crear una etiqueta en un lugar específico para mostrar el error de este input.
         let errorAvatar=document.getElementById('errorAvatar');
 
         //Si existe un error previo en pantalla. Busco la etiqueta de error y la elimino.
         const msgPrevius=document.getElementById('msgErrorAvatar');
         msgPrevius!==null?msgPrevius.remove():'';
         //Vuelvo a crear la etiqueta de error para mostrar el nuevo error si se necesita.
         let msgError=document.createElement('small');
         msgError.setAttribute('id','msgErrorAvatar');
         msgError.setAttribute('class','text-danger');
 
         let zero= document.getElementsByName('avatar');
         let archivoRuta = archivoInput.value;
         let extPermitidas = /(.png|.gif|.jpg|.jpeg)$/i;
         if(!extPermitidas.exec(archivoRuta)){
             archivoInput.value = '';
             flag = chekedInputOrFields("avatar");
             msgError.innerText='Seleccione un archivo .jpg, .jpeg, .gif, .png';
             errorAvatar.append(msgError);
         }
         if(zero.length==""){
             flag = chekedInputOrFields("avatar");
             msgError.innerText='Seleccione un archivo de imagen.';
             errorAvatar.append(msgError);
         }
     }
   
}
















function validateEmail(email) {
    var mailformat = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,6}$/;
    if (email.match(mailformat)) {
        return true;
    }else{
        return chekedInputOrFields("email");
    }
}

function searchUsername(email) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: '/user/search',
        data: {
            'email': email,
            '_token': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (data) {
            if (data.status === 200) {
                alert('Valid User');
            } else {
                alert('Username already exists');
                $('#email').val('');
            }
        }
    });
}
