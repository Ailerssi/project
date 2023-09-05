@extends('layouts.admin_layout')

@section('title', 'Все товары')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Все товары</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if(session('success'))
                    <div class="alert alert-success" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                        <h4><i class="icon fa fa-check"></i>{{ session('success') }}</h4>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body pb-0">
                        @foreach($categories as $category)
                            <div class="col-md-12">
                                <div class="card card-success card-outline direct-chat direct-chat-success collapsed-card">
                                    <div class="card-header">
                                        <h3 class="card-title">
                                            Категория: {{ $category->title }}
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool collapsed" data-card-widget="collapse" data-target="#cardCollapse{{ $category->id }}">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div id="cardCollapse{{ $category->id }}" class="card-footer collapse">
                                        <table class="table table-striped projects">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Фото
                                                </th>
                                                <th>
                                                    Название
                                                </th>
                                                <th>
                                                    Цена
                                                </th>
                                                <th>
                                                    Старая цена
                                                </th>
                                                <th>
                                                    Товар в наличии
                                                </th>
                                                <th>
                                                    Дата добавления
                                                </th>
                                                <th style="width: 30%">
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($products->where('cat_id', $category->id) as $product)
                                                <tr>
                                                    <td>
                                                        <img src="{{ $product->img }}" alt="" width="50px" height="40px">
                                                    </td>
                                                    <td>
                                                        <div class="disabled">
                                                        {{ $product->title }}
                                                        </div>
                                                    </td>
                                                    <form action="{{ route('product.hide', ['product' => $product->id]) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                    <td>
                                                        <input type="text" name="price" class="form-control" id="exampleInputEmail1" placeholder="Введите цену" value="{{ $product->price }}" >
                                                    </td>
                                                    <td>
                                                        <input type="text" name="old_price" class="form-control" id="exampleInputEmail1" placeholder="Введите старую цену" value="{{ $product->old_price }}">
                                                    </td>
                                                    <td>
                                                        <div class="content d-inline-flex">
                                                            <input type="checkbox" class="vertical ml-auto" name="is_hidden" id="hiddenCheckbox{{ $product->id }}" {{ $product->is_hidden ? 'checked' : '' }}>
                                                            <button type="submit" class="btn btn-success btn-sm mr- ml-2">Обновить</button>
                                                        </div>
                                                    </td>

                                                    </form>
                                                    <td>
                                                        {{ $product->created_at }}
                                                    </td>
                                                    <td class="project-actions text-right">
                                                        <a class="btn btn-info btn-sm" href="{{ route('product.edit', ['product' => $product->id]) }}">
                                                            <i class="fas fa-pencil-alt"></i>
                                                            Редактировать
                                                        </a>
                                                        <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm delete-btn" href="#">
                                                                <i class="fas fa-trash"></i>
                                                                Удалить
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        <!-- /.content -->
    </div>
@endsection
