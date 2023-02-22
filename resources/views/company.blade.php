<?php
require_once('../public/utils/prefectures.php');
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>会社一覧</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<main class="list">
        <div class="container">
            <div class="heading">
                <h1>会社一覧</h1>
            </div>
            <div class="menu">
                <a class="btn" href="companies/register">新規登録</a>
                <form>
                    <input type="text" class="search-form" name="name">
                    <input class="btn-search" type="submit" value="検索">
                </form>
            </div>
            <div class="table-wrapper">
                <table>
                    <tr class="list-title title">
                        <th class="order t-id">会社番号</th>
                        <th class="t-name">会社名</th>
                        <th class="t-manager">担当者名</th>
                        <th class="t-tel">電話番号</th>
                        <th class="t-address">住所</th>
                        <th class="t-mail">メールアドレス</th>
                        <th class="link">見積一覧</th>
                        <th class="link">請求一覧</th>
                        <th class="link">編集</th>
                        <th class="link">削除</th>
                    </tr>
                    @foreach ($companies as $company)
                    <tr>
                        <td class="t-id">{{$company['id']}}</td>
                        <td class="t-name">{{$company['name']}}</td>
                        <td class="t-manager">{{$company['manager_name']}}</td>
                        <td class="t-tel">{{$company['phone_number']}}</td>
                        <td class="t-address">〒{{substr_replace($company['postal_code'], '-', 3, 0)}}<br>{{PREFECTURES[$company['prefecture_code']]}}{{$company['address']}}</td>
                        <td class="t-mail">{{$company['mail_address']}}</td>
                        <td class="link to-list"><a>見積一覧</a></td>
                        <td class="link to-list"><a>請求一覧</a></td>
                        <td class="link"><a href="{{ url('companies', $company['id']) }}">編集</a></td>
                        <form action="{{url('companies/delete')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$company['id']}}">
                            <td class="link btn-delete"><input type="submit" value="削除"></td>
                        </form>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="page-navigation">
                <a class="next p-nav">次へ<span>&rarr;</span></a>
                <a class="prev p-nav"><span>&larr;</span>前へ</a>
            </div>
        </div>
    </main>
</body>
</html>