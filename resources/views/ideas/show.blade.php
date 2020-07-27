@extends('layouts.app')

@section('content')
@foreach($ideas as $idea)
  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>名前</th>
      <th>タイプ</th>
      <th>地方</th>
      <th>高さ</th>
      <th>重さ</th>
      <th colspan="2"></th>
    </tr>
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
        <td><button type="button" onclick="location.href='ideas/{{ $idea->id }}/edit'">編集</button></td>
        <td valign="middle">
            <form action="/ideas/{{ $idea->id }}" method="POST" style="display:inline">
                @csrf
                @method('DELETE')
                <button type="submit">削除</button>
            </form>
        </td>
      </tr>
  </table>
@break
@endforeach

<br />
<p>覚えている技</p>
  <table border="1" cellspacing="0" cellpadding="5">
    <tr align="center">
      <th>技の名前</th>
      <th>技の説明</th>
      <th colspan="2"></th>
    </tr>
    @foreach($ideas as $idea)
      <tr>
        <td align="center">{{ $idea->attack_name }}</td>
        <td align="center">{{ $idea->attack_description }}</td>
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



  <br/>
  <a href="/allideas">みんなのポケモンを見る</a>
@endsection
