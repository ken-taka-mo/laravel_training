<?php
require_once('../public/utils/prefectures.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会社編集</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <main class="edit-page">
        <div class="container">
            <div class="heading">
                <h1>会社編集</h1>
                <a href="{{ url('companies') }}" class="btn-back">戻る</a>
            </div>
            <form action="{{ url('companies', $detail[0]['id']) }}" method="POST" class="edit-form">
                @csrf
                <div class="form-items">
                    <div class="item">
                        <h3 class="item-title">ID</h3>
                        <div class="form-wrapper">{{$detail[0]['id']}}</p></div>
                    </div>
                    <div class="item">
                        <h3 class="item-title">会社名</h3>
                        <div class="form-wrapper"><input type="text" name="name" value="{{$detail[0]['name']}}"></div>
                    </div>
                    <div class="item">
                        <h3 class="item-title">担当者</h3>
                        <div class="form-wrapper"><input type="text" name="manager_name" value="{{$detail[0]['manager_name']}}"></div>
                    </div>
                    <div class="item">
                        <h3 class="item-title">電話番号<span>(半角)</span></h3>
                        <div class="form-wrapper"><input type="text" name="phone_number" class="tel-input" maxlength="11" value="{{$detail[0]['phone_number']}}"></div>
                    </div>
                    <div class="item address-items">
                        <h3 class="item-title">住所</h3>
                        <div class="address-item-wrapper">
                            <div class="address-item">
                                <h4>郵便番号<span>(半角)</span></h4>
                                <input type="text" name="postal_code" class="short-input" maxlength="7" value="{{$detail[0]['postal_code']}}">
                                <span>(ハイフンなし)</span>
                                <input class="btn-postal btn" type="submit" name="get_address" value="自動入力">
                            </div>
                            <div class="address-item">
                                <h4>都道府県</h4>
                                <select name="prefecture_code">
                                    @for ($i = 1; $i <= 47; $i++)
                                        @if ($detail[0]['prefecture_code'] == $i)
                                            <option value={{$i}} selected>{{PREFECTURES[$i]}}</option>
                                        @else
                                            <option value={{$i}}>{{PREFECTURES[$i]}}</option>
                                        @endif
                                    @endfor
                                </select>
                            </div>
                            <div class="address-item">
                                <h4>市区町村</h4>
                                <input type="text" name="address" value="{{$detail[0]['address']}}">
                            </div>
                        </div>
                    </div>
                    <div class="item">
                        <h3 class="item-title">メールアドレス</h3>
                        <div class="form-wrapper"><input type="text" name="mail_address" value="{{$detail[0]['mail_address']}}"></div>
                    </div>
                </div>
                <input class="btn btn-form" type="submit" value="更新">
            </form>
        </div>
    </main>
</body>
</html>