var getChecked = function () {
    var checked = []
    $("input[name='box']:checked").each(function () {
      checked.push(parseInt($(this).val()));
    });
    return checked;
}