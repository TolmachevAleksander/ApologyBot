<?php


$a = 1;                                                                                        // Номер страницы.

while ($a <= 42) {                                                                             // Цикл для прохождения всех страниц.
    $url = ('http://pozdravok.ru/pozdravleniya/lyubov/izvineniya/'.$a.'.htm');                 // Ссылка на сайт с извинениями.
    $out = file_get_contents($url);                                                            // Перевод страницы в строку.
    $description = iconv('WINDOWS-1251', 'UTF-8', $out);                                       // Преобразование строки в кодировку WINDOWS-1251
    preg_match_all('/sfst">.+?<\/p>/', $description, $text);                                   // Применяем регулярное выражение.
    $AllApologys = $text[0];                                                                   // Получаем массив с извинениями.
    foreach ($AllApologys as $arr){                                                            // Запускаем цикл с перебором всех извинений.
	    preg_match_all('/[^sfstbrp><\/"&anclquo=;]+/', $arr, $text2);                          // Регулярным выражением удаляем ненужные символы.
	    $apology = implode("\n", $text2[0]);                                                   // Преобразуем элементы массива в строку.
	    exec('/usr/bin/php /.../bot/bot.php "'.$apology.'"');                      			   // Отправляем извинение с сайта (Linux).
        sleep(900);                                                                            // Останавливаем скрипт на 15 мин.
    }
    $a++;                                                                                      // Переходим на следующую страницу.
}
