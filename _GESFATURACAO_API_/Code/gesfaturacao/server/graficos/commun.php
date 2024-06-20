<?php
/* 
	 * Paging
	 */
	$sLimit = "";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".mysqli_real_escape_string($conexao, $_GET['iDisplayStart'] ).", ".
			mysqli_real_escape_string($conexao, $_GET['iDisplayLength'] );
	}
	
	
	/*
	 * Ordering
	 */
	if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= $aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."
				 	".mysqli_real_escape_string($conexao, $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}
	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
		$sWhere = "WHERE " . $sJoin;
	if ( $_GET['sSearch'] != "" )
	{
		$sWhere = "WHERE ". $sJoin. " AND(";
		
		for ( $i=0 ; $i<count($fFilter) ; $i++ )
		{
			$sWhere .= $fFilter[$i]." LIKE '%".mysqli_real_escape_string($conexao, $_GET['sSearch'] )."%' OR ";
		}
		$sWhere = substr_replace( $sWhere, "", -3 );
		$sWhere .= ')';
		
	}
	
	/* Individual column filtering */
	for ( $i=0 ; $i<count($fFilter) ; $i++ )
	{
		if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= $fFilter[$i]." LIKE '%".mysqli_real_escape_string($conexao,$_GET['sSearch_'.$i])."%' ";
		}
		
	}
	

	
	/*
 * Select list
 */
	$sSelect = "";
	for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
   			 $sSelect .= $aColumns[$i] .' as `'.$aColumns[$i].'`, ';
		}
	$sSelect = substr_replace( $sSelect, "", -2 );
	
	/*
	 * SQL queries
	 * Get data to display
	 */
	$sQuery = "
		SELECT SQL_CALC_FOUND_ROWS ". $sSelect ."
		FROM  $sTable
		$sLeft
		$sWhere 
		$sOrder
		$sLimit
	";
	// echo $sQuery;
	$rResult = executaQuery($sQuery);
	
	
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = executaQuery($sQuery);
	$aResultFilterTotal = mysqli_fetch_array($rResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $cTable
	"; 
	$rResultTotal = executaQuery($sQuery);
	$aResultTotal = mysqli_fetch_array($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = mysqli_fetch_array( $rResult ) )
	{
		
		$row = array();
		for ( $i=0 ; $i<count($aColumns) ; $i++ )
		{
			if ( $aColumns[$i] == "version" )
			{
				/* Special output formatting for 'version' column */
				$row[] = ($aRow[ $aColumns[$i] ]=="0") ? '-' : $aRow[ $aColumns[$i] ] ;
			}
			else if ( $aColumns[$i] != ' ' )
			{
				/* General output */
				$row[] = $aRow[ $aColumns[$i] ];
				
			}
		}
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
?>