<table>
	<tbody>
		<tr>
			<td colspan="2"><legend>Fecha Caixa</legend>
			</td>
		</tr>
		<tr>
			<td>
				<form method="post" action="">
					<input name="escolha" type="hidden" value="<?php echo $_GET['escolha'];?>" />
					<input name="concluir" type="hidden" value="1" />
					<input name="rolIgreja" type="hidden" value="<?php echo $igrejaSelecionada->rol();?>" />
					Igreja: 
					<?php
						echo $igrejaSelecionada->razao();//do script forms/autodizimo.php
					?>
					<input type="submit" name="Submit" value="Fecha Caixa" tabindex="<?PHP echo ++$ind;?>" />
				</form>
			</td>
			<td>
				<label>Alterar Igreja: </label>
					<select name="igreja" id="igreja" onchange="MM_jumpMenu('parent',this,0)" tabindex="<?PHP echo ++$ind; ?>" ><?php
					$bsccredor = new List_sele('igreja', 'razao', 'rolIgreja');					 
					$listaIgreja = $bsccredor->List_Selec_pop($linkAcesso,$_GET['igreja']);
					//echo $listaIgreja;
					?></select>
			</td>
		</tr>
	</tbody>
</table>