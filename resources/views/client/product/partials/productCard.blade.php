
<div class="col">
  <form action={{route('cart.store')}} method="POST"
  onsubmit="return activalidateAddProduct(this,{{$product->stock}})">
    @csrf
  <div class="card" style="width: 18rem;">
    <img src={{asset($product->product_image)}} class="card-img-top" alt="...">
    <div class="card-body">
      <h5 class="card-title">
        {{$product->name}}
      </h5>
      <p class="card-text" name="description">
        {{$product->description}}
      </p>
    
      @guest
    
          
      @else
      <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}"></input>
      <input type="number" name="count" id="count" min="1" length="{{$product->stock}}" value="1"
      class="bg-dark text-light">
      <button class="btn btn-primary" type="submit"
      >Agregar Carrito</button>
      
      @endguest
    </div>
  </div>
 </form>
</div>





