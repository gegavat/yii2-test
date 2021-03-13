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
                        + 'data-color="'+ appleProperties.color +'"'
                        + 'data-created_at="'+ appleProperties.created_at +'"'
                        + 'style="background:' + appleProperties.color + '"></div>'
                    );
                    // location.reload();
                    $('#btn_pjax_apple').click();
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

// при нажатии на яблоко на дереве сохраняем элемент
var selApple;
$('.apple-tree-group').on('click', '.apple', function() {
    selApple = this;
});

// при закрытии модального окна просмотра свойств яблока
$('#apple-properties-modal').on('hidden.bs.modal', function (e) {
    $('.apple-prop-color').empty();
    $('.apple-prop-status').empty();
    $('.apple-prop-created_at').empty();
});

// привязка плагина contextMenu к яблокам на дереве
$.contextMenu({
    selector: '.apple',
    trigger: 'left',
    items: {
        properties: {
            name: "Свойства яблока",
            callback: function(key, opt) {
                // открытие модального окна просмотра свойств яблока
                var appColor = $(selApple).data('color');
                var appCreatedAt = $(selApple).data('created_at');
                $('#apple-properties-modal').modal('show');
                $('.apple-prop-color').append(appColor.toUpperCase());
                $('.apple-prop-color').css('color', appColor);
                $('.apple-prop-status').append("На дереве");
                $('.apple-prop-created_at').append(new Date(appCreatedAt * 1000));
            }
        },
        fall: {
            name: "Уронить",
            disabled: false,
            callback: function(key, opt) {
                var apple = this;
                var appleId = $(apple).data('id');
                $.ajax({
                    url: "/apple/fall",
                    data: {id: appleId},
                    success: function(res) {
                        var appleProperties = JSON.parse(res);
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
                                    + 'data-color="'+ appleProperties.color +'"'
                                    + 'data-created_at="'+ appleProperties.created_at +'"'
                                    + 'data-fallen_at="'+ appleProperties.fallen_at +'"'
                                    + 'data-status="on_ground"'
                                    + 'data-residue="'+ appleProperties.residue +'"'
                                    + 'style="background:' + appleProperties.color + '"></div>'
                                );
                                // location.reload();
                            }
                        );
                    }
                });

            }
        },
        eat: {
            name: "Откусить",
            disabled: true
        }
    }
});

// при нажатии на яблоко на земле сохраняем элемент
var selGrApple;
$('.apple-ground-group').on('click', '.apple-on-ground', function() {
    selGrApple = this;
});

// при закрытии модального окна просмотра свойств яблока с земли
$('#apple_on_ground-properties-modal').on('hidden.bs.modal', function (e) {
    $('.apple_on_ground-prop-color').empty();
    $('.apple_on_ground-prop-status').empty();
    $('.apple_on_ground-prop-created_at').empty();
    $('.apple_on_ground-prop-fallen_at').empty();
    $('.apple_on_ground-prop-residue').empty();
});

// привязка плагина contextMenu к яблокам на земле
$.contextMenu({
    selector: '.apple-on-ground',
    trigger: 'left',
    items: {
        properties: {
            name: "Свойства яблока",
            callback: function(key, opt) {
                // открытие модального окна просмотра свойств яблока
                var grAppColor = $(selGrApple).data('color');
                console.log (grAppColor);
                var grAppCreatedAt = $(selGrApple).data('created_at');
                var grAppFallenAt = $(selGrApple).data('fallen_at');
                var grAppStatus = $(selGrApple).data('status');
                var grAppResidue = $(selGrApple).data('residue');
                $('#apple_on_ground-properties-modal').modal('show');
                $('.apple_on_ground-prop-color').append(grAppColor.toUpperCase());
                $('.apple_on_ground-prop-color').css('color', grAppColor);
                grAppStatus === 'on_ground' ? $('.apple_on_ground-prop-status').append("На земле") : $('.apple_on_ground-prop-status').append("Испортилось");
                $('.apple_on_ground-prop-created_at').append(new Date(grAppCreatedAt * 1000));
                $('.apple_on_ground-prop-fallen_at').append(new Date(grAppFallenAt * 1000));
                $('.apple_on_ground-prop-residue').append(grAppResidue);
            }
        },
        fall: {
            name: "Уронить",
            disabled: true
        },
        eat: {
            name: "Откусить",
            callback: function(key, opt) {
                // открытие модального окна поедания яблока
                $('#apple-eat-modal output').empty();
                var grAppId = $(selGrApple).data('id');
                var grAppResidue = $(selGrApple).data('residue');
                $('#apple-eat-modal').modal('show');
                $('#apple-eat-modal input[type="range"]').val(grAppResidue);
                $('#apple-eat-modal output').append(grAppResidue);
            }
        }
    }
});

// действие при откусывании яблока
$('.eat-apple-btn').on('click', function() {
    if ( $(selGrApple).data('status') === 'spoiled' ){
        alert ('Яблоко уже испортилось');
        return false;
    }
    $.ajax({
        url: "/apple/eat",
        data: {
            id: $(selGrApple).data('id'),
            piece: $('#apple-eat-modal input[type="range"]').val()
        },
        success: function(residue) {
            $(selGrApple).attr('data-residue', residue);
            $(selGrApple).empty();
            $(selGrApple).append("<div class='eated-piece' style='margin-left:" + residue + "%'></div>");
            $('#apple-eat-modal').modal('hide');
            // location.reload();
        }
    });
});

// отображение откушенной части яблока
$('.apple-on-ground').each(function( index ) {
    var residue = $(this).data('residue');
    $(this).append("<div class='eated-piece' style='margin-left:" + residue + "%'></div>")
});

