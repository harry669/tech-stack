@extends('layouts.app')

@section('content')

<section style="background-color: #eee;">
    <div class="container p-3 my-3 bg-dark text-white">
      <div class="d-flex flex-row justify-content-around">

      <form method="GET" action="{{ route('filter-products') }}"class="form-inline">
      @csrf

      <div class="form-group">
        <div class="col">
      <select name="category" class="form-control" id="category" required>
      <option value="0">Select Category</option>
         @foreach($category as $cat)
        <option value="{{$cat->id}}">{{$cat->cat_name}}</option>
         @endforeach
      </select>
         </div>
      </div>

      <div class="form-group">
        <div class="col">
      <select name="price" class="form-control" id="price" required>
      <option value="0">Select Price</option>
        @foreach($price as $p)
        <option value="{{$p->id}}">{{$p->price}}$</option>  
        @endforeach
      </select>
       </div>
      </div>

      <button type="submit" class="btn btn-primary">Search</button>

     </form>

    </div>
    </div>

  <div class="container py-5">
  @if(session()->has('alert'))
    <div class="alert alert-success">
      {{ session()->get('alert') }}
    </div>
  @endif

  
  <div class="row">


 @if($product->isEmpty())
 <div class="alert alert-success">
      <p>Product List Empty Please Add Products</p>
 </div>
 @else 
 @foreach($product as $list)
  <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
        <div class="card text-black">
          <img
            src="{{asset('/storage/photos/'.$list->img_path)}}"
            class="card-img-top"
            alt="iPhone"
          />
          <div class="card-body">
            <div class="text-center mt-1">
              <h4 class="card-title">{{$list->pro_name}}</h4>
              <h5 class="card-title">{{$list->price}}$</h5>
              <h6 class="text-primary mb-1 pb-3">{{$list->cat_name}}</h6>          
            </div>

            <div class="d-flex flex-row">
              
              <a role="button"  class="btn btn-danger flex-fill ms-1" href="{{ route('add-to-cart') }}"  onclick="event.preventDefault();
              document.getElementById('product-cart-form{{$list->pro_ref}}').submit();">Add To Cart</a>
                
              
              </div>

              <form id="product-cart-form{{$list->pro_ref}}" action="{{ route('add-to-cart') }}" method="POST" class="d-none">
              @csrf
              <input name="invisible_id" type="hidden" id='invisible_id' value="{{$list->pro_ref}}">
              </form>

          </div>
        </div>
      </div>
  @endforeach
  @endif
</div>
</div>
<section>
      
@endsection