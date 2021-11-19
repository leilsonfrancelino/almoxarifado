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
				<th><b>Unidade</b></th>
				<th><b>Quantidade</b></th>
				<th><b>Valor unitário</b></th>				
				<th><b>Valor em estoque</b></th>
			</tr>
		</thead>";
		
		$sql_produtos = "SELECT * FROM produtos ORDER BY codigo";
		$result_produtos = mysqli_query($conexao, $sql_produtos);
		

		//select estoque total
		$sql_total_prod = "SELECT SUM(valor_unidade*quantidade) as total FROM produtos";
		$result_total_prod = mysqli_query($conexao, $sql_total_prod);
	
		

			while($dados_pdf_prod = mysqli_fetch_assoc($result_produtos)){
				    $valor_produtos = ($dados_pdf_prod['quantidade'] * $dados_pdf_prod['valor_unidade']);
                    $valor_unidade_formatado = number_format($dados_pdf_prod['valor_unidade'], 2, ',', '.');
                    $valor_produtos_formatado = number_format($valor_produtos, 2, ',', '.');
				$html .= '<body>';
				$html .= '<tr>';
					$html .= '<td>' . $dados_pdf_prod["codigo"].'</td>';
					$html .= '<td>' . $dados_pdf_prod["descricao"].'</td>';
					$html .= '<td>' . $dados_pdf_prod["unidade"].'</td>';
					$html .= '<td>' . $dados_pdf_prod["quantidade"].'</td>';					
					$html .= '<td>' . "R$ " . $valor_unidade_formatado.'</td>';
					$html .= '<td>' . "R$ " . $valor_produtos_formatado.'</td>';
				$html .= '</tr>';
				$html .= '</body>';
			}	
          
			//total estoque
			while ($dados_total_prod = mysqli_fetch_array($result_total_prod)) {                         
					 $valor_total_formatado = number_format($dados_total_prod['total'], 2, ',', '.');                                               
				
				$html .= '<tfoot>';
				$html .= '<tr>';
					$html .= '<th>'."".'</th>';
					$html .= '<th>'."".'</th>';	
					$html .= '<th>'."".'</th>';
					$html .= '<th>'."".'</th>';
					$html .= '<td>'."".'</th>';
					$html .= '<td><b>' . " Total: R$ " . $valor_total_formatado.'</b></td>';
				$html .= '</tr>';
				
				$html .= '</tfoot>';
			
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
			<h1 style="text-align: center;">Relatório de Produtos</h1>
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
		"relatorio_produtos.pdf", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		)
	);
?>