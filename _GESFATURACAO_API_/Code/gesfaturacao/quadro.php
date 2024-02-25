<?php

if(!$helpersFile || $helpersFile != true){
	include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpers.php';
}
include $_SERVER["DOCUMENT_ROOT"] . '/gesfaturacao/server/helpersQuadro.php';

if(!isset($sqli_connection)){
	include $_SERVER["DOCUMENT_ROOT"] . '/server/connection.php';
}

$id_utilizador = $_SESSION['id_utilizador'];

//Usable resources
setlocale(LC_MONETARY, 'pt_PT.UTF-8');
?>

<style type="text/css">
	h3.quadro_header { margin: 0px !important; }
</style>

<table class="table table-menu" >
	<tbody>
	<tr>
		<td colspan="6" class="text-center">
			<h3 class="quadro_header"><b><?php echo date('Y'); ?></b></h3>
		</td>
	</tr>
	<tr>
		<td><a href="/gesfaturacao/faturas"><b>Tot. Faturado</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/faturas" class="text-blue"><?php echo number_format(getQD_Faturado(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/compras"><b>Tot. Comprado</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/compras" class="text-red"><?php echo number_format(getQD_Comprado(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/clientes"><b>Nº Clientes</b></a></td>

		<td class="text-right" style="padding-left: 15px;"><a href="/gesfaturacao/clientes"><?php echo getQD_TotClients();?></a></td>
	</tr>

	<tr>
		<td><a href="/gesfaturacao/faturas"><b>Tot. Faturas Liquidado</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/faturas" class="text-green"><?php echo number_format(getQD_FatLiquidado(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/compras"><b>Tot. Compras Liquidado</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/compras" class="text-green"><?php echo number_format(getQD_CompLiquidado(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/fornecedores"><b>Nº Fornecedores</b></a></td>

		<td class="text-right" style="padding-left: 15px;"><a href="/gesfaturacao/fornecedores"><?php echo getQD_TotFornecedores();?></a></td>
	</tr>

	<tr>
		<td><a href="/gesfaturacao/faturas"><b>Tot. Faturas P/Liquidar</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/faturas" class="text-red"><?php echo number_format(getQD_FatPorLiquidar(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/compras"><b>Tot. Compras P/Liquidar</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/compras" class="text-red"><?php echo number_format(getQD_CompPorLiquidar(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/guias-transporte"><b>Nº Guias Registadas</b></a></td>

		<td class="text-right" style="padding-left: 15px;"><a href="/gesfaturacao/guias-transporte"><?php echo getQD_TotGuias();?></a></td>
	</tr>

	<tr>
		<td><a href="/gesfaturacao/faturas"><b>Tot. IVA Faturas</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/faturas"><?php echo number_format(getQD_FatIVA(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/compras"><b>Tot. IVA Compras</b></a></td>

		<td class="text-right" style="padding-left: 15px; padding-right: 5px;"><a href="/gesfaturacao/compras"><?php echo number_format(getQD_CompIVA(), 2, ',', '.') . ' €';?></a></td>

		<td><a href="/gesfaturacao/faturas"><b>Nº Faturas Registadas</b></a></td>

		<td class="text-right" style="padding-left: 15px;"><a href="/gesfaturacao/faturas"><?php echo getQD_TotFaturas();?></a></td>
	</tr>
	</tbody>
</table>
