<div class="row mt-4">
    <div class="row mb-4">
        
        
        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-right colorLabel code name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" 
                placeholder="Name Product"  
                value="{{ !empty($product) ? $product->name : old('name') }}">
                </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-right colorLabel code price">
                    Precio
                </label>
                <input type="text" class="form-control" name="price" id="price" 
                placeholder="cost_price"  
                value="{{ !empty($product) ? $product->cost_price : old('price') }}">
                </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-right colorLabel code increase">
                    Incremento
                </label>
                <input type="number" class="form-control" name="increase" id="increase" 
                placeholder="cost_price"  
                value="{{ !empty($product) ? $product->increase : old('increase') }}">
                </div>
        </div>

        <div class="col-md-6">
            
            <div class="form-group">
                <label for="category">Selecciona Categoria</label>
                <div class="input-group mt-2">
                <select class="form-select" name="category" id="category">
                    @foreach ($categories as $category)
                        <option value={{$category->id}} 
                        {{
                            empty($product)?'':($product->category->id==$category->id?'selected':'')
                        }}>
                            {{$category->name}}
                        </option>
                  
                    @endforeach
                </select>
                <label class="input-group-text" for="category">Categoria</label>
                                           
            </div>
            </div>
               
        </div>
      
        <div class="col-12 m-auto">
            <div class="form-group">
                <label for="description" class="col-form-label text-right colorLabel code description">
                    Description</label>
                <textarea class="form-control" name="description" id="description">
                    {{!empty($product) ? trim($product->description) : old('description') }}
                </textarea>
            </div>
           
            
        </div>
    </div>
    <div class="w-75 m-auto">
        @if (!empty($product->product_image))
            
        <div class="form-group">
            <label for="avatar" class="product-img">Image</label>
            <img src="{{ url($product->product_image) }}" class="elevation-2 userImage" alt="Product Image">
        </div>
        </div>
       @else
       
        <div class="form-group">
            <label for="avatar">Product Image</label>
            <div class="input-group">
                <div class="custom-file">
                <input type="file" class="custom-file-input" name="product-img" id="product-img">
                <label class="custom-file-label" for="product-img" >Product</label>
                </div>
            </div>
        </div>
      
        
       @endif
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
