<?php
$filename ="volunteers.txt";
$contents = "";
header('Content-type: text/plain');
header('Content-Disposition: attachment; filename='.$filename);
if(count($volunteers)>0)
{
	# for header row, get keys for first row of volunteers
	# then loop thru and build tab delimited text spreadsheet
	$row1 = $volunteers[0];
	$columns = array_keys($row1);
	foreach( $columns as $column )
		echo "$column\t";
	echo "\n";
	
	foreach($volunteers as $volunteer)
	{
		foreach( $columns as $column )
		{
			echo  "{$volunteer[$column]}\t";
		}
		echo "\n";
	}
}
else
{
	echo "no volunteers found\n";
}

 ?>