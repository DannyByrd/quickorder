$(document).ready(function () {

    var array_shop = ['shop_city', 'shop_street', 'shop_house_number'];
    var array_client = ['client_city', 'client_street', 'client_house_number'];

    $('input[type=radio][name="Address[address_type]"]').change(function () {
        if (this.value == '0') {

            itemHideShow(array_client, 'none');
            itemHideShow(array_shop, 'block');
        }
        else if (this.value == '1') {

            itemHideShow(array_shop, 'none');
            itemHideShow(array_client, 'block');

        }
    });

    /**
     * Задает значение видимости для элемента
     * @param $array - массив с элементами на сранице
     * @param $prop - свойство элемента none/block
     */
    function itemHideShow($array, $prop) {
        $array.forEach(function (item, i, arr) {
            $('div[class*=' + item + ']').css({'display': $prop});
        });
    }

    /**
     *  Посылает данные с формы к валидатору actionValidateAddress
     *  И показывает результат на странице
     */
    $('body').on('beforeSubmit', 'form#make_order_form', function () {


        var form = $(this);

        $.ajax({
            'type': 'POST',
            url: '/ajax/validate-address',
            data: form.serialize(),
            dataType: 'json',
            success: function (json) {
                ValidateAjaxErrors(form, json);

            }

        });

        return false;

    });

    /**
     * Показывает или убирает пользовательские ошибки с формы
     * @param form - выбранная форма для валидации
     * @param json - результат валидатора actionValidateAddress
     */
    function ValidateAjaxErrors(form, json) {


        $('p.help-block-error').each(function (i) {

            $cur_p = $(this);
            $id_obj = $(this).prev().attr('id');
            if (json.hasOwnProperty($id_obj)) {
                $($cur_p).html(json[$id_obj]);
            } else {
                $($cur_p).html(' ');
            }

        });


    }


});//$(document).ready(function()