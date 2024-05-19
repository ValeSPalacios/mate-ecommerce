
/**
 * Realiza las validaciones comunes tanto para la creación como para la actualización
 * @param {Array} $product El arreglo con los datos del producto
 * @param {String} action Determina si se realizará una creación o actualización
 * @returns {Object} Retorna un objeto con dos campos: la bandera de si hubo o no errores, y el arreglo de errores
 */
function commonValidates($product=null, action = "create") {
    let flag = true;
    let errorMsg = [];
   
    const price =document.getElementById('cost_price'); 
    const increase = document.getElementById('increase');
    const name = document.getElementById('name');
    const stock = document.getElementById('stock');
    const description = document.getElementById('description');
    resetErrors();
    console.log(name.value);
    if (name.value == "") {
        flag = chekedInputOrFields("name");
        errorMsg.push({"errorTag":'errorName',"msg":"El nombre no debe estar vacío"});
        action != "create" ? redoTheOriganValue(name, $product["name"]) : "";
    }

    if (!isFloatNotNegative(price.value)) {
        flag = chekedInputOrFields("price");
        errorMsg.push({"errorTag":'errorPrice',"msg":"El precio debe ser mayor a cero"});
        action != "create"
            ? redoTheOriganValue(price, $product["cost_price"])
            : "";
    }

    if (!isIntegerNotNegative(increase.value)) {
        flag = chekedInputOrFields("increase");
        errorMsg.push({"errorTag":'errorIncrease',"msg":"El incremento debe ser mayor o igual a 1"});
      
        action != "create"
            ? redoTheOriganValue(increase, $product["increase"])
            : "";
    }

    if (!isIntegerEqOrGtZero(stock.value)) {
        flag = chekedInputOrFields("stock");
        errorMsg.push({"errorTag":'errorStock',"msg":"El stock debe ser mayor o igual a 0"});
        action != "create" ? redoTheOriganValue(stock, $product["stock"]) : "";
    }

    /* if ($('#first_name').val() == "")
flag = chekedInputOrFields("first_name"); */
    if (description.value == "") {
        flag = chekedInputOrFields("description");
        errorMsg.push({"errorTag":'errorDescription',"msg":"Debe colocarse la descripción"});
        
        action != "create"
            ? redoTheOriganValue(description, $product["description"])
            : "";
    }

    return { flag: flag, msgErrors: errorMsg };
}

/**
 * Valida que la cración del producto sea válida controlando los campos
 * @returns {Boolean} Retorna true en caso que no haya errores, false en caso contrario
 */
function validateCreateProduct() {

    try {
        
        let flag = true;
        let data = commonValidates();
        resetErrors();
        flag = data.flag;
        let archivoInput = document.getElementById("product-img");
        const category=document.getElementById("category");
        let archivoRuta = archivoInput.value;
        let extPermitidas = /(.png|.gif|.jpg|.jpeg)$/i;
        if (!extPermitidas.exec(archivoRuta)) {
            archivoInput.value = "";
            flag = chekedInputOrFields("product-img");
            data.msgErrors.push({"errorTag":'errorProductImage',"msg":"La imagen debe ser png, gif, jpg, jpeg"});
           
        }

        if(category.value<1 || isNaN(category.value)){
            flag = chekedInputOrFields("category");
            data.msgErrors.push({"errorTag":'errorCategory',"msg":"Seleccione una categoria"});
         
        }
        //console.log(data);
        //console.log(data.msgErrors);
        //debugger
        if (!flag) showErrors(data.msgErrors);
        return flag;
    } catch (error) {
        console.log(error);
        return false;
    }
}

/**
 * Valida que los datos para la actualización sea correcto.
 * @param {Array} $product El arreglo con los datos del producto. Necesario para conocer los valores previos en caso de errores
 * @returns {Boolean} Retorna true en caso que no haya errores, y retorna false en caso contrario
 */
