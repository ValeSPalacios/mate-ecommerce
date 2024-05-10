function validateAddProduct(e,stock) {
   let flag=true;
  
  
    totalUnits=parseInt($('#totalUnits').val());
    if(isNaN(totalUnits)|| stock<totalUnits){
        //flag=false;
        Swal.fire({
            icon: "error",
            title: "Error.",
            text: "Por favor; revise que el stock introducido sea menor al existente.",
          });
          flag= false;
          
    }
       return flag;
    }
  
