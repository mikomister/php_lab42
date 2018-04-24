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
use \Exeptions\ThirdException;

spl_autoload_register(function ($className) {
    require_once __DIR__ . "/" . str_replace("\\", "/", $className) . ".php";
});

require_once "GenerateExceptions.php";

$ExeptionsGenerator = new GenerateExceptions();

try {
    foreach ($ExeptionsGenerator::LIST_OF_METHODS as $generator) {
        $ExeptionsGenerator->$generator();
    }
} catch (FifthException $e) {
    echo $e;
} catch (FourthException $e) {
    echo $e;
} catch (ThirdException $e) {
    echo $e;
} catch (SecondException $e) {
    echo $e;
} catch (FirstException $e) {
    echo $e;
} catch (\Exception $e) {
    echo $e;
}