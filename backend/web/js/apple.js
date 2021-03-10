// настройка плагина contextMenu
$.contextMenu.types.label = function(item, opt, root) {
    $('<span>Укажите цвет:<ul>'
        + '<li class="label1" title="label 1" data-color="red">label 1'
        + '<li class="label2" title="label 2" data-color="green">label 2'
        + '<li class="label3" title="label 3" data-color="blue">label 3'
        + '<li class="label4" title="label 4" data-color="yellow">label 4'
        + '<li class="label5" title="label 5" data-color="orange">label 5'
        + '<li class="label6" title="label 6" data-color="maroon">label 6')
        .appendTo(this)
        // действие при выборе цвета яблока
        .on('click', 'li', function() {
            appleColor =  ( $(this).data('color') );
            $.ajax({
                url: "/apple/generate",
                data: {color: appleColor},
                success: function(res) {
                    var appleProperties = JSON.parse(res);
                    $('.apple-tree-group').append(
                        '<div class="apple" data-id="'+ appleProperties.id +'"'
                        + 'style="background:' + appleProperties.color + '"></div>'
                    );
                }
            });

            root.$menu.trigger('contextmenu:hide');
        });
    this.addClass('labels').on('contextmenu:focus', function(e) {
    }).on('contextmenu:blur', function(e) {
    }).on('keydown', function(e) {
    });
};

// привязка плагина contextMenu к кнопке "Вырастить яблоко"
$.contextMenu({
    selector: '#apple-generate',
    trigger: 'left',
    items: {
        label: {type: "label", customName: "label"}
    }
});

// привязка плагина contextMenu к яблокам на дереве
$.contextMenu({
    selector: '.apple',
    trigger: 'left',
    items: {
        fall: {
            name: "Уронить",
            disabled: false,
            callback: function(key, opt) {
                var apple = this;
                var appleId = $(apple).data('id');
                $.ajax({
                    url: "/apple/fall",
                    data: {id: appleId},
                    success: function(color) {
                        console.log (color);
                        // анимация падения яблока
                        var apOfTop = $(apple).offset().top;
                        var apOfLeft = $(apple).offset().left;
                        $(apple).css('position', 'fixed');
                        $(apple).offset({top:apOfTop, left:apOfLeft});
                        $(apple).animate({
                                top: '+600',
                                opacity: 0
                            },
                            500,
                            function() {
                                $(apple).remove();
                                $('.apple-ground-group').append(
                                    '<div class="apple-on-ground" data-id="'+ appleId +'"'
                                    + 'style="background:' + color + '"></div>'
                                );
                            }
                        );
                    }
                });

            }
        },
        eat: {
            name: "Откусить",
            disabled: true,
            callback: function(key, opt) {}
        }
    }
});