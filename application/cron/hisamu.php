<?php

include "vendor/autoload.php";
use XBase\Table;

$table = new Table('/var/www/html/dev/saiba/assets/upload/saiba_upload/extract_dir/GLSAI-03203-537695-20160718_061242/T_GL1600.DBF');

$arrSkip = array();
$cnt =0;
$cols = array_keys($table->getColumns());
while ($record = $table->nextRecord()) {
    $raws = $arrValues = array();
    
    if($record->thnang != '2016') 
    {
        if(!in_array($record->thnang, $arrSkip))
            $arrSkip[] = $record->thnang;
        
        $arrSkip["cnt:".$record->thnang]++;
        
        echo "SKIP, ".$record->thnang." bukan tahun anggaran 2016<br />\n";
        continue;
    }
    
    $sql = "INSERT INTO t_glsai1_tmp(".implode(",",$cols).") VALUES('";
    foreach($cols as $col)
    {
            $raws[] = $col . "=>" . $record->$col . "|";
        if (in_array($col, explode(",", 'tglkirim,tglterima,tglupdate,tgldok1,tglpost,tglkurs')) )
        {
            if ($record->$col)
            {
                $arrValues[] = date("Y-m-d H:i:s", strtotime($record->$col));
            }
            else
            {
                $arrValues[] = "0000-00-00 00:00:00";
            }
        }
        else
        {
            $arrValues[] = $record->$col;
        }
    }
    
    $sql .= implode("','", $arrValues)."')";    
    print_r($raws);
    echo "$sql\n";
    //~ echo count($arrValues);
    //~ print_r($arrValues);
    
    //~ if ($cnt++>1) break;
}

print_r($arrSkip);
?>




<!--
SELECT count(*) FROM information_schema.`COLUMNS` C
WHERE table_name = 't_glsai1'
AND TABLE_SCHEMA = "saiba"
-->

