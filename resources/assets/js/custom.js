$(function () {
    $('.category-btn').click(function () {
        window.location.href = '/category/' + $('#category').val();
    });

    $('.logo').click(function () {
        window.location.href = '';
    })
});