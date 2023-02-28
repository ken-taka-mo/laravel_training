<?php
$prefectures = config('prefectures');
?>
@extends('layout.common')
@section('title', '会社一覧')
@section('contents')
    <main class="list">
        <div class="container">
            <div class="heading">
                <h1>会社一覧</h1>
            </div>
            <div class="menu">
                <a class="btn" href="{{route('companies.create')}}">新規登録</a>
                <form action="" method="GET">
                    <input type="text" class="search-form" name="name" value={{$name}}>
                    <input class="btn-search" type="submit" value="検索">
                    <a  class="btn-back clear" href="{{url('companies')}}">条件クリア</a>
                </form>
            </div>
            <div class="table-wrapper">
                @if ($companies->total())
                <table>
                    <tr class="list-title title">
                        @if ($order)
                            <th class="order t-id"><a href="{{route('companies.index', ['name' => $name])}}">会社番号 ▼</a></th>
                        @else
                            <th class="order t-id"><a href="{{route('companies.index', ['order' => 'desc', 'name' => $name])}}">会社番号 ▲</a></th>
                        @endif
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
                        <td class="t-address">〒{{substr_replace($company['postal_code'], '-', 3, 0)}}<br>{{$prefectures[$company['prefecture_code']]}}{{$company['address']}}</td>
                        <td class="t-mail">{{$company['mail_address']}}</td>
                        <td class="link to-list"><a>見積一覧</a></td>
                        <td class="link to-list"><a>請求一覧</a></td>
                        <td class="link"><a href="{{ route('companies.edit', $company['id']) }}">編集</a></td>
                        <form action="{{route('companies.destroy', $company['id'])}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{$company['id']}}">
                            <td class="link btn-delete"><input type="submit" value="削除"></td>
                        </form>
                    </tr>
                    @endforeach
                </table>
                @else
                    @include('layout.nodata')
                @endif
            </div>
            {{$companies->appends(['order' => $order, 'name' => $name])->links()}}
        </div>
    </main>
@endsection