@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
<div class="confirm-form__content">
    <div class="confirm-form__heading">
        <p>Confirm</p>
    </div>
    <form action="?" method="post" class="form">
        @csrf
        <table class="confirm-table">
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    お名前
                </th>
                <td class="confirm-table__content">
                <input type="text" name="name" value="{{ $contact['last_name']}}   {{ $contact['first_name']}}" readonly />
                <input type="hidden" name="last_name" value="{{ $contact['last_name'] }}">
                <input type="hidden" name="first_name" value="{{ $contact['first_name'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    性別
                </th>
                <td class="confirm-table__content">
                @php
                $genderText = ['1' => '男性', '2' => '女性', '3' => 'その他'];
                @endphp
                <input type="text" value="{{ $genderText[$contact['gender'] ?? ''] ?? '' }}" readonly />
                <input type="hidden" name="gender" value="{{ isset($contact['gender']) ? $contact['gender'] : '' }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    メールアドレス
                </th>
                <td class="confirm-table__content">
                <input type="text" name="email" value="{{ $contact['email']}}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    電話番号
                </th>
                <td class="confirm-table__content">
                <input type="text" name="tel" value="{{ $contact['tel']}}" readonly />
                <input type="hidden" name="tel1" value="{{ $contact['tel1'] }}">
                <input type="hidden" name="tel2" value="{{ $contact['tel2'] }}">
                <input type="hidden" name="tel3" value="{{ $contact['tel3'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    住所
                </th>
                <td class="confirm-table__content">
                <input type="text" name="address" value="{{ $contact['address']}}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    建物名
                </th>
                <td class="confirm-table__content">
                <input type="text" name="building" value="{{ $contact['building']}}" readonly />
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    お問い合わせの種類
                </th>
                <td class="confirm-table__content">
                <input type="text" name="category" value="{{ $category['content']}}" readonly />
                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}">
                </td>
            </tr>
            <tr class="confirm-table__row">
                <th class="confirm-table__label">
                    お問い合わせ内容
                </th>
                <td class="confirm-table__content">
                <textarea name="detail" readonly>{{ $contact['detail'] }}</textarea>
                <input type="hidden" name="detail" value="{{ $contact['detail'] }}">
                </td>
            </tr>
        </table>
        <div class="form__button">
            <button class="form__button--submit" type="submit" formaction="/thanks">送信</button>
            <button class="form__button--correction" type="submit" formaction="/" formmethod="post">修正</button>
        </div>
    </form>
</div>
@endsection