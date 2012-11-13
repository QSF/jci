<br><br>
<form class="form-horizontal" action="./index.php?controller=login&action=<?php echo $action?>" method="post">
  <div class="control-group">
    <label class="control-label" for="inputEmail"><?php echo $nameDisplay ?></label>
    <div class="controls">
      <input type="text" id="inputEmail" name="<?php echo $inputType?>" placeholder="<?php echo $nameDisplay ?>">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Senha</label>
    <div class="controls">
      <input type="password" id="inputPassword" name="password" placeholder="Senha">
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
<!--       <label class="checkbox">
        <input type="checkbox"> Lembrar
      </label> -->
      <button type="submit" class="btn">Logar</button>
    </div>
  </div>
</form>