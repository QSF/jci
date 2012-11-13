<h1>Contato</h1>

<p>As reuniões da JCI Londrina são realizadas às segundas-feiras às 19:10 na Associação Comercial e Industrial de Londrina - ACIL. Para mais informações, não hesite em entrar em contato.</p>


<form action="./index.php?controller=guest&action=sendMail" method="post">
<table>
	<tr>
		<td>
			<label for="name">Nome</label>
		</td>
		
		<td>
			<input type="text" id="name" name="name" required="required"/>
		</td>

	<tr>
		<td>
			<label for="email">E-Mail</label>
		</td>
		<td>
			<input type="email" id="email" name="email" required="required"/>
		</td>
	</tr>
	
</table>
<br/>
	<label for="content">Conteúdo</label>


	<textarea name="content" style="width:500px; height:200px; margin-top: 2px; margin-bottom: 2px;" 
		id="content" required="required"></textarea>
<br/>
<input type="submit" value="Enviar"/>
</form>