<?php
/**
 * Created by PhpStorm.
 * User: Манучехр
 * Date: 23.03.2019
 * Time: 0:46
 */
$this->title = 'Решить задачу';
?>
<h3>Выберите слова</h3>
<div id="random-word">
    <?php
    foreach ($words as $word) {
        echo '<a href="#" title="Выбрать" id="code'.$word['word_id'].'" onclick="f(\'code' . $word['word_id'] . '\');">' . mb_strtolower($word['word']) .'</a>';
    }
    ?>
</div>
<div class="choosed-words col-sm-12">
    <span id="answer">

    </span>
</div>

<center><button class="btn btn-success btn_check" id="check-result" data-id="<?= $word['sentence_id'] ?>">Проверить</button></center>

<div id="result">
    
</div>