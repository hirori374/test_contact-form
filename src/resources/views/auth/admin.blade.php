<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashionably Late</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gorditas:wght@400;700&family=Inika:wght@400;700&family=Noto+Serif+JP:wght@200..900&display=swap" rel="stylesheet">
</head>
<body>
  <header class="header">
    <div class="header__inner">
      <div class="header-utilities">
        <a href="/" class="header__inner-logo">FashionablyLate</a>
        @if (Auth::check())
        <form action="/logout" method="post" class="logout__button">
          @csrf
            <button class="logout__button-submit">logout</button>
        </form>
        @endif
      </div>
    </div>
  </header>
  <main>
    <div class="admin__content">
      <div class="admin__heading">
        <p>Admin</p>
      </div>
      <form class="search-form" action="?" method="post">
        @csrf
        <div class="search-form__item">
          <input class="search-form__item-input" type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{session('keyword') ?? old('keyword')}}">
          <select name="gender" class="search-form__item-select--gender">
            <option value="">性別</option>
            <option value="1" {{ (old('gender') ?? session('gender')) == '1' ? 'selected' : '' }}>男性</option>
            <option value="2" {{ (old('gender') ?? session('gender')) == '2' ? 'selected' : '' }}>女性</option>
            <option value="3" {{ (old('gender') ?? session('gender')) == '3' ? 'selected' : '' }}>その他</option>
          </select>
          <select name="category_id" class="search-form__item-select--category">
            <option value="">お問い合わせの種類</option>
            @foreach ($categories as $category)
              <option value="{{ $category['id'] }}" @if((session('category_id') ?? old('category_id')) == $category['id']) selected @endif>{{ $category->content }}</option>
            @endforeach
          </select>
          <input type="date" name="created_at" class="search-form__item-date" value="{{ session('created_at') ?? old('created_at') }}">
        </div>
        <div class="search-form__button">
          <button class="search-form__button-submit" formaction="/admin/search" formmethod="post">検索</button>
          <button class="search-form__button-reset" formaction="/admin/reset" formmethod="get">リセット</button>
        </div>
      </form>
      <div class="decoration">
        <div class="export">
          <a href="/admin/export"  class="export__button">エクスポート</a>
        </div>
        <div class="pagination">
          <div class="pagination__inner">
              {{ $contacts->links('vendor.pagination.default') }}
          </div>
        </div>
      </div>
      <div class="admin-table">
        <table class="admin-table__inner">
          <tr class="admin-table__header-row">
            <th class="admin-table__header-text">お名前</th>
            <th class="admin-table__header-text">性別</th>
            <th class="admin-table__header-text">メールアドレス</th>
            <th class="admin-table__header-text">お問い合わせの種類</th>
            <th class="admin-table__header-text"></th>
          </tr>
          @foreach ($contacts as $contact)
          <tr class="admin-table__item-row">
            <td class="admin-table__item">{{ $contact['last_name']}}   {{ $contact['first_name']}}</td>
            <td class="admin-table__item">
            @php
              $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'];
            @endphp
            {{ $genderText[$contact['gender']]}}</td>
            <td class="admin-table__item">{{ $contact['email']}}</td>
            <td class="admin-table__item">{{ $contact->category->content}}</td>
            <td class="admin-table__item">
              <div class="detail-modal__button">
              @php $modalId = 'modal-' . $contact->id; @endphp
                <a class="detail-modal__button-submit" href="#{{ $modalId }}">詳細</a>
              </div>
              <div class="detail-modal" id="{{ $modalId }}">
                <div class="detail-modal__wrapper">
                  <a href="#!" class="close">×</a>
                  <div class="detail-modal__contents">
                    <div class="detail-modal__content">
                      <form class="detail-modal__content-form" action="/delete/{{ $contact->id }}" method="post">
                        @method('DELETE')
                        @csrf
                        <table>
                          <tr>
                            <th>お名前</th>
                            <td>{{ $contact['last_name']}}   {{ $contact['first_name']}}</td>
                          </tr>
                          <tr>
                            <th>性別</th>
                            <td>{{ $genderText[$contact['gender']]}}</td>
                          </tr>
                          <tr>
                            <th>メールアドレス</th>
                            <td>{{ $contact['email']}}</td>
                          </tr>
                          <tr>
                            <th>電話番号</th>
                            <td>{{ $contact['tel']}}</td>
                          </tr>
                          <tr>
                            <th>住所</th>
                            <td>{{ $contact['address']}}</td>
                          </tr>
                          <tr>
                            <th>建物名</th>
                            <td>{{ $contact['building']}}</td>
                          </tr>
                          <tr>
                            <th>お問い合わせの種類</th>
                            <td>{{ $contact->category->content}}</td>
                          </tr>
                          <tr>
                            <th>お問い合わせ内容</th>
                            <td>{{ $contact['detail']}}</td>
                          </tr>
                        </table>
                        <div class="delete__button">
                          <button class="delete__button-submit">削除</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </table>
      </div>
    </div>
  </main>
</body>