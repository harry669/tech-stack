@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Update Existing Product') }}</div>

                <div class="card-body">
                @if(session()->has('alert'))
                  <div class="alert alert-success">
                   {{ session()->get('alert') }}
                 </div>
                @endif

                    <form method="POST" action="{{ route('update-product') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name Of Product') }}</label>

                            <div class="col-md-6">
                                <input id="pro_name" type="text" class="form-control @error('pro_name') is-invalid @enderror" name="pro_name" value="{{ $product->pro_name }}"  autofocus>
                                @error('pro_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price Of Product') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="text" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}"  autofocus>
                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <input name="invisible_id" type="hidden" id='invisible_id' value="{{$product->pro_ref}}">

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Choose Image') }}</label>

                            <div class="col-md-6">
                                <input id="pro_path" type="file" class="form-control @error('pro_path') is-invalid @enderror" name="pro_path" autocomplete="pro_path">

                                @error('pro_path')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Choose Category') }}</label>

                            <div class="col-md-6">
                               <select name="cat_ref" class="form-control" id="cat_ref">
                               <option value="{{$product->cat_ref}}">{{$product->cat_name}}</option>
                               @foreach($category as $cat)
                               @unless($product->cat_ref == $cat->id)
                               <option value="{{ $cat->id }}">{{ $cat->cat_name }}</option>
                               @endunless
                               @endforeach
                               </select>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Update Existing Product') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
