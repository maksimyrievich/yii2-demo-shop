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
    $("div#two").addClass('panel-danger');
    $("div#three").addClass('panel-danger');
    $('.field-customerform-country').addClass('required ');
    $('.field-customerform-choice').addClass('has-success');
    $('.field-customerform-email').addClass('required');
    $('.field-customerform-phone').addClass('required');
    $('.field-customerform-imya').addClass('required');
    $('.field-customerform-street').addClass('required');
    $('.field-customerform-indexru').addClass('required');

    //Если установлена галочка в поле "Отправить другу", то...
    if($('#customerform-choice').is(':checked')){
        //Показываем поле "Телефон получателя заказа"
        $('.field-customerform-recipientphone').show();
    }else{  // иначе...
        //Скрываем ввод "Телефон получателя заказа"
        $('.field-customerform-recipientphone').hide().addClass('required has-success');
    } //end if...

    //Если в поле страна выбрана Россия, то...
    if($("#customerform-country").val() === 'RU'){
        //Скрываем поле "Город" для других стран
        $('.field-customerform-town').hide().addClass('required has-success');
        //Скрываем поле "Индекс" для других стран
        $('.field-customerform-index').hide().addClass('required has-success');
    }else{  // иначе...
        //Скрываем поле "Индекс" для России
        $('.field-customerform-indexru').hide();
        //Показываем поле "Город" для других стран
        $('.field-customerform-town').show();
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
            //Открываем панель "Адрес доставки"
            $('.panel-two').show("slow");
        }else {
            if($('div#two').is('.panel-success')){
                //Закрываем панель "Адрес доставки"
                $('.panel-two').hide("slow");
                //Открываем панель "Способ доставки"
                $('.panel-three').show("slow");
            }
        }
    });

    //Событие "click" кнопки "Продолжить". Теперь отправим нашу форму с помощью AJAX
    $('#customerform-submit').click(function(e){
        // Запрещаем стандартное поведение для кнопки "Продолжить".
        e.preventDefault();

        validateEmail();    //Валидируем поле "Емайл"
        validatePhone();    //Валидируем поле "Телефон покупателя"
        validateImya();     //Валидируем поле "Фамилия Имя Отчество"
        validateCountry();  //Валидируем поле "Страна"
        validateStreet();   //Валидируем поле "Улица дом квартира"

        if ('RU' === $("#customerform-country").val()) {
            validateIndexru();  //Валидируем поле "Индекс" для России
            $('.field-customerform-index').removeClass('has-error').addClass('has-success');
            $('.field-customerform-town').removeClass('has-error').addClass('has-success');
        }else{ //иначе
            $('.field-customerform-indexru').removeClass('has-error').addClass('has-success');
            validateIndex();    //Валидируем поле "Индекс"
            validateTown();     //Валидируем поле "Город"
        }

        if($('#customerform-choice').is(':checked')){
            validateRecipientphone();   //Валидируем поле "Телефон получателя"
        }else {
            $('.field-customerform-recipientphone').removeClass('has-error').addClass('has-success');
        }
        // После того, как мы нажали кнопку "Отправить", делаем проверку,
        // если кол-во полей с классом .has-success равно 10 - все поля заполнены верно,
        console.log($('.has-success').length);
        if($('.has-success').length === 10)
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

                    console.log(jsondata);
                    if(jsondata.form.error.all){
                        if(jsondata.form.error.email.bool){
                            $('input#customerform-email').next('.help-block').text(jsondata.form.error.email.text);
                            $('.field-customerform-email').removeClass('has-success').addClass('has-error');}
                        if(jsondata.form.error.phone.bool){
                            $('.field-customerform-phone .help-block').text(jsondata.form.error.phone.text);
                            $('.field-customerform-phone').removeClass('has-success').addClass('has-error');}
                    }else {
                        $('#conte').html();
                        $(".accordion-two").next(".panel-two").hide("slow");
                        $(".accordion-three").next(".panel-three").show("slow");
                        $(".accordion-two .symb").addClass('yes');
                        $("div#two").addClass('panel-success');
                        //Выставляем синенький цвет панели
                        $("div#two").removeClass('panel-danger');
                    }
                }
            }); // end ajax({...})
        }else{  // Иначе, если количество полей с данным классом не равно значению 10, то...
            //Возвращаем false, останавливаем отправку сообщения невалидной формы
            return false;
        }
    }); // конец обработчика события "click" кнопки "Продолжить"

