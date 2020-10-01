<?php

include "vendor/autoload.php";
use XBase\Table;
echo "CRON JOB : ".date("Y-m-d H:i:s")."\n";

$isTest = false;

$tbl_upload = "temp_upload";
$tbl_glsai = "t_glsai1";
$db_uname = 'dev_usr';
$db_passwd = 'GPATigaN0l';
$db = 'saiba';
$conn = mysql_connect('localhost',$db_uname, $db_passwd);
mysql_select_db($db, $conn);

$dirUpload = "/var/www/html/dev/saiba/assets/upload/saiba_upload";
$dirExtract = "/var/www/html/dev/saiba/assets/upload/saiba_upload/extract_dir";
//get list uploaded
$sql = "SELECT * from $tbl_upload WHERE status = 0 ORDER BY waktu ASC LIMIT 1";
echo "sql:$sql<br />\n";
$rs = mysql_query($sql, $conn);
if (!$rs)
{
    die(mysql_error());
}

if (false !== $row = mysql_fetch_assoc($rs))
{
    $id_up = $row['id_up'];
    $file_id = explode("-",$row['rename_nama_file']);
    $kdsatker = $file_id[2];
    #print_r($row);
    $fBck = $dirUpload . "/".$row['rename_nama_file'];
    $fZip = $dirUpload . "/". str_replace(".bck", ".zip", $row['rename_nama_file']);
    $dExtract = $dirExtract . "/". str_replace(".bck", "", $row['rename_nama_file']);
    
    echo "HANDLING FILE : $fBck<br />\n";
    if (file_exists($fBck) || $isTest)
    {
        echo "rename $fBck => $fZip<br />\n";
        rename($fBck, $fZip);
        $cmd = "unzip -d $dExtract $fZip";
        #echo "command: $cmd<br />\n";
        exec($cmd, $output);
        #print_r($output);
        
        $db_path = $dExtract . "/T_GL1600.DBF";
        if (file_exists($db_path))
        {
            //~ #clear up old data
            $sql_clearup = "DELETE FROM $tbl_glsai WHERE kdsatker = '$kdsatker' and batch_id <> ''";
            echo "sql_clearup: $sql_clearup<br />\n";
            $rs = mysql_query($sql_clearup, $conn);
            if (!$rs)
            {
                die(mysql_error());
            }
        
            $table = new Table($db_path);

            $cnt =0;
            $error = array();
            while ($record = $table->nextRecord()) {
                $cols = array_keys($table->getColumns());
                $arrValues = $raw_data = array();
                
                if($record->thnang != '2016') 
                {
                    //~ echo "SKIP, bukan tahun anggaran 2016<br />";
                    continue;
                }
                
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
                    //~ echo "$col:".$record->$col . "|";
                }
                
                $cols[] = 'batch_id';
                $arrValues[] = str_replace(".bck", "", $row['rename_nama_file']);
                
                $sql2 = "INSERT INTO $tbl_glsai(".implode(",",$cols).") VALUES('";
                
                $sql2 .= implode("','", $arrValues)."')";    
                if ($cnt++%50 == 0) 
                {   
                    #echo "Raw DAta:" .implode("|", $raw_data) . "<br />\n";
                    #echo "$sql2\n";
                }
                $rs = mysql_query($sql2, $conn);
                if (!$rs)
                {
                    $error[] = $sql2;
                }
                //~ echo count($arrValues);
                //~ print_r($arrValues);
                
                //~ if ($cnt++>10) break;
            }
            
            
            if($id_up<>""){
                $sql3 = "UPDATE $tbl_upload SET status = 1 WHERE id_up = '$id_up'";
                //echo "$sql3<br />\n";
                $rs = mysql_query($sql3, $conn);
                if (!$rs)
                {
                    echo mysql_error();
                }
            }
            #clear up non thnang 2016 data
            //~ $sql_clearup = "DELETE FROM $tbl_glsai WHERE kdsatker = '$kdsatker' AND thnang <> '2016' and batch_id = '".str_replace(".bck", "", $row['rename_nama_file'])."'";
            //~ $sql_clearup = "DELETE FROM $tbl_glsai WHERE kdsatker = '$kdsatker' AND thnang <> '2016'";
            //~ echo "sql_clearup: $sql_clearup<br />\n";
            //~ $rs = mysql_query($sql_clearup, $conn);
            //~ if (!$rs)
            //~ {
                //~ die(mysql_error());
            //~ }
                
            echo "Sukses upload<br />\n";
            echo "Error Query <br/>\n";
            echo implode("\n", $error); 
        }
        else
        {
            echo "file TGL $db_path<br />\n";
            $sql3 = "UPDATE $tbl_upload SET status = 3 WHERE id_up = '$id_up'";
            #echo "$sql3<br />\n";
            $rs = mysql_query($sql3, $conn);
            if (!$rs)
            {
                die(mysql_error());
            }
        } 
    }
    else
    {
        echo "file $fBck tidak ada<br />\n";
        $sql3 = "UPDATE $tbl_upload SET status = 2 WHERE id_up = '$id_up'";
        echo "$sql3<br />\n";
        $rs = mysql_query($sql3, $conn);
        if (!$rs)
        {
            die(mysql_error());
        }
    }
}
echo "CRON JOB END ".date("Y-m-d H:i:s")."\n";
mysql_close();
?>
