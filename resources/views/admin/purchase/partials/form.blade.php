<div class="row mt-4">
    <div class="row mb-4">
        <div class="col-2 text-right">
            <label class="col-form-label text-right colorLabel">Product:</label>
        </div>
        <div class="col-4">
            @if(!empty($purchase))
            <div class="form-group mt-2">
                <select class="form-control form-select" name="product" id="product" disabled>
                    <option value="{{$product->id}}" selected>
                        {{$product->name}}
                    </option>
                </select>
                
            </div>
            @else
            <div class="form-group">
                <select class="form-control form-select" 
                name="product" data-dropdown-css-class="select2-secondary" id="product" style="width: 100%;">
                    <option selected="selected" value='0' disabled>Select</option>
                    @foreach ($products as $product)
                        <option value="{{$product->id}}" {{$product->id==old('product') ? 'selected=true' :''}}>
                            {{ $product->name }}</option>
                    @endforeach
                </select>
            </div>
                
            @endif
            
            @if($errors->has('product'))
            <small class="text-danger">
                {{$errors->first('product')}}
            </small>
        
            @endif
        </div>
        <div class="col-2 text-right">
            <label class="col-form-label text-right colorLabel">Provider:</label>
        </div>
        <div class="col-3">
        @if(!empty($purchase))
            <div class="form-group mt-2">
                <select name="provider" id="provider" disabled>
                    <option value="{{$provider->id}}" selected>
                        {{$provider->first_name . ' '. $provider->last_name}}
                    </option>
                </select>
                
            </div>
        @else
            <div class="form-group">
                <select class="form-control form-select" name="provider" data-dropdown-css-class="select2-secondary" id="provider" style="width: 100%;">
                    <option selected="selected" value='0' disabled>Select</option>
                    @foreach ($providers as $provider)
                        <option value="{{$provider->id}}" 
                            {{$provider->id==old('provider') ? 'selected=true' :''}}>
                            {{ $provider->first_name.', '.$provider->last_name}}
                        </option>
                    @endforeach
                </select>
               
            @endif
            </div>
            @if($errors->has('provider'))
            <small class="text-danger">
                {{$errors->first('provider')}}
            </small>
           @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-2 text-right">
            <label class="col-form-label text-right colorLabel">Cost Price:</label>
        </div>
        <div class="col-4">
            @if (!empty($purchase))
                <input type="text" class="form-control" name='cost_price' maxlength="10" size="10" required
                value={{empty($product)?old('cost_price'):$product->cost_price}} >
              
            @else
                <input type="text" class="form-control" name='cost_price' maxlength="10" size="10" required
                value={{(empty($products))?old('cost_price'):$product->cost_price}} >
            
            @endif
            @if($errors->has('cost_price'))
            <small class="text-danger">
                {{$errors->first('cost_price')}}
            </small>
           
        @endif
        </div>
        <div class="col-2 text-right">
            <label class="col-form-label text-right colorLabel">Increase:</label>

        </div>
        <div class="col-3">
            @if (!empty($purchase))
            <input type="text" class="form-control" name='increase' maxlength="2" size="2" required
            value={{empty($product)?old('increase'):$product->increase}} >
          
         @else
            <input type="text" class="form-control" name='increase' maxlength="2" size="2" required
            value={{empty($products)?old('increase'):$product->increase}}>
        
         @endif
           
            @if($errors->has('increase'))
            <small class="text-danger">
                {{$errors->first('increase')}}
            </small>
           
        @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-2 text-right">
            <label class="col-form-label text-right colorLabel">Count:</label>
        </div>
        <div class="col-4">
            @if (!empty($purchase))
            <input type="text" class="form-control" name='count' maxlength="4" size="4" required
            value={{old('count')}} >
       
         @else
         <input type="text" class="form-control" name='count' maxlength="4" size="4" required
         value={{empty($products)?old('count'):$product->count}} >
        
         @endif
           
            @if($errors->has('count'))
            <small class="text-danger">
                {{$errors->first('count')}}
            </small>
           
        @endif
        </div>
    </div>
    <div class="row mb-4">
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
</div>
