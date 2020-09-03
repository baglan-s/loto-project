$(function () {
    $('.category-btn').click(function () {
        window.location.href = '/category/' + $('#category').val();
    })
});