@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
<div class="contact-form__content">
    <div class="contact-form__heading">
        <p>Contact</p>
    </div>
    <form action="/confirm" method="post" class="form">
    @csrf
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お名前</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                  <div class="form__input--name">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ session('contact.last_name') ?? old('last_name')}}">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ session('contact.first_name') ?? old('first_name')}}">
                  </div>
                </div>
                <div class="form__error">
                    @error('last_name')
                    {{ $message }}
                    @enderror
                </div>
                <div class="form__error">
                    @error('first_name')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">性別</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--radio">
                    <label class="radio-label">
                        <input type="radio" name="gender" class="radio-input" value="1" {{ old('gender', session('contact.gender',1)) == 1 ? 'checked' : '' }} checked>
                        <span class="radio-custom"></span>男性
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" class="radio-input" value="2" {{ old('gender', session('contact.gender')) == 2 ? 'checked' : '' }}>
                        <span class="radio-custom"></span>女性
                    </label>
                    <label class="radio-label">
                        <input type="radio" name="gender" class="radio-input" value="3" {{ old('gender', session('contact.gender')) == 3 ? 'checked' : '' }}>
                        <span class="radio-custom"></span>その他
                    </label>
                </div>
                <div class="form__error">
                    @error('gender')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">メールアドレス</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="email" placeholder="例: test@example.com" value="{{ session('contact.email') ?? old('email')}}">
                </div>
                <div class="form__error">
                    @error('email')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">電話番号</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--tel">
                  <div class="form__input--text">
                    <input type="tel" name="tel1" placeholder="080" value="{{ session('contact.tel1') ?? old('tel1')}}">
                  </div>
                  <span>-</span>
                  <div class="form__input--text">
                    <input type="tel" name="tel2" placeholder="1234" value="{{ session('contact.tel2') ?? old('tel2')}}">
                  </div>
                  <span>-</span>
                  <div class="form__input--text">
                    <input type="tel" name="tel3" placeholder="5678" value="{{ session('contact.tel3') ?? old('tel3')}}">
                  </div>
                </div>
                <div class="form__error">
                    @error('tel')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">住所</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ session('contact.address') ?? old('address')}}">
                </div>
                <div class="form__error">
                    @error('address')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">建物名</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--text">
                    <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ session('contact.building') ?? old('building')}}">
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせの種類</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--select">
                    <select name="category_id">
                        <option value="" placeholder="選択してください">選択してください
                        </option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" @if((session('contact.category_id') ?? old('category_id')) == $category['id']) selected @endif>
                            {{ $category['content'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="form__error">
                    @error('category_id')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="form__group">
            <div class="form__group-title">
                <span class="form__label--item">お問い合わせ内容</span>
                <span class="form__label--required">※</span>
            </div>
            <div class="form__group-content">
                <div class="form__input--textarea">
                    <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ session('contact.detail') ?? old('detail')}}</textarea>
                </div>
                <div class="form__error">
                    @error('detail')
                    {{ $message }}
                    @enderror
                </div>
            </div>
        </div>

        <div class="form__button">
            <button class="form__button-submit" type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection