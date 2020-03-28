@extends('auth.layouts.master')

@section('title', 'Товарные предложения')

@section('content')
    <div class="col-md-12">
        <h1>Товарные предложения</h1>
        <h2>Товар {{ $product->name }}</h2>
        <table class="table">
            <tbody>
            <tr>
                <th>
                    #
                </th>
                <th>
                    Название
                </th>
                <th>
                    Свойства Предложения
                </th>
                <th>
                    Действия
                </th>
            </tr>
            @foreach($skus as $sku)
                <tr>
                    <td>{{ $sku->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>
                        @foreach ($sku->propertyOptions as $propertyOption)
                            {{ $propertyOption->property->name }}: {{ $propertyOption->name }}
                        @endforeach
                    </td>
                    <td>
                        <div class="btn-group" role="group">
                            <form action="{{ route('skus.destroy', [$product, $sku]) }}" method="POST">
                                <a class="btn btn-success" type="button" href="{{ route('skus.show', [$product, $sku]) }}">Открыть</a>
                                <a class="btn btn-warning" type="button" href="{{ route('skus.edit', [$product, $sku]) }}">Редактировать</a>
                                <a class="btn btn-primary" type="button" href="{{ route('property-options.index', [$product, $sku]) }}">Значение свойства</a>
                                @csrf
                                @method('DELETE')
                                <input class="btn btn-danger" type="submit" value="Удалить"></form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $skus->links() }}
        <a class="btn btn-success" type="button"
           href="{{ route('skus.create', $product) }}">Добавить товарные предложение</a>
    </div>
@endsection
