window.addEventListener('load',()=>{
    const updateForm=document.getElementById('updateForm');
    const createForm=document.getElementById('createForm');
    if(updateForm){
        updateForm.addEventListener('submit',(e)=>{
            if(!validateUpdateProduct()) e.preventDefault();
        });
    }
    if(createForm){
        createForm.addEventListener('submit',(e)=>{
            if(!validateCreateProduct()) e.preventDefault();
        });
    }
})

function commonValidates(){
    let flag = true;
    let errorMsg=[];
    const price=$('#price').val();
    const increase=$('#increase').val();

    if ($('#name').val() == ""){
        flag = chekedInputOrFields("name");
        errorMsg.push('El nombre no debe estar vacío');
    }
                

   if(!isFloatNotNegative(price)){
        flag = chekedInputOrFields("price");
        errorMsg.push('El precio debe ser mayor a cero');
    }
        
        

    if(!isIntegerNotNegative(increase)) {
        flag = chekedInputOrFields("increase");
        errorMsg.push('El incremento no puede ser mayor o igual cero');
    }
        
        

   /*  if ($('#first_name').val() == "")
        flag = chekedInputOrFields("first_name"); */

    if ($('#description').val() == ""){
        flag = chekedInputOrFields("description");
        errorMsg.push('Coloque una descripción');

    }


    return {flag:flag,msgErrors:errorMsg}; 
}


function validateCreateProduct(){
    let flag = true;
    let data=commonValidates();

    flag=data.flag;
    let archivoInput = document.getElementById('product-img');
    /* let files = document.getElementById('avatar').files; */
    let zero= document.getElementsByName('product-img');
    let archivoRuta = archivoInput.value;
    let extPermitidas = /(.png|.gif|.jpg|.jpeg)$/i;
    if(!extPermitidas.exec(archivoRuta)){
        archivoInput.value = '';
        flag = chekedInputOrFields("product-img");
        data.msgErrors.push('La imagen debe ser png, gif, jpg, jpeg')
    }
  
    if(!flag) showModalErrorProduct(commonValidates.msgErrors);
    return flag;
}


function validateUpdateProduct(){
    try {
        const data= commonValidates();
    if(!data.flag) showModalErrorProduct(data.msgErrors);
    return data.flag;
    } catch (error) {
        console.log(error);
        return false;
    }
    
}




function chekedInputOrFields(classOrIdJquery) {
    //$(`#${classOrIdJquery}`).attr('required', true);
/*     $('#'+classOrIdJquery).attr('required',true); */
    $(`.${classOrIdJquery}`).css('color', 'red');


    /*     $(`.${classOrIdJquery}`).css('display', 'inline');
    $(`.${classOrIdJquery}`).text('Error in '+classOrIdJquery); */
    return false;
}

function isIntegerNotNegative(value){
    let valid=true;
    const numberAnalized=parseInt(value);
    if(isNaN(numberAnalized)) valid=false;
    if(valid && numberAnalized<=0) valid=false;
    return valid;

}

function isFloatNotNegative(value){
    let valid=true;
    const numberAnalized=parseFloat(value);
    if(isNaN(numberAnalized)) valid=false;
    if(valid && numberAnalized<=0) valid=false;
    return valid;
}

function showModalErrorProduct(msgErrors){

    const errorList=document.createElement('ul');
    msgErrors.forEach(error => {
        const errorElement=document.createElement('li');
        errorElement.innerText=error
        errorList.append(errorElement);
    });
    Swal.fire({
        title: "<strong>Errores <u>al crear el producto</u></strong>",
        icon: "error",
        html: errorList,
        showCloseButton: true,
        cancelButtonText: `
          <i class="fa fa-thumbs-down"></i>
        `,
        cancelButtonAriaLabel: "Salir"
      });
}
