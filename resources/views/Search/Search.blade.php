<!DOCTYPE html>
<html>
    <body>
        <h1>GoogleBooks商品検索</h1>
        <form id="search_box" action="/search" method="get">
            @csrf
            <p>
                キーワード検索
                <input name="key_word" type="text" placeholder="キーワードを入力">
                <input type="submit" value="検索">
            </p>
        </form>
    </body>
</html>