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

spl_autoload_register(function ($className) {
    require_once __DIR__ . "/" . str_replace("\\", "/", $className) . ".php";
});

$ExceptionsGenerator = new GenerateExceptions();
$ExceptionsGeneratorMethods = get_class_methods($ExceptionsGenerator);

foreach ($ExceptionsGeneratorMethods as $generator) {
    try {
        $ExceptionsGenerator->$generator();
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
    } finally {
        echo "<br>";
    }
}


