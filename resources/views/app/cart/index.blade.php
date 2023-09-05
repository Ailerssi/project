@extends('layouts.index')
@section('title', 'Корзина')
@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/cart_responsive.css')}}">
    <script src="{{asset('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>

@endsection

@section('content')
    <div class="cart_info">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Column Titles -->
                    <div class="cart_info_columns clearfix">
                        <div class="cart_info_col cart_info_col_product">Продукт</div>
                        <div class="cart_info_col cart_info_col_price">Цена</div>
                        <div class="cart_info_col cart_info_col_quantity">Кол-во</div>
                        <div class="cart_info_col cart_info_col_total">Всего</div>
                    </div>
                </div>
            </div>

                @if(auth()->check())
                @foreach($cartItems as $item)
                <div class="row cart_items_row">
                    <div class="col" id="{{$item->id}}">>
                        <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                            <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                                <div class="cart_item_image">
                                    <div><img src="{{$item->img}}" alt=""></div>
                                </div>
                                <div class="cart_item_name_container">
                                    <div class="cart_item_name"><a href="{{ route('show_product', ['product' => $item->product_id]) }}">{{ $item->title }}</a></div>
                                </div>
                            </div>
                            <!-- Price -->
                            <div class="cart_item_price">$ {{ $item->new_price }}</div>
                            <!-- Quantity -->
                            <div class="cart_item_quantity">
                                <div class="product_quantity_container">
                                    <div class="product_quantity clearfix">
                                        <span>Кол-во</span>
                                        <input class="quantity_input" type="text" value="{{ $item->qty }}" data-product-id="{{ $item->id }}" data-product-price="{{ $item->new_price }}">
                                        <div class="quantity_buttons">
                                            <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                            <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Total -->
                            <div class="cart_item_total">0</div>
                        </div>

                    </div>
                </div>
            @endforeach
            @else
                    @if(isset($_COOKIE['cart_id']))

                    @foreach($items as $item)
                        <div class="row cart_items_row">
                            <div class="col" id="{{$item->id}}">>
                                <div class="cart_item d-flex flex-lg-row flex-column align-items-lg-center align-items-start justify-content-start">
                                    <div class="cart_item_product d-flex flex-row align-items-center justify-content-start">
                                        <div class="cart_item_image">
                                            <div><img src="{{$item->attributes['img']}}" alt=""></div>
                                        </div>
                                        <div class="cart_item_name_container">
                                            <div class="cart_item_name"><a href="{{ route('show_product', ['product' => $item->id]) }}">{{ $item->name }}</a></div>
                                        </div>
                                    </div>
                                    <!-- Price -->
                                    <div class="cart_item_price">$ {{ $item->price }}</div>
                                    <!-- Quantity -->
                                    <div class="cart_item_quantity">
                                        <div class="product_quantity_container">
                                            <div class="product_quantity clearfix">
                                                <span>Кол-во</span>
                                                <input class="quantity_input" type="text" value="{{ $item->quantity }}" data-product-id="{{ $item->id }}" data-product-price="{{ $item->price }}">
                                                <div class="quantity_buttons">
                                                    <div id="quantity_inc_button" class="quantity_inc quantity_control"><i class="fa fa-chevron-up" aria-hidden="true"></i></div>
                                                    <div id="quantity_dec_button" class="quantity_dec quantity_control"><i class="fa fa-chevron-down" aria-hidden="true"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Total -->
                                    <div class="cart_item_total">0</div>
                                </div>

                            </div>
                        </div>
                    @endforeach
                    @endif
            @endif

            <div class="row row_cart_buttons">
                <div class="col">
                    <div class="cart_buttons d-flex flex-lg-row flex-column align-items-start justify-content-start">
                        <div class="button continue_shopping_button"><a href="/">Продолжить покупки</a></div>
                        <div class="cart_buttons_right ml-lg-auto">
                            <div class="button clear_cart_button"><a href="{{ route('clearCart') }}">Очистить корзину</a></div>
                            <div class="button update_cart_button"><a href="#">Обновить корзину</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row_extra">
                <div class="col-lg-4">

                    <!-- Delivery -->
                    <div class="delivery">
                        <div class="section_title">Метод доставки</div>
                        <div class="section_subtitle">Выберите один из вариантов</div>
                        <div class="delivery_options">
                            <label class="delivery_option clearfix">На след. день
                                <input class="radio_in_cart" type="radio" name="radio" value="4.99">
                                <span class="checkmark"></span>
                                <span class="delivery_price">$4.99</span>
                            </label>
                            <label class="delivery_option clearfix">Стандартная доставка
                                <input class="radio_in_cart" type="radio" name="radio" value="1.99">
                                <span class="checkmark"></span>
                                <span class="delivery_price">$1.99</span>
                            </label>
                            <label class="delivery_option clearfix">Самовывоз
                                <input class="radio_in_cart" type="radio" checked="checked" name="radio" value="0">
                                <span class="checkmark"></span>
                                <span class="delivery_price">Бесплатно</span>
                            </label>
                        </div>
                    </div>

                    <!-- Coupon Code -->
                    {{--<div class="coupon">
                        <div class="section_title">Купон</div>
                        <div class="section_subtitle">Отправить купон</div>
                        <div class="coupon_form_container">
                            <form action="#" id="coupon_form" class="coupon_form">
                                <input type="text" class="coupon_input" required="required">
                                <button class="button coupon_button"><span>Отправить</span></button>
                            </form>
                        </div>
                    </div>--}}
                </div>

                <div class="col-lg-6 offset-lg-2">
                    <div class="cart_total">
                        <div class="section_title">Корзина всего</div>
                        <div class="section_subtitle">Финальная информация</div>
                        <div class="cart_total_container">
                            <ul>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title" >Сумма товаров</div>
                                    <div class="cart_total_value ml-auto" id="price_total"></div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_value">Доставка</div>
                                    <div class="cart_total_value ml-auto" id="delivery">Бесплатно</div>
                                </li>
                                <li class="d-flex flex-row align-items-center justify-content-start">
                                    <div class="cart_total_title">Всего</div>
                                    <div class="cart_total_value ml-auto" id="items_total"></div>
                                </li>
                            </ul>
                        </div>
                        @if(auth()->check())
                            <form action="{{ route('order.create') }}" method="POST">
                                @csrf
                                <div class="button checkout_button" onclick="submitForm()"><a type="">Заказать</a></div>
                                <button type="submit" id="hidden-submit" style="display: none;"></button>
                            </form>
                        @else
                            <div class="button checkout_button"><a href="/register">Заказать</a></div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<script>
    // JavaScript функция для отправки формы при клике на div
    function submitForm() {
        // Используем JavaScript для имитации клика на скрытой submit-кнопке
        document.getElementById('hidden-submit').click();
    }
</script>





