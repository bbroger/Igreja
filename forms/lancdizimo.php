<?php
$_SESSION['debito']=0;
$_SESSION['credito']=0;

//concluir lan�amento final na tabela lan�amento
$roligreja =(int) $_POST['rolIgreja'];
$lanigreja = new DBRecord('igreja',$roligreja, 'rol' );
$exibir = new lancdizimo($roligreja);
//Faz o leiaute do lan�amento do d�bito da tabela dizimooferta
$exibirlanc = '';
$tablanc = mysql_query('SELECT SUM(valor) AS valor,devedora FROM dizimooferta WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY devedora');
$totDebito = mysql_num_rows($tablanc);
while ($tablancarr = mysql_fetch_array($tablanc)) {
	$exibirlanc .= $exibir->lancamacesso ($tablancarr['valor'],$tablancarr['devedora'],'D');
}

//Faz o leiaute do lan�amento do cr�dito da tabela dizimooferta
$tablanc_c = mysql_query('SELECT SUM(valor) AS valor,credito FROM dizimooferta WHERE lancamento="0" AND igreja = "'.$roligreja.'" GROUP BY credito');
$totCredito = mysql_num_rows($tablanc_c);
while ($tablancarrc = mysql_fetch_array($tablanc_c)) {
	$exibirlanc .= $exibir->lancamacesso ($tablancarrc['valor'],$tablancarrc['credito'],'C');
}
if ($_SESSION['lancar'] && ($totDebito>0 || $totCredito>0)) {
	//Inicializado as vari�veis
	$ind = 0;
	?>
<form method="post" action="">
	<label>Hist&oacute;rico do lan&ccedil;amento:</label> <input
		type="text" name="hist" id="hist" size="60" autofocus="autofocus"
		tabindex="<?PHP echo ++$ind;?>"> <input type="submit" name="Submit"
		value="Lan�ar..." tabindex="<?PHP echo ++$ind;?>" /> <label>Data:</label>
	<input type="text" name="data"
	
		OnKeyPress="formatar('##/##/####', this);"
		value="<?php echo date('d/m/Y');?>" tabindex="<?PHP echo ++$ind;?>"> <label>Ou
		Sugest�es de hist&oacute;rico</label> <label><input type="radio"
		name="histsug" value="Ref. d�zimos nesta data"
		tabindex="<?PHP echo ++$ind;?>"> Ref. dizimos nesta data</label> <label><input
		type="radio" name="histsug" value="Ref. d�zimos e ofertas nesta data"
		tabindex="<?PHP echo ++$ind;?>"> Ref. dizimos e ofertas nesta data</label>
	<label><input type="radio" name="histsug"
		value="Ref. d�zimos, ofertas e oferta-extra nesta data"
		tabindex="<?PHP echo ++$ind;?>"> Ref. dizimos, ofertas e oferta-extra
		nesta data</label> <label><h3>Com Miss�es</h3><input type="radio" name="histsug"
		value="Ref. d�zimos, ofertas, oferta-extra, votos e ofertas de miss�es nesta data"
		tabindex="<?PHP echo ++$ind;?>"> Ref. dizimos, ofertas, oferta-extra,
		votos e ofertas de miss�es nesta data</label> <label><input
		type="radio" name="histsug"
		value="Ref. d�zimos e ofertas de miss�es nesta data"
		tabindex="<?PHP echo ++$ind;?>"> Ref. dizimos e ofertas de miss�es
		nesta data</label> <input name="escolha" type="hidden"
		value="<?php echo $_GET['escolha'];?>" /> <input name="lancar"
		type="hidden" value="1" /> <input name="igreja" type="hidden"
		value="<?php echo $roligreja;?>" />
</form>

	<?php
}elseif ($totDebito<1 && $totCredito<1) {
	echo '<h3>Essa Igreja n�o possui lan�amento a realizar!</h3>';
}else {
	echo '<h3>Voc&ecirc; deve corrigir a pend&ecirc;ncia do lan&ccedil;amento acima para finalizar!</h3>';
}

require_once 'views/lancdizimo.php';//chama o view para montar
?>