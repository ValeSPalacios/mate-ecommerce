
<div class="col">
  <form action={{route('cart.store')}} method="POST"
  onsubmit="return activalidateAddProduct(this,{{$product->stock}})">
    @csrf

    <div class="card body" style="width: 18rem;">
      <img src={{asset($product->product_image)}} alt="product_mate" height="250px">
      <div class="card-body">
        <h5 class="card-title poppins-medium">{{$product->name}}</h5>
        <p class="card-text poppins-regular" name="description">{{$product->description}}.</p>
        <div class="text-muted">
          @guest
            <button class="poppins-regular btn general-btn" type="submit"
            >Agregar Carrito</button>
          @else
              <div class="row mb-3">
                <label class="col-md-4 col-form-label text-md-end">Cantidad</label>

                <div class="col-md-6">
                  <input type="hidden" name="product_id" id="product_id" value="{{$product->id}}"></input>
                  <input  type="number" name="count" id="count" min="1" length="{{$product->stock}}" value="1"
                    class="poppins-regular form-control" autofocus>
                </div>
              </div>
            <button class="poppins-regular btn general-btn" type="submit" href="{{route('login')}}"
            >Agregar Carrito</button>
          @endguest
        </div>
      </div>
    </div>
  </form>
</div>





