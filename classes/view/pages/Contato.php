<h1>Contato</h1>

<p>As reuniões da JCI Londrina são realizadas às segundas-feiras às 19:10 na Associação Comercial e Industrial de Londrina - ACIL. Para mais informações, não hesite em entrar em contato.</p>

<br/>
<form class="form-horizontal" action="./index.php?controller=guest&action=sendMail" method="post">
  <div class="control-group">
    <label class="control-label" for="name">Nome</label>
    <div class="controls">
      <input type="text" id="name" name="name" required="required" placeholder="Digite seu nome." style="width:350px;">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="email">E-mail</label>
    <div class="controls">
      <input type="email" id="email" name="email" required="required" placeholder="E-mail" style="width:350px;">
    </div>
  </div>
  <div class="control-group">
  	<label class="control-label" for="content">Conteúdo</label>
    <div class="controls">
      <textarea name="content" id="content" required="required" rows="6" placeholder="Escreva sua mensagem aqui." style="width:350px;"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn">Enviar</button>
    </div>
  </div>
</form>