<?php
require_once('../public/utils/prefectures.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会社登録</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <main class="create-page">
        <div class="container">
            <div class="heading">
                <h1>会社登録</h1>
                <a href="{{url('companies')}}" class="btn-back">戻る</a>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="form-items">
                    <div class="item">
                        <h3 class="item-title">会社名</h3>
                        <div class="form-wrapper"><input type="text" name="name" value="{{ old('name') }}"></div>
                    </div>
                    @error('name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item">
                        <h3 class="item-title">担当者</h3>
                        <div class="form-wrapper"><input type="text" name="manager_name" value="{{ old('manager_name') }}"></div>
                    </div>
                    @error('manager_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item">
                        <h3 class="item-title">電話番号</h3>
                        <div class="form-wrapper"><input type="text" name="phone_number" class="tel-input" maxlength="11" value="{{ old('phone_number') }}"></div>
                    </div>
                    @error('phone_number')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item address-items">
                        <h3 class="item-title">住所</h3>
                        <div class="address-item-wrapper">
                            <div class="address-item">
                                <h4>郵便番号</h4>
                                <input type="text" name="postal_code" class="short-input" maxlength="7" value="{{ old('postal_code') }}">
                                <span>(ハイフンなし)</span>
                                <input class="btn-postal btn" type="submit" name="get_address" value="自動入力">
                            </div>
                            <div class="address-item">
                                <h4>都道府県</h4>
                                <select name="prefecture_code">
                                    <option value="">選択してください</option>
                                    @for ($i = 1; $i <= 47; $i++)
                                        @if ($i ==  old('prefecture_code'))
                                            <option value={{$i}} selected>{{PREFECTURES[$i]}}</option>
                                        @else
                                            <option value={{$i}}>{{PREFECTURES[$i]}}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="address-item">
                                <h4>市区町村</h4>
                                <input type="text" name="address" value="{{ old('address') }}">
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
                        <div class="form-wrapper"><input type="text" name="mail_address" value="{{ old('mail_address') }}"></div>
                    </div>
                    @error('mail_address')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <div class="item">
                        <h3 class="item-title">プレフィックス</h3>
                        <div class="form-wrapper"><input type="text" name="prefix" class="short-input" maxlength="8" value="{{ old('prefix') }}"><span class="prefix-span">(半角8桁以下)</soan></div>
                    </div>
                    @error('prefix')
                        <p class="error">{{ $message }}</p>
                    @enderror
                </div>
                <input class="btn btn-form" type="submit" name="register" value="新規登録">
            </form>
        </div>
    </main>
</body>
</html>