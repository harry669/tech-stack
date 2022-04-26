@extends('layouts.app')

@section('content')

<section style="background-color: #eee;">
  <div class="container py-5">
  @if(session()->has('alert'))
    <div class="alert alert-success">
      {{ session()->get('alert') }}
    </div>
  @endif

  <a role="button" class="btn btn-primary flex-fill me-1"  data-mdb-ripple-color="dark" href="{{ route('add-show') }}">
    Add New Product
  </a>
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

            <a role="button" class="btn btn-primary flex-fill me-1"  data-mdb-ripple-color="dark" href="{{ route('update-show',['id' => $list->pro_ref ]) }}">
            Update Product
            </a>

              
              <a role="button"  class="btn btn-danger flex-fill ms-1" href="{{ route('delete-product') }}"  onclick="event.preventDefault();
                                                     document.getElementById('product-delete-form.{{$list->pro_ref}}').submit();">Delete Product</a>
                
            </div>
          </div>
        </div>

        <form id="product-delete-form.{{$list->pro_ref}}". action="{{ route('delete-product') }}" method="POST" class="d-none">
        @csrf
        <input name="invisible_id" type="hidden" id='invisible_id' value="{{$list->pro_ref}}">

       </form>

      </div>
  @endforeach
  @endif
</div>
</div>
<section>
      
@endsection