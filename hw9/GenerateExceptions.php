<?php
/**
 * Created by PhpStorm.
 * User: Michael Konkov
 * Date: 23.04.18
 * Time: 21:40
 */

use \Exeptions\FifthException;
use \Exeptions\FirstException;
use \Exeptions\FourthException;
use \Exeptions\SecondException;
use \Exeptions\ThirdException;

class GenerateExceptions
{
    const LIST_OF_EXEPTIONS = [
        0 => FirstException::class,
        1 => SecondException::class,
        2 => ThirdException::class,
        3 => FourthException::class,
        4 => FifthException::class
    ];

    const LIST_OF_METHODS = [
        0 => "FirstGenerator",
        1 => "SecondGenerator",
        2 => "ThirdGenerator",
        3 => "FourthGenerator",
    ];

    private function GetAnotherException(int $prev): int
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
        $rnd = random_int(0, 4);
        $ex = self::LIST_OF_EXEPTIONS[$rnd];
        try {
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {

            $this->GetAnotherException($rnd);
        }
    }

    public function SecondGenerator()
    {
        $rnd = random_int(0, 4);
        $ex = self::LIST_OF_EXEPTIONS[$rnd];
        try {
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {

            $this->GetAnotherException($rnd);
        }
    }

    public function ThirdGenerator()
    {
        $rnd = random_int(0, 4);
        $ex = self::LIST_OF_EXEPTIONS[$rnd];
        try {
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {

            $this->GetAnotherException($rnd);
        }
    }

    public function FourthGenerator()
    {
        $rnd = random_int(0, 4);
        $ex = self::LIST_OF_EXEPTIONS[$rnd];
        try {
            throw new $ex();
        } catch (Exception $e) {
            echo $e;
        } finally {

            $this->GetAnotherException($rnd);
        }
    }
}