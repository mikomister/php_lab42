<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> Php Tasks | Konkov Michael</title>
    <link href="https://fonts.googleapis.com/css?family=Squada+One" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
</head>
<body>
<main>

    <!--  Test -->
    <!--    <div class="task">-->
    <!--        <a href="/Test.php">Test</a>-->
    <!--    </div>-->

    <!-- Task 10 -->
    <div class="task">
        <a class="linkToTask" href="./hw10/Task10.php">Task 10 | Календарь с перебором </a>
    </div>

    <!-- Task 9 -->
    <div class="task">
        <a class="linkToTask" href="./hw9/Task9.php">Task 9 | Разруливание ошибок </a>
    </div>

    <!-- Task 8 -->
    <div class="task">
        <h2 class="h2-task">Task 8 | Logger </h2>
        <form name=Logger method="POST" action="hw8/Task8.php">
            <textarea name="textToLog" id="sort" cols="30" rows="10">TECT
test
тест
ТесТ
тесТ
Привет
покА</textarea>
            <div class="b-log-panel">
                <h2>Выберите способ логирования</h2>
                <select id="logger" name="logger"
                        onchange="toFile.classList.toggle('show'); toBrowser.classList.toggle('show');" required>
                    <option value="toFile">Log results to File</option>
                    <option value="toBrowser" selected>Log results to Browser</option>
                </select>
                <div id="toBrowser" class="show">
                    <h3>Не обязательно:</h3>
                    <label><input name="timeFormat" type="radio" value="0">Показывать время</label>
                    <label><input name="timeFormat" type="radio" value="1">Показывать дату и время</label>
                </div>

                <div id="toFile">
                    <h3>Введите имя файла(не обязательно):</h3>
                    <input type="text" name="filename" placeholder="Name of txt file...">
                </div>
            </div>

            <input type="submit" value="Check it!">
        </form>
    </div>

    <!-- Task 7 -->
    <div class="task">
        <h2 class="h2-task">Task 7 | check URL</h2>
        <form name=checkURL method="POST" action="hw7/Task7.php">
            <input type="text" id="checkURL" name="URL" placeholder="google.com" required>
            <label><input type="checkbox" name="ping" value="true"> Ping</label>
            <label><input type="checkbox" name="tracert" value="true"> Tracert</label>
            <input type="submit" value="Check it!">
        </form>
    </div>

    <!-- Task 6  -->
    <div class="task">
        <a class="linkToTask" href="./hw6/Task6.php">Task 6 | Parse INI file</a>
    </div>

    <!-- Task 5 -->
    <div class="task">
        <h2 class="h2-task">Task 5 | Password check</h2>
        <form name="checkpass">
            <input type="text" name="password" id="pswd" placeholder="Write your password..." required>
            <div id="errorsArea"></div>
            <input type="submit" value="Check it!" onclick="checkPassword(); return false;">
        </form>
    </div>

    <!-- Task 4 -->
    <div class="task">
        <h2 class="h2-task">Task 4 | Show JSON</h2>
        <form action="/hw4/Task4.php" method="POST">
                <textarea name="strsToJSON" id="sort" cols="30" rows="10">Bad guys allways lose 35
Happy birthday mister president 11
We promote our programme aim and activities 54
Quantum computing is computing using quantum-mechanical phenomena, such as superposition and entanglement 99</textarea>
            <input type="submit" value="Get JSON">
        </form>
    </div>

    <!-- Task 3 -->
    <div class="task">
        <h2 class="h2-task">Task 3 | Non-standard sorting</h2>
        <form action="/hw3/Task3.php" method="POST">
                <textarea name="strsToSort" id="sort" cols="30" rows="10">Bad guys allways lose
Happy birthday mister president</textarea>
            <input type="submit" value="Отсортировать по 2 слову">
        </form>
    </div>

    <!-- Task 2  -->
    <div class="task">
        <a class="linkToTask" href="./hw2/Task2.php">Task 2 | helo replacer</a>
    </div>

    <!-- Task 1 -->
    <div class="task">
        <h2 class="h2-task">Task 1 | Brainfuck</h2>
        <form action="/hw1/Task1.php" method="POST" name="brainfuck">
            <textarea name="code" class="area" id="" cols="30" rows="10">Дефолт</textarea>
            <input type="text" name="params" placeholder="Параметры">
            <input type="submit" value="Interpretate it!">
        </form>
    </div>

</main>

<script type="text/javascript">


    //Task5
    function AddNotice(msg, type) {
        errorsArea.innerHTML += `<p class='notice ${type}'>${msg}</p>`;
    }

    function CleanNotice() {
        errorsArea.innerHTML = '';
    }

    function checkPassword() {
        CleanNotice();
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/hw5/Task5.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        //Так не работает wtf!? 
        // var formData = new FormData(document.forms.checkpass);
        // xhr.send(formData);
        xhr.send(`password=${pswd.value}`);

        xhr.onload = function () {
            var errorsCount = 0;
            var response = JSON.parse(xhr.responseText);
            for (var key in response)
                if (response[key][0]) {
                    AddNotice(response[key][1], "error");
                    errorsCount++;
                }
            if (errorsCount == 0) AddNotice("It\'s a valid password", "valid")
        }
    }
</script>
</body>
</html>