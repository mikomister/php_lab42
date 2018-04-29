<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 21:40
 */

use \Exceptions\FifthException;
use \Exceptions\FirstException;
use \Exceptions\FourthException;
use \Exceptions\SecondException;
use \Exceptions\ThirdException;

class GenerateExceptions
{

    const LIST_OF_EXEPTIONS = [
        0 => FirstException::class,
        1 => SecondException::class,
        2 => ThirdException::class,
        3 => FourthException::class,
        4 => FifthException::class
    ];

    private function GetAnotherException(int $prev)
    {
        $rnd = random_int(0, 4);
        while ($rnd == $prev) {
            $rnd = random_int(0, 4);
        }
        $ex = self::LIST_OF_EXEPTIONS[$rnd];
        throw new $ex();
    }

    public function FirstGenerator()
    {
        try {
            $rnd = random_int(0, 4);
            $ex = self::LIST_OF_EXEPTIONS[$rnd];
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {
            $this->GetAnotherException($rnd);
        }
    }

    public function SecondGenerator()
    {
        try {
            $rnd = random_int(0, 4);
            $ex = self::LIST_OF_EXEPTIONS[$rnd];
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {
            $this->GetAnotherException($rnd);
        }
    }

    public function ThirdGenerator()
    {
        try {
            $rnd = random_int(0, 4);
            $ex = self::LIST_OF_EXEPTIONS[$rnd];
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {
            $this->GetAnotherException($rnd);
        }
    }

    public function FourthGenerator()
    {
        try {
            $rnd = random_int(0, 4);
            $ex = self::LIST_OF_EXEPTIONS[$rnd];
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {
            $this->GetAnotherException($rnd);
        }
    }
}