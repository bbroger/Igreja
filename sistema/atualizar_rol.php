<?PHP

controle ("atualizar");

$hist = $_SESSION['valid_user'].": ".$_SESSION['nome'];

$query = "select * from {$_POST["tabela"]} ";
//echo "ID: ".$_POST["id"]." Campo: ".$_POST["campo"]." Tabela: ".$_POST["tabela"]." Post[Post[campo]]: ".ltrim($_POST[$_POST["campo"]]);
	$query .="where rol='{$_POST["id"]}'";
	$id = (int)$_POST["id"];
	
$result = mysql_query($query) or die (mysql_error());

   if (mysql_num_rows($result)>0)
	{
		//$rec = new UPDatesist($_POST["tabela"], $id,$_POST["campo"]);
		
		$rec = new DBRecord ("{$_POST["tabela"]}",$id,"rol"); //Aqui ser� selecionado a informa��o do campo
		print "<br \>Foi atualizado de:<h3>{$rec->$_POST["campo"]()}</h3>\n"; //Imprime o valor na tela
		
		if ($_POST["campo"]=='ceia') {
			$atualizador =(int)($_POST["semana"].$_POST["dia"]);
			$rec->$_POST["campo"] = $atualizador; //Aqui � atribuido a esta vari�vel um valor para UpDate
		}else {
			$atualizador = ltrim($_POST[$_POST["campo"]]);
			$rec->$_POST["campo"] = $atualizador; //Aqui � atribuido a esta vari�vel um valor para UpDate
		}
				
		
				
		$rec->Update(); //� feita a chamada do m�todo q realiza a atualiza��o no Banco
				
				
		print "Para:<h3> $atualizador</h3>";
		echo mysql_error();
		echo "<script> alert('Altera��o realizada com sucesso!');window.history.go(-1);</script>";
				/*echo "<script> alert('Altera��o realizada com sucesso!');  location.href='./?escolha=tab_auxiliar/cadastro_bairro.php&uf={$_POST["uf_end"]}';</script>";*/

	}
		
	
 ?> 