@extends('layouts.site')

@section('title', __('What is Studo'))
@section('description', 'Studoは、「プログラミングの勉強時間を記録したい！」「ソースコードをメモしたりまとめておきたい！」そういったニーズに対応するために作られたサービスです。')

@section('content')
    <div class="parallax-container" style="width: 100%;top:-5px">
        <div class="parallax"><img src="{{ asset('images/home_background_code.JPG') }}" style="height: 300%"></div>

        <div class="container">
            <div class="row center">
                <div class="valign-wrapper white-text" style="height: 30vh">
                    <h5>Studoはプログラミングの勉強をサポートするWebサービスで、勉強時間の記録やノート機能の提供をします。<br>また、常に新しい技術や別の解法を追い求める全てのプログラマーに最適なクイズ投稿機能が備わっています。</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row center">
            <h4>主な機能</h4>
        </div>
        <div class="row">
            <div class="col s12 l3 center">
                <i class="material-icons large amber-text text-darken-1">timer</i>
                <h5>タイマー機能</h5>
            </div>
            <div class="col s12 l9">
                <p>言語や教科を選択して時間を計測したり、タイマーで設定した時間だけ勉強することができます。</p>
                <p>記録は履歴として残り、集計され、モチベーションを上げるためのツールとして利用できます。</p>
                <p>また今後、グラフにして視覚的にも分かりやすくするなど、より直感的なインターフェースを実装予定です。</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l3 center">
                <i class="material-icons large amber-text text-darken-1">subject</i>
                <h5>ノート機能</h5>
            </div>
            <div class="col s12 l9">
                <p>ソースコードのメモや、教科別にノートをまとめたい場合に最適な機能です。</p>
                <p>このノートではプレーンテキストの他に、Markdown記法による記述が可能です。コードブロックやメモのためのリスト、データベース設計案の為のテーブルも作成可能です。</p>
                <p>Markdown記法を利用するにあたって特別なことは必要ありません。Markdownで整えて素晴らしく綺麗なノートを作成してみましょう。</p>
            </div>
        </div>
        <div class="row">
            <div class="col s12 l3 center">
                <i class="material-icons large amber-text text-darken-1">rate_review</i>
                <h5>クイズ機能</h5>
            </div>
            <div class="col s12 l9">
                <p>新しい発見を書き残したり復習したりしたいなら、クイズ機能が最適です。</p>
                <p>大かっこ"[ ]"の中に答えを書くことで、その情報が隠された状態で表示されます。</p>
                <p>他の人にもあなたの発見やみんなの知らない新しい技術を共有したい場合も、公開設定をオンにすれば全てのユーザーに共有されます。</p>
                <p>もちろん回答の正解率や挑戦者数を公開しているので、みんながどの問題興味があるのかなども知ることが出来ます。</p>
            </div>
        </div>
    </div>
@endsection