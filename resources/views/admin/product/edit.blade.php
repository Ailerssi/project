@extends('layouts.admin_layout')

@section('title', 'Редактировать товар')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактировать товар</h1>
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
                <div class="col-lg-12">
                    <div class="card card-primary">
                        <!-- form start -->
                        <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Название</label>
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Введите название товара" value="{{ $product->title }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Выберите категорию</label>
                                    <select name="cat_id" class="form-control" required>
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id }}" {{ $item->id === $product->cat_id ? 'selected' : '' }}>{{ $item->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="is_hidden" class="custom-control-input" id="exampleCheck1" {{ $product->is_hidden ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="exampleCheck1">Есть в наличии.</label>
                                </div>
                                <div class="form-group">
                                    <label>Цена</label>
                                    <input type="text" name="price" class="form-control" placeholder="Введите цену" value="{{ $product->price }}">
                                </div>
                                <div class="form-group">
                                    <label>Старая цена</label>
                                    <input type="text" name="old_price" class="form-control" placeholder="Введите старую цену" value="{{ $product->old_price }}">
                                </div>
                                <div class="form-group">
                                    <label>Краткое описание</label>
                                    <textarea name="little_description" class="editor">{{ $product->little_description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Описание</label>
                                    <textarea name="description" class="editor">{{ $product->description }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Информация</label>
                                    <textarea name="information" class="editor">{{ $product->information }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="feature_image">Текущее изображение</label>
                                    <img src="{{ $product->img }}" alt="" class="img-uploaded" style="display: block" width="300px">
                                    <input class="form-control" name="img" type="text" id="feature_image" name="feature_image" value="{{ $product->img }}" readonly>
                                    <a href="" class="popup_selector" data-inputid="feature_image">Выбрать фото</a>
                                </div>
                            </div>
                            {{--МНОГО ФОТО!!!--}}
                            <div class="container mt-5">

                                <style>
                                    .images-preview-div img
                                    {
                                        padding: 10px;
                                        max-width: 100px;
                                    }
                                </style>

                                <div class="card">

                                    <div class="card-header text-center font-weight-bold">
                                        <h2>Галерея товара</h2>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="file" name="photos[]" id="images" placeholder="Выберите фото" multiple >
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="mt-1 text-center">
                                                    <div class="images-preview-div">
                                                        @foreach($photosArray as $photo)
                                                            <img src="{{ asset('storage/files/products/' . $photo) }}" alt="Photo">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                                <script >
                                    $(function() {
                                        // Multiple images preview with JavaScript
                                        var previewImages = function(input, imgPreviewPlaceholder) {
                                            if (input.files) {
                                                var filesAmount = input.files.length;
                                                for (i = 0; i < filesAmount; i++) {
                                                    var reader = new FileReader();
                                                    reader.onload = function(event) {
                                                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                                                    }
                                                    reader.readAsDataURL(input.files[i]);
                                                }
                                            }
                                        };
                                        $('#images').on('change', function() {
                                            previewImages(this, 'div.images-preview-div');
                                        });
                                    });
                                </script>
                            </div>
                    </div>
                </div>
            </div>
            {{-- КОНЕЦ МНОГО ФОТО!!!--}}

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить изменения</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