//************************************************************************************************************
//************************************** Блок обработчиков событий "change" **********************************
//************************************************************************************************************

    //Событие "change" поля "Отправить другу".
    $('input#customerform-choice').change( function(){
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        //Удаляем зелененький цвет панели
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
        //Если галочка "Отправить другу" не установлена, то...
        if(!$('#customerform-choice').is(':checked')){
            //Скрываем поле "Телефон получателя заказа"
            $('.field-customerform-recipientphone').hide('slow');
    }else{ //Если галочка установлена, то...
            //Валидируем поле и если поле пустое, то
            if ('empty' === validateRecipientphone(true)){
                //Удаляем класс "error" в поле "Телефон получателя заказа"
                $('.field-customerform-recipientphone').removeClass('has-error');
                //Удаляем сообщение под полем "Телефон получателя заказа"
                $('.field-customerform-recipientphone .help-block').text('');}
            //Отображаем поле "Телефон получателя заказа"
            $('.field-customerform-recipientphone').show('slow');}
    }); //конец обработчика события "change" поля "Отправить другу".

    //Событие "change" поля "Ваш емайл"
    $('input#customerform-email').change( function(){
        //Валидируем поле "Ваш емайл"
        validateEmail();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        //Удаляем зелененький цвет панели
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Ваш емайл"

    //Событие "change" поля "Ваш телефон"
    $('input#customerform-phone').change( function(){
        //Валидируем поле "Ваш телефон"
        validatePhone();
        //Удаляем галочку "yes"
        $(".accordion-two .symb").removeClass('yes');
        //Удаляем зелененький цвет панели
        $("div#two").removeClass('panel-success');
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
    }); //конец обработчика события "change" поля "Ваш телефон"

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
        //Выставляем синенький цвет панели
        $("div#two").addClass('panel-danger');
        //Если страна Россия, то
        if ('RU' === $("#customerform-country").val()) {
            let a = $('.field-customerform-town');
            //Скрываем поле "Город" для других стран
            a.hide('slow').removeClass('has-error').addClass('has-success');
            //Удаляем сообщение под полем "Город" для других стран
            $('input#customerform-town').next('.help-block').text('');
            //Скрываем поле "Индекс" для других стран
            $('.field-customerform-index').hide().addClass('required has-success');

            $('.field-customerform-indexru .help-block').text('');
            //Показываем поле "Индекс" для России
            $('.field-customerform-indexru').removeClass('has-error has-success').show();
        } else {
            //Удаляем сообщение под полем "Город" для других стран
            $('input#customerform-town').next('.help-block').text('');
            //Показываем поле "Город" для других стран
            $('.field-customerform-town').removeClass('has-error has-success').show('slow');
            //Скрываем поле "Индекс" для России
            $('.field-customerform-indexru').hide().addClass('required has-success');

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
    $('input#customerform-recipientphone').change( function(){
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

function validateEmail(string = false) {
    let a = $('input#customerform-email');
    let b = $('.field-customerform-email');
    let c = /^([a-z0-9_\.-])+@[a-z0-9-]+\.([a-z]{2,4}\.)?[a-z]{2,4}$/i;
    if(a.val() === ''){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('\"Емайл\" должен быть заполнен');
        if(string){ return 'empty'; }else { return false; }
    }else if(a.val().length <= 6){
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('\"Емайл\" должен быть больше 6 символов');
        if(string){ return 'min'; }else { return false; }
    }else if(!(c.test(a.val()))) {
        b.addClass('has-error');
        b.removeClass('has-success');
        a.next('.help-block').text('\"Емайл\" должен быть емайл-адресом');
        if (string) { return 'email'; } else { return false; }
    }else{
        b.addClass('has-success');
        b.removeClass('has-error');
        a.next('.help-block').text('');
        if(string){ return 'okay'; }else { return false; }
    }
}

function validatePhone(string = false) {
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

function validateRecipientphone(string = false) {
    let a = $('input#customerform-recipientphone');
    let b = $('.field-customerform-recipientphone');
    let c = $('.field-customerform-recipientphone .help-block');
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