<?php

namespace shop\dispatchers;

class DeferredEventDispatcher implements EventDispatcher
{
    private $defer = false;     //переменная хранящая флаг разрешения, запрещения выполнения событий
    private $queue = [];        //переменная хранящая массив отложенных событий до их релиза
    private $next;              //переменная в которой хранится сам диспетчер событий

    public function __construct(EventDispatcher $next) //В конструктор передаем SimpleEventDispatcher
    {
        //Грузим в переменную $next диспетчер событий
        $this->next = $next;
    }

    public function dispatchAll(array $events): void
    {
        foreach ($events as $event) {   //В цикле проходим по всему массиву событий
            $this->dispatch($event);    //и вызываем метод dispatch() передавая в него конкретное событие из массива
        }
    }

    public function dispatch($event): void
    {
        if ($this->defer) {                 //Если свойство defer установлено в true
            $this->queue[] = $event;        //в массив queue[] грузим событие
        } else {                            //иначе
            $this->next->dispatch($event);  //вызываем выполение обработчика события у переданного в конструктор
                                            //диспетчера событий SimpleEventDispatcher
        }
    }

    public function defer(): void
    {
        $this->defer = true;                //Флаг defer устанавливаем в true
    }

    public function clean(): void
    {
        $this->queue = [];                  //Сбрасываем все события
        $this->defer = false;               //Сбрасываем флаг defer - запрет запуска обработчиков событий
    }

    public function release(): void
    {
        foreach ($this->queue as $i => $event) {
            $this->next->dispatch($event);
            unset($this->queue[$i]);
        }
        $this->defer = false;
    }
}

//Класс  DeferredEventDispatcher представляет собой диспетчер событий, который в своем составе реализует расширенный
//функционал в отличие от простого диспетчера событий. В частности, методы defer, clean, release. Позволяющие отложить
//выполнение обработчиков события до какого то момента (релиза).

//Что здесь делается? В свой конструктор DeferredEventDispatcher.
//принимается обычный диспетчер событий. Далее, DeferredEventDispatcher переопределяет методы dispatchAll и dispatch
//таким образом, что если приватное свойство $defer установлено в true, то при вызове, например, метода dispatch() события
//не выполняются, а загружаются в приватное свойство $queue. При вызове метода dispatchAll() то же самое. А вот вызвав
//метод release() все события выполняются.

//Этот класс DeferredEventDispatcher по сути является "оберткой" над обычным SimpleEventDispаtcher`ом и используется
//менеджером транзакций TransactionManager.php для возможности откатить выполнение событий при неудачном выполнении
//какого то действия в транзакции.