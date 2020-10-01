<?php

include "vendor/autoload.php";
use XBase\Table;

$isTest = false;

$tbl_upload = "temp_upload";
$tbl_glsai = "t_glsai_ori";
$db_uname = 'dev_usr';
$db_passwd = 'GPATigaN0l';
$db = 'saiba';
$conn = mysql_pconnect('localhost',$db_uname, $db_passwd);
mysql_select_db($db, $conn);

$db_path = "/var/www/html/dev/saiba/application/db/t_glsai.DBF";
if (file_exists($db_path))
{
    $table = new Table($db_path);
    $cnt =0;
    $error = array();
    while ($record = $table->nextRecord()) {
        $cols = array_keys($table->getColumns());
        $arrValues = $raw_data = array();
        foreach($cols as $col)
        {
            $raw_data[] = "$col=>".$record->$col;

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

        $sql2 = "INSERT INTO $tbl_glsai(".implode(",",$cols).") VALUES('";
        $sql2 .= implode("','", $arrValues)."');";    
        $rs = mysql_query($sql2, $conn);
        if (!$rs)
        {
            $error[] = $sql2;
        }
    }
    echo implode("\n", $error); 
}else{
    echo "No FIle ".$db_path;
}

?>
