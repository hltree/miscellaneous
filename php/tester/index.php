<?php
session_start();
?>
<form id="form">
    <fieldset>
        <p>問い</p>
        <?php
        foreach (range(1, 3) as $num) {
            ?>
            <input type="radio" name="radio" value="<?= $num ?>" <?= $num === 1 ? 'checked' : '' ?> />
            <label for="<?= $num ?>"><?= $num ?></label>
            <?php
        }
        ?>
    </fieldset>
    <button onclick="ClickEvent()" type="button">送信</button>
</form>

<script type="text/javascript">
    var fm = document.getElementById('form');
    var hiddenClassName = '-is-hidden';
    function ClickEvent() {
      if (fm.className !== hiddenClassName) {
        fm.classList.add(hiddenClassName);
      } else {
        fm.classList.remove(hiddenClassName);
      }
    }
</script>
