<?php
    
    class Errors
    {
        public $eLength = array( 0 => false, 1 => "Длина пароля должна быть не менее 10 символов" ); 
        public $e2LowerLatin = array( 0 => false, 1 => "Пароль должен содержать хотя бы 2 латинских символа в нижнем регистре" ); 
        public $e2UpperLatin = array( 0 => false, 1 => "Пароль должен содержать хотя бы 2 латинских символа в верхнем регистре" ); 
        public $e2Digits = array( 0 => false, 1 => "Пароль должен содержать хотя бы 2 цифры" ); 
        public $e2SpecialsSymbols = array( 0 => false, 1 => "Пароль должен содержать хотя бы 2 спец. символа из %, $, #, _, *" ); 
        public $e3Symbols = array( 0 => false, 1 => "Пароль не должен содержать более чем 3 цифр или латинских(в верхнем/нижнем регистре) или спец. символов подряд" ); 
    }

    $password = $_POST['password'];


    function check_password(string $arg)
    {
        $errors = new Errors();

        $errors->eLength[0] = !(bool)preg_match('/(?:.{10,})/s', $arg);
        $errors->e2LowerLatin[0] = !(bool)preg_match('/(?:[a-z]{1})(.*)(?:[a-z]{1})/s', $arg);
        $errors->e2UpperLatin[0] = !(bool)preg_match('/(?:[A-Z]{1})(.*)(?:[A-Z]{1})/s', $arg);
        $errors->e2Digits[0] = !(bool)preg_match('/(?:[0-9]{1})(.*)(?:[0-9]{1})/s', $arg);
        $errors->e2SpecialsSymbols[0] = !(bool)preg_match('/(?:[%$#_*]{1})(.*)(?:[%$#_*]{1})/s', $arg);
        $errors->e3Symbols[0] = (bool)preg_match('/(?:[0-9]{4})|(?:[A-Z]{4})|(?:[a-z]{4})|(?:[%$#_*]{4})/s', $arg);

        return json_encode($errors);
    }

    if(isset($password)) echo check_password($password);

    // print_r($_POST);
