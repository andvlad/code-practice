<?php require_once("header.php"); ?>

    <div class="container">
    <div class="info">
    <div class="text">
      <p>
        HTML (от англ. HyperText Markup Language — «язык гипертекстовой разметки») — стандартизированный язык разметки документов во Всемирной паутине. Большинство веб-страниц содержат описание разметки на языке HTML (или XHTML). Язык HTML интерпретируется браузерами; полученный в результате интерпретации форматированный текст отображается на экране монитора компьютера или мобильного устройства.
      </p>
      <p>
        Язык HTML до 5-й версии определялся как приложение SGML (стандартного обобщённого языка разметки по стандарту ISO 8879). Спецификации HTML5 формулируются в терминах DOM (объектной модели документа).
      </p>
      <p>
        Язык XHTML является более строгим вариантом HTML, он следует синтаксису XML и является приложением языка XML в области разметки гипертекста.
      </p>
      <p>
        Во всемирной паутине HTML-страницы, как правило, передаются браузерам от сервера по протоколам HTTP или HTTPS, в виде простого текста или с использованием шифрования.
      </p>
      <a href="https://ru.wikipedia.org/wiki/HTML">Wikipedia</a>
      </div>
      <div class="text">
      <p>
        CSS (/siːɛsɛs/ англ. Cascading Style Sheets — каскадные таблицы стилей) — формальный язык описания внешнего вида документа, написанного с использованием языка разметки.
      </p>
      <p>
        Преимущественно используется как средство описания, оформления внешнего вида веб-страниц, написанных с помощью языков разметки HTML и XHTML, но может также применяться к любым XML-документам, например, к SVG или XUL.
      </p>
      <a href="https://ru.wikipedia.org/wiki/CSS">Wikipedia</a>
      </div>
      </div>

    <div class="sidebar">
    <form name="action" method="post" action="#">
      <p>Вопрос:</p>
      <p><textarea name="feedback" cols="40" rows="8">Введите здесь ваш вопрос</textarea>
      </p>
      <p>Важность вопроса:<p>
      <select>
        <option>Очень важный</option>
        <option>Средний</option>
        <option>Обычный</option>
      </select>
      <input type="radio" name="Идентификатор в глазах обработчика, например, возраст, пол" value="Значение, которое будет отправлено">
      <input type="checkbox"  name="Идентификатор в глазах обработчика" value="Значение, которое будет отправлено">
      <input type="radio" name="answer" value="yes" checked>
      <label><input type="checkbox" name="document" value="yes">Я прочитал соглашение</label>
      <p><input type="submit" value="Отправить"></p>
      <input type="reset" value="Очистить">
      <button class="btn-1">Button 1</button>
      <section><button class='dotted thick'>Dotted Thick</button></section>
    </form>
    <?php require_once("poll.php"); ?>
      <?php require_once("sidemenu.php"); ?>
    </div>
    </div>

<?php require_once("footer.html"); ?>