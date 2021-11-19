
<?php	
	require "../dao/conexao.php";
	
	
	//Criando tabela HTML com o formato da planilha
	


$html = "

	<style>
		    table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
				border-spacing: 0;	
				margin-bottom: 20px;
			}			
			td{
				border: 1px solid #C1CED9;
				text-align: center;
				padding: 5px, 20px;				        
				font-weight: normal;
			}
			th{
				border: 1px solid #C1CED9;
				text-align: center;
				padding: 5px, 20px;	
                color: #5D6975;				
				font-weight: normal;
			}
			tr:nth-child(even) {
				background-color: #ddd;
			}
			p{				
				color: #888;
				
				text-align: center;
			}
			footer{
			    position: fixed; 
				bottom: 0cm; 
				left: 0cm; 
				right: 0cm;
				height: 2cm;
				 background-color: #03a9f4;
				color: white;
				text-align: center;
				line-height: 1.5cm;
			}
	</style>
	
	<table>
		<thead>
			<tr>
				<th><b>Id</b></th>
				<th><b>Produto</b></th>
				<th><b>Cliente</b></th>
				<th><b>Quantidade</b></th>
				<th><b>Motivo da movimentação</b></th>
				<th><b>Data de movimentação</b></th>
				<th><b>Tipo</b></th>				
				<th><b>Responsável</b></th>
			</tr>
		</thead>";
	
		$sql = "SELECT m.id,m.produto,m.quant_mov,m.motivo,m.data_mov,m.movimentacao,m.responsavel,u.id,u.usuario,p.codigo,p.descricao,c.id_cli,c.nome_cli FROM movimentacoes_estoque as m
LEFT JOIN produtos as p ON m.produto=p.codigo 
LEFT JOIN usuarios as u ON m.responsavel=u.usuario
LEFT JOIN clientes as c ON m.cliente=c.id_cli";
		$result = mysqli_query($conexao, $sql);

			while($row_dados = mysqli_fetch_assoc($result)){
				if($row_dados['movimentacao']==0){
                                                $mov='Entrada';
                                            }
                                            else{
                                                $mov='Saída';
                                            }
				$html .= '<body>';
				$html .= '<tr>';
				$html .= '<td>'.$row_dados["id"].'</td>';
				$html .= '<td>'.$row_dados["descricao"].'</td>';
				$html .= '<td>'.$row_dados["nome_cli"].'</td>';
				$html .= '<td>'.$row_dados["quant_mov"].'</td>';
				$html .= '<td>'.$row_dados["motivo"].'</td>';
				$html .= '<td>'.date('d/m/Y', strtotime($row_dados['data_mov'])) .'</td>';
				$html .= '<td>'.$mov.'</td>';
				$html .= '<td>'.$row_dados["usuario"].'</td>';
				$html .= '</tr>';
				$html .= '</body>';
			}
	
			$html .= '</table>';
	
			date_default_timezone_set('America/Sao_Paulo');  
			$date = date('d/m/Y - H:i:s');
			


	//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("../dompdf/autoload.inc.php");

	//Criando a Instancia
	$dompdf = new DOMPDF();

	 // Carrega o HTML
	$dompdf->load_html('
	        <img src="../imagens/logo_pdf.png" />
			<h1 style="text-align: center;">Relatório de Movimentações</h1>
			'.$html.'
			<p> Relatório gerado dia '.$date.'</p>
			<footer>Projeto Integrador Univesp © Almoxarifado 2021</footer>
			
		'); 
		
			

	//Renderizar o html
	$dompdf->render();

	//Paginação
	$canvas = $dompdf->get_canvas();
	$canvas->page_text(510, 18, "Pág. {PAGE_NUM}/{PAGE_COUNT}", $font, 10, array(0,0,0));

	//Exibibir a página
	$dompdf->stream(
		"relatorio_movimentacoes.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>