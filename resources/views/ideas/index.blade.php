@extends('layouts.app')

@section('content')
    <br />
    <h3>{{ $user->name }}のポケモンページ</h3>
    <br />

  <form action="/ideas">
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
        <th>タイプ</th>
        <td>
            @foreach($attributes as $abute)
            <input type="checkbox" name="attribute[]" value="{{ $abute }}" @if(request('attribute') && in_array($abute, request('attribute'))) checked @endif /> {{ $abute }}
            @endforeach
        </td>
      </tr>
      <tr>
        <th>地方</th>
        <td>
            @foreach($regions as $key => $val)
            <input type="checkbox" name="region[]" value="{{ $key }}" @if(request('region') && in_array($key, request('region'))) checked @endif /> {{ $val }}
            @endforeach
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit">検索</button>
          <button type="button" onclick="location.href='/ideas'">リセット</button>
        </td>
      </tr>
    </table>
  </form>

  <br/>
  <button type="button" onclick="location.href='/ideas/create'">新しくポケモンを作る</button>
  <br/>

  <br/>
  <h4>{{ $user->name }}のポケモン &nbsp; 表示中 {{ $pf['total'] }}体 / 全 {{ $count }}体</h4>

  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>名前</th>
      <th>タイプ</th>
      <th>地方</th>
      <th>高さ</th>
      <th>重さ</th>
      {{-- <th>技の名前</th>
      <th>技の説明</th> --}}
      <th colspan="3"></th>
    </tr>
    @foreach($ideas as $idea)
      <tr>
        <td align="center">{{ $idea->monster_name }}</td>
        <td align="center">
        <?php
        $attribute_array = explode(",", $idea->attribute);
        // var_dump($attribute_array);
        ?>
        @foreach($attribute_array as $abute)
        <p>{{ $abute }} &nbsp;</p>
        @endforeach
        </td>
        <td align="center">{{ $regions[$idea->region] }}</td>
        <td align="center">{{ $idea->size }}cm</td>
        <td align="center">{{ $idea->weight }}kg</td>
        {{-- <td align="center">{{ $idea->attack_name }}</td>
        <td align="center">{{ $idea->attack_description }}</td> --}}
        <td><button type="button" onclick="location.href='ideas/{{ $idea->id }}'">見る</button></td>
        <td><button type="button" onclick="location.href='ideas/{{ $idea->id }}/edit'">編集</button></td>
        <td valign="middle">
            <form action="/ideas/{{ $idea->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </td>
      </tr>
    @endforeach
  </table>

  <br />
  {{ $ideas->links() }}

  <br/>
  <a href="/allideas">みんなのポケモンを見る</a>
@endsection
