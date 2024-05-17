<div class="row mt-4">
    <div class="row mb-4">


        <div class="col-md-6">
            <div class="form-group">
                <label for="name" class="col-form-label text-right colorLabel code name">Nombre</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Name Product"
                    value="{{ !empty($product) ? $product->name : old('name') }}">
            </div>
            <small class="errorProdTag" id="errorName"></small>
            @if ($errors->has('name'))
                <div class="text-danger">{{ $errors->first('name') }}</div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="cost_price" class="col-form-label text-right colorLabel code price">
                    Precio
                </label>
                <input type="text" class="form-control" name="cost_price" id="cost_price" placeholder="cost_price"
                    value="{{ !empty($product) ? $product->cost_price : old('cost_price') }}">
            </div>
            <small class="errorProdTag" id="errorPrice"></small>
            @if ($errors->has('cost_price'))
                <div class="text-danger">{{ $errors->first('cost_price') }}</div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="increase" class="col-form-label text-right colorLabel code increase">
                    Incremento
                </label>
                <input type="number" class="form-control" name="increase" id="increase" placeholder="increase"
                    value="{{ !empty($product) ? $product->increase : old('increase') }}">
            </div>
            <small class="errorProdTag" id="errorIncrease"></small>
            @if ($errors->has('increase'))
                <div class="text-danger">{{ $errors->first('increase') }}</div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="stock" class="col-form-label text-right colorLabel code increase">
                    Stock
                </label>
                <input type="number" class="form-control" name="stock" id="stock" placeholder="stock"
                    value="{{ !empty($product) ? $product->stock : old('stock') }}">
            </div>
            <small class="errorProdTag" id="errorStock"></small>
            @if ($errors->has('stock'))
                <div class="text-danger">{{ $errors->first('stock') }}</div>
            @endif
        </div>

        <div class="col-md-6 m-auto">

            <div class="form-group">
                <label for="category category" class="category">Selecciona Categoria</label>
                <div class="input-group mt-2">
                    <select class="form-select" name="category" id="category">
                        <option selected="selected" value=0>Select</option>
                        @foreach ($categories as $category)
                            <option value={{ $category->id }}
                                {{ empty($product) ? (old('category')==$category->id?'selected="selected"':'') : ($product->category->id == $category->id ? 'selected="selected"' : '') }}
                                >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <label class="input-group-text" for="category">Categoria</label>


                </div>
                <small class="errorProdTag" id="errorCategory"></small>
                @if ($errors->has('category'))
                    <div class="text-danger">{{ $errors->first('category') }}</div>
                @endif

            </div>
        </div>
        <div class="col-md-6 m-auto">
            @if (!empty($product->product_image))

                <div class="form-group">
                    <label for="product-img" class="product-img">Image</label>
                    <img src="{{ url($product->product_image) }}" class="elevation-2 userImage" alt="Product Image">
                </div>
                @else
                <div class="form-group">
                    <label for="product-img" class="product-img">Product Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            
                                
                                <input class="form-control" type="file" id="product-img" name="product-img">
                             
                        </div>
                    </div>
                    <small class="errorProdTag" id="errorProductImage"></small>
                    @if ($errors->has('product-img'))
                        <div class="text-danger">{{ $errors->first('product-img') }}</div>
                    @endif
                </div>
        
        
                @endif
        </div>
            <div class="col-12 m-auto">
                <div class="form-group">
                    <label for="description" class="col-form-label text-right colorLabel code description">
                        Description</label>
                    <textarea class="form-control" name="description" id="description" rows='10'
                    style='resize:none'>
                    {{ !empty($product) ? trim($product->description) : old('description') }}
                </textarea>
                    @if ($errors->has('description'))
                        <div class="text-danger">{{ $errors->first('description') }}</div>
                    @endif
                </div>
                <small class="errorProdTag" id="errorDescription"></small>

            </div>
        </div>
       
   
    </div>
    <div class="text-right">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
