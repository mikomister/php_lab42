<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 29.04.18
 * Time: 23:48
 */

class Month implements IteratorAggregate
{
    private $month;
    private $lastPreviousSunday;

    /**
     * Month constructor.
     * @param $month it's the month number
     */
    public function __construct($month)
    {
        $this->$month = $month;
        $this->$lastPreviousSunday =
    }

    /**
     * Retrieve an external iterator
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator()
    {
        // TODO: Implement getIterator() method.
    }
}