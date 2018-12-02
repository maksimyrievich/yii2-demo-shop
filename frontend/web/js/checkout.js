$(document).ready(function(){

//*************************************************************************************
//************************ Задаем начальное положение элементов ***********************
//*************************************************************************************
    //Скрываем панель "Таблица товаров".
    $(".panel-one").hide();
    //Устанавливаем галочку "yes"
    $(".accordion-one .symb").addClass('yes');
    //Скрываем панель "Выбор доставки".
    $(".panel-three").hide();
    //Скрываем панель "Способ оплаты".
    $(".panel-four").hide();
    $("div#two").addClass('panel-danger');
    $("div#three").addClass('panel-danger');
    $("div#four").addClass('panel-danger');
    $('.field-customerform-country').addClass('required ');
    $('.field-customerform-town').addClass('required');
    $('.field-customerform-townru').addClass('required');
    $('.field-customerform-imya').addClass('required');
    $('.field-customerform-street').addClass('required');
    $('.field-customerform-index').addClass('required');
    $('.field-customerform-indexru').addClass('required');
    $('.field-customerform-phone').addClass('required');

    //Если в поле страна выбрана Россия, то...
    if($("#customerform-country").val() === 'RU'){
        //Скрываем поле "Город" для других стран
        $('.field-customerform-town').hide().addClass('has-success');
        //Показываем поле "Город" для России
        $('.field-customerform-townru').show();
        //Скрываем поле "Индекс" для других стран
        $('.field-customerform-index').hide().addClass('has-success');
    }else{  // иначе...
        //Скрываем поле "Город" для России
        $('.field-customerform-townru').hide();
        //Показываем поле "Город" для других стран
        $('.field-customerform-town').show();
        //Скрываем поле "Индекс" для России
        $('.field-customerform-indexru').hide();
        //Показываем поле "Индекс" для других стран
        $('.field-customerform-index').show();
    } //end if...

    //Скрываем и плавно раскрываем панель "Адрес доставки"
    $('.panel-two').hide().show("slow");

//*************************************************************************************************************
//************************************* Блок обработчиков событий "click" *************************************
//*************************************************************************************************************

    //Событие "click" по заголовку панели "Таблица товаров"
    $('.accordion-one').click(function (){
        //Если панель скрыта, то...
        if ($('.panel-one').is(":hidden")) {
            //Закрываем панель "Способ доставки"
            $('.panel-three').hide("slow");
            //Закрываем панель "Адрес доставки"
            $('.panel-two').hide("slow");
            //Закрываем панель "Способ оплаты"
            $('.panel-four').hide("slow");
            //Открываем панель "Таблица товаров"
            $('.panel-one').show("slow");
        }else{
            //Закрываем панель "Таблица товаров"
            $('.panel-one').hide("slow");
            if (!($('div#two').is('.panel-success'))){
                //Открываем панель "Адрес доставки"
                $('.panel-two').show("slow");
            }else if(!($('div#three').is('.panel-success'))){
                //Открываем панель "Способ доставки"
                $('.panel-three').show("slow");
            }else if(!($('div#four').is('.panel-success'))) {
                //Открываем панель "Способ доставки"
                $('.panel-four').show("slow");
            }
        }
    });

    //Событие "click" по заголовку панели "Адрес доставки"
    $('.accordion-two').click(function (){
        //Если панель скрыта, то...
        if ($('.panel-two').is(":hidden")) {
            //Закрываем панель "Таблица товаров"
            $('.panel-one').hide("slow");
            //Закрываем панель "Способ доставки"
            $('.panel-three').hide("slow");
            //Закрываем панель "Способ оплаты"
            $('.panel-four').hide("slow");
            //Открываем панель "Адрес доставки"
            $('.panel-two').show("slow");
        }else {
            if($('div#two').is('.panel-success')){
                //Закрываем панель "Адрес доставки"
                $('.panel-two').hide("slow");
                if(!($('div#three').is('.panel-success'))){
                    //Открываем панель "Способ доставки"
                    $('.panel-three').show("slow");
                }else if(!($('div#four').is('.panel-success'))) {
                    //Открываем панель "Способ доставки"
                    $('.panel-four').show("slow");
                }
            }
        }
    });

    //Событие "click" по заголовку панели "Способ доставки"
    $('.accordion-three').click(function (){
        //Если панель скрыта, то...
        if ($('.panel-three').is(":hidden")) {
            //Закрываем панель "Таблица товаров"
            $('.panel-one').hide("slow");
            //Закрываем панель "Адрес получателя"
            $('.panel-two').hide("slow");
            //Закрываем панель "Способ оплаты"
            $('.panel-four').hide("slow");
            //Открываем панель "Адрес доставки"
            $('.panel-three').show("slow");
        }else {
            if($('div#three').is('.panel-success')){
                //Закрываем панель "Адрес доставки"
                $('.panel-three').hide("slow");
                //Открываем панель "Способ доставки"
                $('.panel-four').show("slow");
            }
        }
    });















    //Событие "click" кнопки "Продолжить" блока "Адрес доставки". Теперь отправим нашу форму с помощью AJAX
    $('#customerform-submit.btn-one').on('click', function(e){
        qwery(e);
    });

    //Событие "click" кнопки "Продолжить" блока "Cпособ доставки".
    $('#customerform-submit.btn-two').on('click', function(e){
        //Если количество выбранных элементов меньше одного
        if($("input:radio:checked").length < 1) {
            $('input.radio').addClass('radio-error');
        }else {
        //Закрываем панель "Адрес доставки"
            $('.panel-three').hide("slow");
            $(".accordion-three .symb").addClass('yes');
            $("div#three").addClass('panel-success');
            //Выставляем зелёненький цвет панели
            $("div#three").removeClass('panel-danger');
            //Открываем панель "Способ оплаты"
            $('.panel-four').show("slow");
        }
    });



//************************************************************************************************************
//************************************** Блок обработчиков событий "change" - изменение поля *****************
//************************************************************************************************************

    //Событие "change" поля "Фамилия Имя Отчество"
    $('input#customerform-imya').change( function(){
        //Валидируем поле "Фамилия Имя Отчество"
        validateImya();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        //Удаляем зелененький цвет панели
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Фамилия Имя Отчество"

    //Событие "change" поля "Страна".
    $("#customerform-country").change(function() {
        //Валидируем поле "Страна"
        validateCountry();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        //Удаляем зелененький цвет панели
        $("div#two").removeClass('panel-success');
        //Выставляем розовенький цвет панели
        $("div#two").addClass('panel-danger');
        //Если страна Россия, то
        if ('RU' === $("#customerform-country").val()) {
            let a = $('.field-customerform-town');
            //Скрываем поле "Город" для других стран
            a.hide().removeClass('has-error');
            //Показываем поле "Город" для России
            $('.field-customerform-townru').removeClass('has-error has-success').show();
            //Удаляем сообщение под полем "Город" для других стран
            $('input#customerform-town').next('.help-block').text('');
            //Скрываем поле "Индекс" для других стран
            $('.field-customerform-index').hide();
            //Показываем поле "Индекс" для России
            $('.field-customerform-indexru').removeClass('has-error has-success').show();
            //Удаляем сообщение под полем "Индекс" для других стран
            $('.field-customerform-indexru .help-block').text('');
        } else {
            //Удаляем сообщение под полем "Город" для других стран
            $('input#customerform-town').next('.help-block').text('');
            //Скрываем поле "Город" для России
            $('.field-customerform-townru').hide();
            //Показываем поле "Город" для других стран
            $('.field-customerform-town').removeClass('has-error has-success').show();
            //Скрываем поле "Индекс" для России
            $('.field-customerform-indexru').hide();
            //Удаляем сообщение под полем "Индекс" для других стран
            $('input#customerform-index').next('.help-block').text('');
            //Показываем ввод индекса для других стран
            $('.field-customerform-index').removeClass('has-error has-success').show();
        }
    }); //конец обработчика события "change" поля "Страна".

    //Событие "change" поля "Город или Населенный пункт, Район" для других стран
    $('input#customerform-town').change( function(){
        //Валидируем поле "Город или Населенный пункт, Район"
        validateTown();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Город или Населенный пункт, Район"

    //Событие "change" поля "Индекс" для России
    $('select#customerform-townru').change('select2:close', function(){
        //Валидируем поле "Индекс" для России
        validateTownru();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Индекс" для России

    //Событие "change" поля "Улица дом квартира"
    $('input#customerform-street').change( function(){
        //Валидируем поле "Улица дом квартира"
        validateStreet();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Улица дом квартира"

    //Событие "change" поля "Индекс" для России
    $('select#customerform-indexru').change('select2:close', function(){
        //Валидируем поле "Индекс" для России
        validateIndexru();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Индекс" для России

    //Событие "change" поля "Индекс" для других стран
    $('input#customerform-index').change( function(){
        //Валидируем поле "Индекс" для других стран
        validateIndex();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Индекс" для других стран

    //Событие "change" поля "Телефон получателя"
    $('input#customerform-phone').change( function(){
        //Валидируем поле "Телефон получателя"
        validateRecipientphone();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Телефон получателя"
}); //конец $(document).ready()

//**********************************************************************************************************
//***************************** Блок функций валидации полей формы "Адрес доставки" ************************
//**********************************************************************************************************

function validateCountry(string = false) {
    let a = $('select#customerform-country');
    let b = $('.field-customerform-country');
    if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        a.next('.help-block').text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateTown(string = false) {
    let a = $('input#customerform-town');
    let b = $('.field-customerform-town');
    if(!(a.val().length < 255)){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('\"Город\" должен быть меньше 255 символов');
        if(string){ return 'max'; }else { return false; }
    }else if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        a.next('.help-block').text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateTownru(string = false) {
    let a = $('select#customerform-townru');
    let b = $('.field-customerform-townru');
    let c = $('.field-customerform-townru .help-block');
    if(!(a.val().length < 255)){
        b.addClass('has-error');
        b.removeClass('has-success');
        c.text('\"Город\" должен быть не более 255 символов');
        if(string){ return 'max'; }else { return false; }
    }else if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        c.text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        c.text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateStreet(string = false) {
    let a = $('input#customerform-street');
    let b = $('.field-customerform-street');

    if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else if(!(a.val().length < 255)){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно быть меньше 255 символов');
        if(string){ return 'max'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        a.next('.help-block').text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateIndex(string = false) {
    let a = $('input#customerform-index');
    let b = $('.field-customerform-index');
    if(!(a.val().length < 7)){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('\"Индекс\" должен быть не более 6 символов');
        if(string){ return 'max'; }else { return false; }
    }else if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        a.next('.help-block').text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateIndexru(string = false) {
    let a = $('select#customerform-indexru');
    let b = $('.field-customerform-indexru');
    let c = $('.field-customerform-indexru .help-block');
    if(!(a.val().length < 7)){
        b.addClass('has-error');
        b.removeClass('has-success');
        c.text('\"Индекс\" должен быть не более 6 символов');
        if(string){ return 'max'; }else { return false; }
    }else if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        c.text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        c.text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateImya(string = false) {
    let a = $('input#customerform-imya');
    let b = $('.field-customerform-imya');
    if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно быть заполнено');
        if(string){ return 'empty'; }else { return false; }
    }else if(a.val().length <= 7){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('Поле должно иметь больше 7 символов');
        if(string){ return 'min'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        a.next('.help-block').text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function validateRecipientphone(string = false) {
    let a = $('input#customerform-phone');
    let b = $('.field-customerform-phone');
    let c = $('.field-customerform-phone .help-block');
    if (a.val() === '') {
        b.addClass('has-error');
        b.removeClass('has-success');
        c.text('\"Телефон\" должен быть заполнен');
        if(string){ return 'empty'; }else { return false; }
    }else if(a.val().length <= 10){
        b.addClass('has-error');
        b.removeClass('has-success');
        c.text('\"Телефон\" должен быть больше 10 символов');
        if(string){ return 'min'; }else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        c.text('');
        if(string){ return 'okay'; }else { return true; }
    }
}

function qwery(e){
    // Запрещаем стандартное поведение для кнопки "Продолжить".
    e.preventDefault();
    validateCountry();  //Валидируем поле "Страна"
    validateStreet();   //Валидируем поле "Улица дом квартира"

    if ('RU' === $("#customerform-country").val()) {
        validateIndexru();  //Валидируем поле "Индекс" для России
        validateTownru();   //Валидируем поле "Город" для России
        $('.field-customerform-index').removeClass('has-error').addClass('has-success');
        $('.field-customerform-town').removeClass('has-error').addClass('has-success');
    }else{ //иначе
        $('.field-customerform-indexru').removeClass('has-error').addClass('has-success');
        $('.field-customerform-townru').removeClass('has-error').addClass('has-success');
        validateIndex();    //Валидируем поле "Индекс"
        validateTown();     //Валидируем поле "Город" для других городов
    }
    validateImya();     //Валидируем поле "Фамилия Имя Отчество"
    validateRecipientphone();   //Валидируем поле "Телефон получателя"
    // После того, как мы нажали кнопку "Отправить", делаем проверку,
    // если кол-во полей с классом .has-success равно 10 - все поля заполнены верно,
    console.log($('.has-success').length);
    if($('.has-success').length === 8)
    {
        // Eще одним моментом является то, что в качестве данных для передачи аяксом в контроллер, мы
        // у нашей формы вызываем метод .serialize().
        // Это очень удобно, т.к. он возвращает строку с именами и значениями выбранных элементов формы.
        // Выполняем наш Ajax сценарий и отправляем форму в контроллер
        $.ajax({
            url: "/shop/checkout/send",
            type: 'post',
            data: $('form#customer-form').serialize(),
            dataType: 'json',
            success: function(jsondata){

                $(".accordion-two").next(".panel-two").hide("slow");
                $(".accordion-three").next(".panel-three").show("slow");
                $(".accordion-two .symb").addClass('yes');
                $("div#two").addClass('panel-success');
                //Выставляем синенький цвет панели
                $("div#two").removeClass('panel-danger');
                let a = jsondata.russianpost.Отправления.ЦеннаяПосылка.Доставка + Number.parseInt(jsondata.russianpost.Отправления.ЦеннаяПосылка.НаложенныйПлатеж);
                $('#nazemnaya_posilka_price').text(jsondata.russianpost.Отправления.ЦеннаяПосылка.Доставка);
                $('#nazemnaya_posilka_time').text(jsondata.russianpost.Отправления.ЦеннаяПосылка.СрокДоставки);
                $('#naloj_platej_price').text(a);
                $('#naloj_platej_time').text(jsondata.russianpost.Отправления.ЦеннаяПосылка.СрокДоставки);
            }
        }); // end ajax({...})
    }else{  // Иначе, если количество полей с данным классом не равно значению 10, то...
        //Возвращаем false, останавливаем отправку сообщения невалидной формы
        return false;
    }
}; // конец обработчика события "click" кнопки "Продолжить"