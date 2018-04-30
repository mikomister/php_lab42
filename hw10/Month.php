<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 30.04.18
 * Time: 17:20
 */

class Month implements IteratorAggregate
{
    private $month;
    private $year;
    private $date;

    /**
     * @param string $dayOfWeek
     * @return DateInterval|false
     */
    private function getIntervalFromLastWeekDayOfPreviousMonth(string $dayOfWeek = "Sunday")
    {
        $temp = clone $this->date;
        $date = $temp->sub(new DateInterval("P1M"));
        $date->modify("last $dayOfWeek of this month");
        return date_diff($this->date, $date);
    }

    /**
     * @param int $dayNumber
     * @param int $month
     * @param int $year
     * @return bool
     */
    private function checkExistenceOfDay(int $dayNumber, int $month, int $year)
    {
        if ($month > 1 && $month < 32 && $dayNumber > 0) {
            $days = (new DateTime("$year-$month-01 "))->format("t");
            if ($dayNumber <= $days) return true;
        }
        return false;
    }

    /**
     * @param int $dayNumber
     * @param int|null $month
     * @param int|null $year
     * @return string
     */
    public function getDayOfWeekByDayNumber(int $dayNumber, int $month = null, int $year = null): string
    {
        $month = $month ?? $this->month;
        $year = $year ?? $this->year;
        if ($this->checkExistenceOfDay($dayNumber, $month, $year)) {
            return (new DateTime("$year-$month-$dayNumber"))->format("l");
        }
    }

    /**
     * Month constructor.
     * @param int $month
     * @param int $year
     */
    public function __construct(int $month, int $year)
    {
        $this->month = $month;
        $this->year = $year;
        $this->date = new DateTime("$year-$month-01");
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
        $date = new DateTime("{$this->year}-{$this->month}-01");
        $step = new DateInterval("P1D");
        $iterationsCount = $date->format("t") - 1;
        $monthPeriod = new DatePeriod($date, $step, $iterationsCount);
        foreach ($monthPeriod as $day) {
            $res = "";
            $final = " ";
            if ($day->format("d") == "01") {
                $diff = $this->getIntervalFromLastWeekDayOfPreviousMonth()->days - 1;
//                print_r($diff);
                $res .= str_repeat(" ", $diff * 3);
            }
            if ($day->format("D") == "Sun")
                $final .= "<br>";

            $res .= $day->format("d") . $final;
            yield $res;
        }
    }

    /**
     * @param $m
     * @return string
     */
    private function getMonthName(int $m): string
    {
        return (new DateTime("{$this->year}-{$m}-01"))->format("F");
    }

    /**
     *
     */
    public function showMonth()
    {
        echo "<pre>";
        foreach ($this->getIterator() as $val) {
            echo $val;
        }
        echo "</pre>";
    }

    /**
     *
     */
    public function showCalendar()
    {
        for ($i = 1; $i < 13; $i++) {
            $m = new Month($i, $this->year);
            echo "<br><b>--- {$this->getMonthName($i)} of {$this->year} ---</b><br>";
            $m->showMonth();
        }
    }
}