@extends('auth.layouts.master')

@isset($sku)
    @section('title', 'Редактировать товарное предложение')
@else
    @section('title', 'Создать товарное предложение')
@endisset

@section('content')
    <div class="col-md-12">
        @isset($sku)
            <h1>Редактировать товарное предложение <b>{{ $product->name }}</b></h1>
        @else
            <h1>Добавить товарное предложение <b>{{ $product->name }}</b></h1>
        @endisset

        <form method="POST" enctype="multipart/form-data"
              @isset($sku)
              action="{{ route('skus.update', [$product, $sku]) }}"
              @else
              action="{{ route('skus.store', $product) }}"
            @endisset
        >
            <div>
                @isset($sku)
                    @method('PUT')
                @endisset
                @csrf
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Цена: </label>
                    <div class="col-sm-6">
                        @error('price')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="price"
                               value="@isset($sku){{ $sku->price }}@endisset">
                    </div>
                </div>

                <br>
                <div class="input-group row">
                    <label for="name" class="col-sm-2 col-form-label">Кол-во: </label>
                    <div class="col-sm-6">
                        @error('count')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" name="count"
                               value="@isset($sku){{ $sku->count }}@endisset">
                    </div>
                </div>

                @foreach ($product->properties as $property)
                    <div class="input-group row">
                        <label for="name" class="col-sm-2 col-form-label">{{ $property->name }}: </label>
                        <div class="col-sm-6">
                        <select name="property_option_id[{{ $property->id }}]" class="form-control">
                            @foreach($property->propertyOptions as $propertyOption)
                                <option value="{{ $propertyOption->id }}"
                                        @isset($sku)
{{--                                        @if($product->category_id == $propertyOption->id)--}}
{{--                                        selected--}}
{{--                                    @endif--}}
                                    @endisset
                                >{{ $propertyOption->name }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                @endforeach

                <button class="btn btn-success">Сохранить</button>
            </div>
        </form>
    </div>
@endsection

