@extends('layouts.app')

@section('content')
<form method="POST" action="/ideas">
    {{ csrf_field() }}
    <table border="1" cellspacing="0" cellpadding="5">
      <tr>
          <th>名前</th>
          <td>
              <input type="text" name="monster_name" require>
          </td>
      </tr>
      <tr>
        <th>タイプ</th>
        <td>
            @foreach($attributes as $abute)
            <input type="checkbox" name="attribute[]" value="{{ $abute }}">{{ $abute }}
            @endforeach
        {{-- <select name="attribute">
          @foreach ($attributes as $abute)
            <option value="{{ $abute }}" >{{ $abute }}</option>
          @endforeach
        </select> --}}
        </td>
      </tr>
      <tr>
        <th>地方</th>
        <td>
        <select name="region">
          @foreach ($regions as $key => $val)
            <option value="{{ $key }}" >{{ $val }}</option>
          @endforeach
        </select>
        </td>
      </tr>
      <tr>
        <th>高さ (m)</th>
        <td>
          <input type="number" step="0.01" name="size" value="1" require>
        </td>
      </tr>
      <tr>
        <th>重さ(kg)</th>
        <td>
          <input type="number" step="0.01" name="weight" value="10" require>
        </td>
      </tr>
      <tr>
        <th>技の名前</th>
        <td>
            @foreach($attacks as $attack)
            <input type="checkbox" name="attack_name" value="{{ $attack->attack_name }}">{{ $attack->attack_name }}
            @endforeach
            {{-- <input type="text" name="attack_name"> --}}
        </td>
      </tr>
      <tr>
        <th>技の説明</th>
        <td>
          <textarea name="attack_description"></textarea>
        </td>
      </tr>
      <tr align="center">
        <td colspan="2">
          <button type="submit" >登録</button>
        </td>
      </tr>
    </table>
  </form>

  <a href="/ideas">戻る</a>
  @endsection
