
<script type="text/javascript" src="js/autocomplete.js"></script>
<script
	type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<link
	rel="stylesheet" type="text/css" href="css/autocomplete.css"><script type="text/javascript">
$(document).ready(function(){

	new Autocomplete("campo_estado", function() {
		this.setValue = function( rol, nome, celular, congr ) {
			$("#id_val").val(rol);
			$("#estado_val").val(nome);
			$("#sigla_val").val(celular);
			$("#rol").val(celular);
			$("#cong").val(congr);
		}
		
		if ( this.value.length < 1 && this.isNotClick )
			return ;
		return "models/autodizimo.php?q=" + this.value;
	});

});
</script>
<!-- Desenvolvido por Wellington Ribeiro -->
<?php
$dtlanc = ($_GET['data']=='') ? date('d/m/Y'):$_GET['data'];
$meslanc = ($_GET['mes']=='' || $_GET['mes']>12 || $_GET['mes']<1) ? date('m'):$_GET['mes'];
$anolanc = ($_GET['ano']=='') ? date('Y'):$_GET['ano'];
?>
<form method="post" name="" action="">
		Dizimo e Ofertas ref. Igreja:
		<?php
		$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');
		$listaIgreja = $bsccredor->List_Selec(++$ind,$_GET['igreja'],'required="required" autofocus="autofocus" ');
		echo $listaIgreja;
		?>
	<table style="background-color: #D3D3D3; border: 0;">
		<caption style="text-align: left; font-weight: bold">
			D&iacute;zimos, Votos e Ofertas (Estamos na:
			<?php echo semana(date('d/m/Y'));?>
			&ordf; Semana deste m�s)
		</caption>

		<tbody>
			<tr>
				<td colspan="2">Nome:<br /> <input type="text" name="nome"
				id="campo_estado" size="50%"
					tabindex="<?php echo ++$ind;?>" />
				
				<td><label>Rol:<br /> <input type="text" id="rol" name="rol"
						value="" /> </label>
				</td>
			</tr>
			<tr>
				<td>Data: <br /> <input type="text" id="data" name="data"
					value="<?php echo $dtlanc;?>" required="required"/>
				</td>
				<td>Referente <br />M�s:<input type="text" id="mesnum" name="mes"
					size="2" value="<?php echo $meslanc;?>" required="required" />
					 Ano: <input type="text"
					id="ano" name="ano" size="4" value="<?php echo $anolanc;?>"
					 required="required"/>
				</td>
				<td>Congreg. do membro: <br /> <input type="text" id="cong"
					disabled="disabled" value="" />
				</td>
			</tr>
		</tbody>
	</table>
	<fieldset>
		<legend>Cultos</legend>
		<table style="background-color: #D3D3D3; border: 0; width: 100%;">
			<tbody>
				<tr>
					<td>D&iacute;zimo:<br /> <input type="text" id="oferta0"
						name="oferta0" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Oferta:</label><input type="text" id="oferta1"
						name="oferta1" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Oferta Extra:</label><input type="text" id="oferta2"
						name="oferta2" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
				</tr>
				<tr>
					<td><label>Voto:</label><input type="text" id="oferta3"
						name="oferta3" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td></td>
					<td> <input
					type="submit" name="listar" value="Lan�ar..."></td>
				</tr>
				<tr>
					<td colspan="2">Qual Campanha ? <br /> <?php 
					$campanha = new List_campanha;
					echo $campanha -> List_Selec(++$ind,(int)$_GET['acescamp']);
					?>
					</td>
					<td><label>Campanha (Valor):</label><input type="text" id="oferta4"
						name="oferta4" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
			
			</tbody>
		</table>
	</fieldset>
	<fieldset>
		<legend>Miss�es</legend>
		<table style="background-color: #D3D3D3; border: 0; width: 80%;">
			<tbody>
				<tr>
					<td><label>Oferta:</label><input type="text" id="oferta5"
						name="oferta5" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Envelopes:</label><input type="text" id="oferta6"
						name="oferta6" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Cofres:</label><input type="text" id="oferta7"
						name="oferta7" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
				</tr>
				<tr>
					<td><label>Carn�s:</label><input type="text" id="oferta8"
						name="oferta8" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td></td>
					<td> <input
					type="submit" name="listar" value="Lan�ar..."></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<fieldset>
		<legend>Circulos de Ora��o</legend>
		<table style="background-color: #D3D3D3; border: 0; width: 100%;">
			<tbody>
				<tr>
					<td><label>Adulto:</label><input type="text" id="oferta9"
						name="oferta9" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Mocidade:</label><input type="text" id="oferta10"
						name="oferta10" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td><label>Infantil:</label><input type="text" id="oferta11"
						name="oferta11" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
				</tr>
				<tr>
					<td><label>Voto:</label><input type="text" id="oferta12"
						name="oferta12" value="" tabindex="<?php echo ++$ind;?>" />
					</td>
					<td></td>
					<td> <input
					type="submit" name="listar" value="Lan�ar..."
					tabindex="<?php echo ++$ind;?>"></td>
				</tr>
			</tbody>
		</table>
	</fieldset>
	<fieldset>
		<legend>Observa��o:</legend>
	<table style="background-color: #D3D3D3; border: 0; width: 100%;">
		<tbody>
			<tr>
				<td colspan="2"><textarea name="obs" id="obs"
						cols="50%" tabindex="<?php echo ++$ind;?>"></textarea>
				</td>
				<td><input type="hidden" name="tipo" id="tipo" value="1"> <input
					type="hidden" name="escolha" value="models/dizoferta.php"> <input
					type="submit" name="listar" value="Lan�ar..."
					tabindex="<?php echo ++$ind;?>">
				</td>
			</tr>
		</tbody>
	</table>
	</fieldset>
</form>


