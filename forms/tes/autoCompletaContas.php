<script type="text/javascript" src="js/autocomplete.js"></script>
<script
	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link
	rel="stylesheet" type="text/css" href="css/autocomplete.css">
<script type="text/javascript">
$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular,detalhe ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#acesso").val(celular);
			$("#detalhe").val(detalhe);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/tes/autoCompletaContas.php?q=" + this.value;
	});

	new Autocomplete("estado", function() {
		this.setValue = function( rol, nome, celular,detalhe ) {
			$("#id").val(rol);
			$("#nome").val(nome);
			$("#acesso2").val(celular);
			$("#detalhe2").val(detalhe);
		}
		if ( this.isModified )
			this.setValue("");
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/tes/autoCompletaContas.php?q=" + this.value;
	});

});
</script>
<span style="text-align: left; font-weight: bold">Debitar Conta</span>
<table style="background-color: #D3D3D3;">
	<tbody>
		<tr>
			<td colspan="3">Conta:<br /> <input type="text" name="nome"
				id="campo_estado" size="78%" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
		<tr>
			<td>C�digo/tipo:<br /> <input type="text" id="estado_val"
				name="estado_val" disabled="disabled" value="" />
			</td>
			<td>Saldo Atual: <br /> <input type="text" id="id_val" name="id"
				disabled="disabled" value="" /></td>
			<td>Acesso:<br /> <input type="text" id="acesso" name="acessoDebitar"
				value="" required="required" tabindex="<?PHP echo ++$ind; ?>" /></td>
		</tr>
		<tr>
			<td colspan="3">Descri��o:<br />  <input type="text" size="78%" id="detalhe" name="det"
				disabled="disabled" /></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</tbody>
</table>
<span style="text-align: left; font-weight: bold">Creditar Conta</span>
<table style="background-color: #D3D3D3;">
	<tbody>
		<tr>
			<td colspan="3">Conta:<br /> <input type="text" name="nome1"
				id="estado" size="78%" tabindex="<?PHP echo ++$ind; ?>" />
			</td>
		</tr>
		<tr>
			<td>C�digo/tipo:<br /> <input type="text" id="nome" name="codigo"
				disabled="disabled" value="" />
			</td>
			<td>Saldo Atual: <br /> <input type="text" id="nome" name="id"
				disabled="disabled" value="" /></td>
			<td>Acesso:<br /> <input type="text" id="acesso2"
				name="acessoCreditar" value="" required="required"
				tabindex="<?PHP echo ++$ind; ?>" /></td>
		</tr>
		<tr>
			<td colspan="3">Descri��o:<br />  <input type="text" size="78%" id="detalhe2" name="det"
				disabled="disabled" /></td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</tbody>
</table>



