<?php
class tes_despesas {

	protected $ctaGrupo;

	function __construct ($ctaGrupo=null) {
		$contas = (strlen($ctaGrupo)==5) ? true : false ;
		$sqlConsulta  = 'SELECT * FROM contas WHERE ';
		if ($contas) {
			$sqlConsulta .= 'nivel3="'.$ctaGrupo.'" ';
		} else {
			$sqlConsulta .= 'nivel1="3" OR nivel2="1.2" ';
		}
		$sqlConsulta .= '';
		$sqlConsulta .= 'ORDER BY codigo';
		$this->query = $sqlConsulta;
		$this->despesa = mysql_query($this->query) or die (mysql_error());
		while($dados = mysql_fetch_array($this->despesa))
		{
			if ($dados['id']!='0') {//S� das Despesas
				$todos[$dados['id']] = array('titulo'=>$dados['titulo'],'codigo'=>$dados['codigo'],
						'descricao'=>$dados['descricao'],'acesso'=>$dados['acesso'],'saldo'=>$dados['saldo']
						,'status'=>$dados['status'],'status'=>$dados['status']);
			}
		}
		$this->arrayacessoDespesas = $todos;
	}

	function dadosArray () {
		return $this->arrayacessoDespesas;
	}

	function despesasArray ($mes,$ano) {
		$dadosCta = $this->arrayacessoDespesas;
		$mes = sprintf ("%'02u",$mes);
		$mesRelatorio = $ano.$mes;
		//SQL das despesas agendadas
		$sqlAgenda  = 'SELECT a.*,DATE_FORMAT(a.datapgto,"%d/%m/%Y") AS dtpgto, ';
		$sqlAgenda .= 'c.acesso, c.titulo, c.codigo,c.tipo,i.razao, ';
		$sqlAgenda .= 'DATE_FORMAT(a.vencimento,"%d/%m/%Y") AS venc FROM agenda AS a ';
		$sqlAgenda .= ', contas AS c, igreja AS i ';
		$sqlAgenda .= 'WHERE (DATE_FORMAT(a.datapgto,"%Y%m")="'.$mesRelatorio.'" ';
		$sqlAgenda .= 'OR (DATE_FORMAT(a.vencimento,"%Y%m")="'.$mesRelatorio.'" AND a.idlanc="0") ) ';
		$sqlAgenda .= 'AND a.igreja=i.rol ORDER BY a.vencimento,i.razao';
		$agenda = mysql_query($sqlAgenda) or die (mysql_error());
		while ($arrayAgenda = mysql_fetch_array($agenda)) {
			if ($arrayAgenda['idlanc']>0) {
				//Com confirma��o de lan�amento (pagas)
				$agendaLanc [$arrayAgenda['idlanc']] = array('venc' => $arrayAgenda['venc'],
				'dtpgto' => $arrayAgenda['dtpgto'], 'idAgenda' => $arrayAgenda['id']);
			}else {
				//Sem confirma��o de pagamento
				$agendaSemLanc = array('vencimento' => $arrayAgenda['venc'],
				'dtpgto' => $arrayAgenda['dtpgto'] );
			}
			if ($arrayAgenda['idlanc']=='0') {
				//Despesas agendadas e n�o pagas
				$arrayDespesas[] = array('id'=>$arrayAgenda['id'],'titulo'=>$arrayAgenda['titulo'],'codigo'=>$arrayAgenda['codigo']
				,'lancamento'=>$arrayAgenda['idlanc'],'debitar'=>$arrayAgenda['debitar']
				,'creditar'=>$arrayAgenda['creditar'],'valor'=>$arrayAgenda['valor']
				,'igreja'=>$arrayAgenda['razao'],'referente'=>$arrayAgenda['motivo']
				,'data'=>$arrayAgenda['dtLanc'],'hist'=>$arrayAgenda['hist'],'acesso'=>$arrayAgenda['acesso']
				,'dtpgto'=>$arrayAgenda['dtpgto'],'vencimento'=>$arrayAgenda['venc']);
			}
		}
		//print_r($agendaNaoPago);
		//SQL dos lan�amentos realizados com despesas debitadas
		$sqlLancDesp  = 'SELECT l.*,i.razao, h.referente AS referente, ';
		$sqlLancDesp .= 'DATE_FORMAT(l.data,"%d/%m/%Y") AS dtLanc ';
		$sqlLancDesp .= 'FROM lanc AS l, igreja AS i, lanchist AS h ';
		$sqlLancDesp .= 'WHERE DATE_FORMAT(l.data,"%Y%m")="'.$mesRelatorio.'" ';
		$sqlLancDesp .= 'AND h.idlanca=l.lancamento ';
		$sqlLancDesp .= 'AND l.igreja=i.rol ORDER BY i.razao,l.data ';
		$despesa = mysql_query($sqlLancDesp) or die (mysql_error());
		while($dados = mysql_fetch_array($despesa)) {
			//Lan�amento da Despesas
			$ctaDebito = $dadosCta[$dados['debitar']]['codigo'];
			$ctaCredito = $dadosCta[$dados['creditar']]['codigo'];
			if (substr($ctaDebito, 0, 3)=='1.2' || substr($ctaDebito, 0, 2)=='3.' ) {
			//Lan�amento da Despesas e Imobilizado debitadas
			$arrayDespesas[] = array('id'=>$agendaLanc [$dados['lancamento']]['idAgenda']
				,'lancamento'=>$dados['lancamento'],'debitar'=>$dados['debitar']
				,'creditar'=>$dados['creditar'],'valor'=>$dados['valor']
				,'igreja'=>$dados['razao'],'referente'=>$dados['referente']
				,'data'=>$dados['dtLanc'],'hist'=>$dados['hist']
				,'dtpgto'=>$agendaLanc [$dados['lancamento']]['dtpgto']
				,'vencimento'=>$agendaLanc [$dados['lancamento']]['venc'],'sld'=>'D'
				,'acesso'=>$dadosCta[$dados['debitar']]['acesso'],'titulo=>'.$dadosCta[$dados['debitar']]['titulo']
				,'codigo=>'.$ctaDebito);
			}

			if (substr($ctaCredito, 0, 3)=='1.2' || substr($ctaCredito, 0, 2)=='3.' ) {
		//lan�amentos realizados com despesas e Imobilizado creditadas
			$arrayDespesas[] = array('id'=>$agendaLanc [$dados['lancamento']]['idAgenda']
				,'lancamento'=>$dados['lancamento'],'debitar'=>$dados['debitar']
				,'creditar'=>$dados['creditar'],'valor'=>$dados['valor']
				,'igreja'=>$dados['razao'],'referente'=>$dados['referente']
				,'data'=>$dados['dtLanc'],'hist'=>$dados['hist']
				,'dtpgto'=>$agendaLanc [$dados['lancamento']]['dtpgto']
				,'vencimento'=>$agendaLanc [$dados['lancamento']]['venc'],'sld'=>'C'
				,'acesso=>'.$dadosCta[$dados['creditar']]['acesso'],'titulo=>'.$dadosCta[$dados['creditar']]['titulo']
				,'codigo=>'.$ctaCredito);
			}
		//echo '*****'. $dados['debitar'].' +++';
	//	echo ' ||'. substr($ctaDebito, 0, 2).' ---';
		//print_r($dadosCta);
		}
	//	print_r($arrayDespesas);
		//echo '<br />Testando -- arrayDespesas<br /><br />';
		//print_r($arrayDespesas);
		return $arrayDespesas;
	}
}
?>
