var app = (function() {

    // Загрузим конфиг из data/config.json
    var config = {};

    var ui = {
        $body: $('body'),
        //$menu: $('#menu'),
        $pageTitle: $('#page-title'),
        $content: $('#content')
    };

    // Загрузка контента по странице
    function _loadContent(link) {
        var url = document.location.origin + link;
            //pageTitle = config.pages[page].title,
           // menu = config.pages[link].menu;

        $.get(url, function(data) {
            var data = JSON.parse(data);
            document.title = data.title;
            //ui.$menu.find('a').removeClass('active');
            //ui.$menu.find('a[data-menu="' + menu + '"]').addClass('active');
            //ui.$pageTitle.html(pageTitle);

            ui.$content.html(data.html);
            $('.form-token').clone().appendTo('form[method="post"]');
           // $('form[method="post"]').clone().prepend($('input[name="form-token"]'));
        });


        console.log('loaded');
    }

    // Клик по ссылке
    function _navigate(e) {
        e.stopPropagation();
        e.preventDefault();

        var link = $(e.target).attr('href');


        _loadContent(link);
        history.pushState({page: link}, '', link);
    }

    // Кнопки Назад/Вперед
    function _popState(e) {
        var page = (e.state && e.state.page) || '';

        _loadContent(page);
    }

    // Привязка событий
    function _bindHandlers() {
        ui.$body.on('click', 'a[data-link="ajax"]', _navigate);
        window.onpopstate = _popState;
    }

    // Старт приложения: привязка событий
    function _start() {
        _bindHandlers();
    }

    // Инициализация приложения: загрузка конфига и старт
    function init() {
        $.getJSON('/json/config', function(data) {
            config = data;
            _start();
        });
    }

    // Возвращаем наружу
    return {
        init: init
    }
})();

// Запуск приложения
$(document).ready(app.init);
$('form[method="post"]').prepend($('.form-token'));
$('form[method="post"]').on("submit", function () {

    //console.log("Submit"+$(this).serialize());

    var formData = new FormData($(this)[0]);
    formData.append("form-token", $('input.form-token').val());
    console.log(formData.get("form-token"));
    $.ajax({
        processData: false,
        contentType: false,
        type: "POST",
        url: $(this).attr("data-url"),
        data: formData,

        success: function (response) {
            console.log(response);

        },

        error: function (xhr, str) {

        }


    });

});