<template>
  <div>
    <div v-if="emptyCart===false">
       
        <h2 class="text-center">Lista De Productos</h2>
        <div>
           
            <table class="table table-striped table-responsive text-center my-5 m-auto">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Precio Final</th>
                    <th>Add One</th>
                    <th>Reduce One</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="detail in details.data" :key="detail.id">
                    <td> {{ detail.name}} </td>
                    <td> {{ detail.cost_price }}</td>
                    <td> {{ detail.count }} </td>
                    <td> {{ detail.final_price }} </td>
                    <td>
                    <button class="btn" @click="update_detail(detail.id,1)">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                    </td>
                    <td><button class="btn" @click="update_detail(detail.id,-1)">
                        <i class="fa-solid fa-minus"></i>
                    </button>
                    </td>
                    <td>
                        <button class="btn" @click="delete_detail(detail.id)">
                            <i class="fas fa-trash-alt" style="color:red"></i>
                        </button>

                    </td>
                </tr>

            </tbody>
        </table>
         <pagination :data="details" @pagination-change-page="getResults"></pagination>
        </div>
       
    </div>
    <div v-else>
        <h2>No hay elementos en el carrito aún</h2>
    </div>
    <div class="alert alert-success text-center">
        {{ "Precio Final Total: " + total }}
        <div>
          
        </div>
    </div>
        
    </div>
</template>

<script>


 
export default {
   
  
    data(){
        return{
            // Our data object that holds the laravel paginator data
            details:{},
            userLoginId:{},
            emptyCart:false,
            total:0
        }
    },
    mounted() {
        /**
         * Un problema que se presentó fue que, sin importar en qué vista estuviéramos, siempre se 
         * intentaba cargar los componentes de Vue. Con este apartado controlo la ruta para que no
         * aparezca el error constantemente. Pero, está mal, porque siempre se estará cargando el
         * componente molestando la experiencia del usuario.
         */
        if(location.href.indexOf('indexCart')!==-1){
                //recupero la información del usuario logueado desde la cabecera
            let userInformationTag=document.getElementById('loginData');
            //guardo la información en la variable del componente
            this.userLoginId=JSON.parse(userInformationTag.getAttribute('content'));
            //remuevo la etiqueta con la información del usuario de la cabecera
            userInformationTag.remove();
            this.getResults(); 
            //this.calculate_total();
        };
     

    },
    methods:{
        getResults(page = 1) {
            
            //axios.get(`http://localhost/impcargo/impcargo/api.php?mes=${this.mes}&amp;idAuto=${this.id}`)
           try {
            axios.get('/api/details?'+this.userLoginId,{
                params:{
                    'page': page,
                    'idUser': this.userLoginId
                }
            }
                
            )
				.then(response => {
					this.details = response.data;
                    this.emptyCart=!this.details.data.length>0;
                    
                    this.calculate_total(response.data);
                    
				})
                .catch(error=>{
                    this.details={};
                    if(error.text==null){
                        this.emptyCart=true;
                        this.$swal({icon:'error',title:'Carrito Vacío'});
                    }
                    
                    
                });
            
           } catch (error) {
            console.log(error);
           }
			
		},
        delete_detail(detailId){

            this.$swal({
                title: 'Are you Sure?',
                text:'You won\'t be able to revert this',
                
                showCancelButton:true,
                confirmButtonColor:'red',
                cancelButtonColor:'grey',
                confirmButtonText:'Yes, delete it'
            })
            .then((result)=>{
                if(result.value){
                    axios.delete('/api/details/destroy',{params:{'detailId':detailId}})
                        .then((response) => {
                            this.$swal({icon:'info',title:'Delete Successfully'});
                            this.getResults();
                           
                        })
                        .catch((error) =>{
                            this.$swal({icon:'error',title:error});
                        });
                }
            })

        },

        update_detail(detailId,increment){
          
            axios.put('/api/details/update',{
                params:{'detailId': detailId,'increment': increment}})
                        .then((response) => {
                            this.$swal({icon:'info',title:'Modificación Exitosa'});
                            this.getResults();
                            
                        })
                        .catch((error) =>{
                            this.$swal({icon:'error',title:'Error'});
                        });           
                
        },

        calculate_total(details){
           this.total=0;
            details.data.forEach(detail => {
              
                this.total+=detail.final_price;
              
            });
        }
     
    }
}

</script>
</template>

