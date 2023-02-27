<?php
$prefectures = config('prefectures');
?>
@extends('common')
@section('title', '会社編集')
<body>
    <main class="edit-page">
        <div class="container">
            <div class="heading">
                <h1>会社編集</h1>
                <a href="{{ url('companies') }}" class="btn-back">戻る</a>
            </div>
            <form action="" method="POST" class="edit-form">
                @csrf
                <div class="form-items">
                    <div class="item">
                        <h3 class="item-title">ID</h3>
                        <div class="form-wrapper">{{$detail[0]['id']}}</p></div>
                    </div>
                    <div class="item">
                        <h3 class="item-title">会社名</h3>
                        <div class="form-wrapper"><input type="text" name="name" value="{{old('name', $detail[0]['name'])}}"></div>
                    </div>
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item">
                        <h3 class="item-title">担当者</h3>
                        <div class="form-wrapper"><input type="text" name="manager_name" value="{{old('manager_name', $detail[0]['manager_name'])}}"></div>
                    </div>
                    @error('manager_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item">
                        <h3 class="item-title">電話番号<span>(半角)</span></h3>
                        <div class="form-wrapper"><input type="text" name="phone_number" class="tel-input" maxlength="11" value="{{old('phone_number', $detail[0]['phone_number'])}}"></div>
                    </div>
                    @error('phone_number')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item address-items">
                        <h3 class="item-title">住所</h3>
                        <div class="address-item-wrapper">
                            <div class="address-item">
                                <h4>郵便番号<span>(半角)</span></h4>
                                <input type="text" name="postal_code" class="short-input" maxlength="7" value="{{old('postal_code', $detail[0]['postal_code'])}}">
                                <span>(ハイフンなし)</span>
                                <input class="btn-postal btn" type="submit" name="get_address" value="自動入力">
                            </div>
                            <div class="address-item">
                                <h4>都道府県</h4>
                                <select name="prefecture_code">
                                    @for ($i = 1; $i <= 47; $i++)
                                        @if (old('prefecture_code', $detail[0]['prefecture_code']) == $i)
                                            <option value={{$i}} selected>{{$prefectures[$i]}}</option>
                                        @else
                                            <option value={{$i}}>{{$prefectures[$i]}}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="address-item">
                                <h4>市区町村</h4>
                                <input type="text" name="address" value="{{old('address', $detail[0]['address'])}}">
                            </div>
                        </div>
                    </div>
                    @error('postal_code')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    @error('prefecture_code')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    @error('address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item">
                        <h3 class="item-title">メールアドレス</h3>
                        <div class="form-wrapper"><input type="text" name="mail_address" value="{{old('mail_address', $detail[0]['mail_address'])}}"></div>
                    </div>
                    @error('mail_address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <input class="btn btn-form" type="submit" value="更新">
            </form>
        </div>
    </main>
</body>
</html>