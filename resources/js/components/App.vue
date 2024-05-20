<template>
    <div>
        <CartClient></CartClient>
    </div>
</template>

<script>
export default {
 
   data(){
        return{
            // Our data object that holds the laravel paginator data
            idUserLogin
        }
    },
    mounted(){
        console.log(this.idUserLogin);
    }
}
</script>