function validateUpdateProduct($product) {
    
    try {
        const data = commonValidates($product, "update");
        resetErrors();
        if (!data.flag) showErrors(data.msgErrors);
        return data.flag;
    } catch (error) {
        console.log(error);
        return false;
    }
}

/**
 * Resalta las etiquetas en caso de error y aplica validate al input en cuestión
 * @param {String} classOrIdJquery La clase e id de la etiqueta a resaltar
 * @returns {Boolean} Retorna false ya que si se ingresó a esta función, al menos un campo es incorrecto
 */
function chekedInputOrFields(classOrIdJquery) {
    $(`#${classOrIdJquery}`).attr("required", true);
    /* $('#'+classOrIdJquery).attr('required',true); */
    $(`.${classOrIdJquery}`).css("color", "red");

    /* $(`.${classOrIdJquery}`).css('display', 'inline');
$(`.${classOrIdJquery}`).text('Error in '+classOrIdJquery); */
    return false;
}

/**
 * Controla que el valor pasado sea un entero no negativo
 * @param {String} value El valor que será controlado
 * @returns {Boolean} Retorna true en caso de ser un entero no negativo, false en caso contrario.
 */
function isIntegerNotNegative(value) {
    let valid = true;
    const numberAnalized = parseInt(value);
    if (isNaN(numberAnalized)) valid = false;
    if (valid && numberAnalized <= 0) valid = false;
    return valid;
}

/**
 * Controla si el valor pasado es un entero igual o mayor a cero
 * @param {String} value El valor que será analizado
 * @returns {Boolean} Retorna true en caso de que sea un valor mayor o igual a cero, false en caso contrario.
 */
function isIntegerEqOrGtZero(value) {
    let valid = true;
    const numberAnalized = parseInt(value);
    if (isNaN(numberAnalized)) valid = false;
    if (valid && numberAnalized < 0) valid = false;
    return valid;
}

/**
 * Controla si el valor pasado es un flotante no negativo
 * @param {String} value El valor que será controlado
 * @returns {Boolean} Retorna true en caso de que el valor sea un flotante no negativo, false en caso contrario
 */
function isFloatNotNegative(value) {
    let valid = true;
    const numberAnalized = parseFloat(value);
    if (isNaN(numberAnalized)) valid = false;
    if (valid && numberAnalized <= 0) valid = false;
    return valid;
}

/**
 * Toma las etiquetas de errores coloreadas y remueve los colores. Las textos de errores son colocados en
 * blanco.
 */
function resetErrors(){
    const labelsWithErrors=document.getElementsByClassName('colorLabel');
    const errorsTags=document.getElementsByClassName('errorProdTag');
    for(let i=0;i<labelsWithErrors.length;i++){
        labelsWithErrors[i].style.color="black";
    };
   
    if(errorsTags.length>0){
        for(let i=0;i<errorsTags.length;i++){
            errorsTags[i].innerText='';
        }
    }
}

/**
 * Permite restablecer el valor antiguo del producto para un campo específico si es que se produce un error.
 * Se evita perder el dato en la actualización
 * @param {HTMLInputElement} inputTag El input al que se le colocará el valor antiguo del dato del producto
 * @param {String} value El valor antiguo del producto que será recolocado en el input
 */
function redoTheOriganValue(inputTag, value) {
    inputTag.value=value;
}

/**
 * Permite mostrar los errores producidos en el formulario
 * @param {Array} arrayErrors El array de errores que se mostrarán en el formulario
 */
function showErrors(arrayErrors){
    if(arrayErrors.length>0){
        arrayErrors.forEach((error)=>{
            //console.log(error);
            const errorTag=document.getElementById(error.errorTag);
            //console.log(errorTag);
            errorTag.innerText=error.msg;
            errorTag.style.color="red";
        });
    }
}

/*
function showModalErrorProduct(msgErrors) {
    console.log(msgErrors);
    const errorList = document.createElement("ul");
    msgErrors.forEach((error) => {
        const errorElement = document.createElement("li");
        errorElement.innerText = error;
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
        cancelButtonAriaLabel: "Salir",
    });
}*/

