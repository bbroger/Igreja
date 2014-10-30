<?php 
if ($_GET['fin']=='' || $_GET['fin']<2) {
	require_once ("views/secretaria/menuTopDados.php");
	$hisFinanceiro = 1;
	$cong = '';
}elseif (empty($_GET['igreja'])) {
	$igreja = '';
	$hisFinanceiro = 3;
	$cong = 'Todas as Igrejas<br />';
	require_once 'forms/tes/histFinanceiro.php';
}else {
	$igreja = (int)$_GET['igreja'];
	$ingSeleciona = new DBRecord('igreja', $igreja, 'rol');
	$cong = 'Igreja - '.$ingSeleciona->razao().'<br />';
	$hisFinanceiro = 2;
	require_once 'forms/tes/histFinanceiro.php';
}

require_once 'models/tes/histFinMembro.php';
?>
<table id="horario" >
		<caption><?php echo $cong;?>Hist�rico Financeiro de D�zimos e Ofertas - Ano de refer�ncia: 
		<?php echo $ano;?> - Valores em Real(R$)</caption>
		<colgroup>
				<col id="Mes">
				<col id="D�zimos">
				<col id="Ofertas">
				<col id="Campanhas">
				<col id="Miss�es">
				<col id="Senhoras">
				<col id="Mocidade">
				<col id="Infantil">
				<col id="Ensino">
				<col id="Total">
			</colgroup>
		<thead>
			<tr>
				<th scope="col">M�s</th>
				<th scope="col">D�zimos</th>
				<th scope="col">Ofertas</th>
				<th scope="col">Campanhas</th>
				<th scope="col">Miss�es</th>
				<th scope="col">Senhoras</th>
				<th scope="col">Mocidade</th>
				<th scope="col">Infantil</th>
				<th scope="col">Ensino</th>
				<th scope="col">Total</th>
			</tr>
		</thead>
			<?php
			if ($_GET['tipo']==1) {
				echo $nivel1;//Valor veio do script /models/saldos.php
			}else {
				echo $nivel1;//Valor veio do script /models/saldos.php
			}				
			?>
		<tfoot>
			<?php  
				printf("<tr id='subtotal'>"); 
				echo ('<td>Em&nbsp;'.$ano.':</td><td id="moeda">'.number_format($totDizAno,2,',','.').'</td>
						<td id="moeda">'.number_format($totOfertaAno,2,',','.').
						'</td><td id="moeda">'.number_format($totCampanhaAno,2,',','.').'</td>'.
						'</td><td id="moeda">'.number_format($totMissoesAno,2,',','.').'</td>');
				echo '<td id="moeda">'.number_format($totSenhorasAno,2,',','.').'</td><td id="moeda">'.number_format($totMocidadeAno,2,',','.').'</td>
				<td id="moeda">'.number_format($totInfantilAno,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totEnsinoAno,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totTotal,2,',','.').'</td></tr>';

				printf("<tr id='total'>"); 
				echo ('<td>Total&nbsp;</td><td id="moeda">'.number_format($totDizimo,2,',','.').'</td>
					<td id="moeda">'.number_format($totOfertaCultos,2,',','.').'</td><td id="moeda">'.number_format($totOfertaCampanha,2,',','.').'</td>'.
						'</td><td id="moeda">'.number_format($totMissoes,2,',','.').'</td>');
				echo '<td id="moeda">'.number_format($totSenhoras,2,',','.').'</td><td id="moeda">'.number_format($totMocidade,2,',','.').'</td>
				<td id="moeda">'.number_format($totInfantil,2,',','.').'</td>';
				echo '<td id="moeda">'.number_format($totEnsino,2,',','.').'</td>';

				$totGeral = $totDizimo+$totOfertaCultos+$totOfertaCampanha+$totMissoes+$totSenhoras+$totMocidade+$totInfantil+$totEnsino;
				echo '<td id="moeda">'.number_format($totGeral,2,',','.').'</td></tr>';
			?>
		</tfoot>
	</table>
	<h2>Total geral: <?php echo 'R$ '.number_format($totGeral,2,',','.');?></h2>
	Em: <?php echo date('d/m/Y').'</br>Ano inicial de contribui��o: '.$menorAno.' ** Ultimo ano de contribui��o: '.$maiorAno;?>