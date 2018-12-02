<?php

namespace shop\dispatchers;


interface EventDispatcher
{
    public function dispatchAll(array $events): void;   //функция для обработки массива событий
    public function dispatch($event): void;             //функция для обработки одного события
}

//Интерфейс EventDispatcher (диспетчер событий). В приложении может быть много разных диспетчеров событий. Все они
//должны будут унаследованы от этого EventDispatcher`a. и переопределять эти два метода. Унаследовавшись от этого
//интерфейса будем создавать уже свои классы - обработчики событий переопределив два метода этого интерфейса.

//Диспетчер событий - это класс, который вызывает (диспетчирирует) срабатывание обработчиков событий. Одного или
// несколько.