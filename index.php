<?php

require_once "reboot.php";


abstract class Block
{
    static private $inc = 0;
    static protected $items = [];
    private $type = 'Label';
    private $name = 'hi';
    private $id = 0;

    protected function __construct( $name )
    {
        $this->type = static::class;
        $this->name = $name ?: $this->type;
        $this->id = self::$inc++;
    }

    static public function create( string $name = null )
    {
        $item = new static( $name );
        self::$items[$item->id] = $item;
        return $item;
    }

    public function __toString()
    {
        return <<<HTML
            <style>
                .lable  {
                    border: 3px solid rgba(0, 0, 0, .1);
                    border-radius: 5px;
                    padding: 10px;
                    margin: 7px;
                    font-family: sans-serif;
                }
                .lable span {
                    color: rgba(0, 0, 0, .5);                    
                    font-weight: bold;
                }
                .lable span+span {
                    color: rgba(0, 0, 100, .9);
                    font-weight: bold;
                }
                .lable__descriptor {
                    font-family: sans-serif, "Courier New";
                    font-weight: bold;
                    font-size: 10px;
                    color: rgba(0, 0, 0, 1);
                }
            </style>
            <div class="lable">
                <span>Тип исполнителя</span>: <span>{$this->type}</span><br>
                <span>Имя</span>: <span>{$this->name}</span><br>
                <span>ID</span>: <span>{$this->id}</span><br>
                <div class="lable__descriptor">[{$this->type}]{$this->name}#{$this->id}</div>
            </div>
HTML;
    }
}

class Actor extends Block
{
}

class Label extends Actor
{
}



$one = Actor::create();
$two = Label::create();


echo $one;
echo $two;
