@extends('layouts.admin_layout')

@section('title', 'Редактировать статью')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Редактировать статью: {{ $post['title'] }}</h1>
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
                        <form action="{{ route('post.update', $post['id']) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Название</label>
                                    <input type="text" value="{{ $post['title'] }}" name="title" class="form-control" id="exampleInputEmail1" placeholder="Введите название статьи" required>
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Custom Select</label>
                                        <select name="cat_id" class="form-control" required>
                                            @foreach($categories as $item)
                                                <option value="{{ $item['id'] }}" @if($item['id'] == $post['cat_id']) selected @endif>{{ $item['title'] }}</option>
                                            @endforeach
                                        </select>
                                        <div class="form-group">
                                            <textarea name="text" class="editor">{{ $post['text'] }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="feature_image">Текущее изображение</label>
                                            <img src="{{ $post['text'] }}" alt="" class="img-uploaded" style="display: block"; width="300px">
                                            <input class="form-control" name="img" type="text" id="feature_image" name="feature_image" value="{{ $post['img'] }}" readonly>
                                            <a href="" class="popup_selector" data-inputid="feature_image">Выбрать фото</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
