//ボタン押下時の遷移先を変更
$('.submit').click(function() {
    $(this).parents('form').attr('action', $(this).data('action'));
    $(this).parents('form').submit();
});

//必須入力チェック
function validate() {
    //新規追加ボタンをクリック時に未入力の場合、エラー
    if (document.todo_list.text.value == "") {
        alert("登録内容が未入力です。入力してください。");
        return false;
    }
    return true;
};
