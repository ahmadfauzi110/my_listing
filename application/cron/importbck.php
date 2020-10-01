<?php

include "vendor/autoload.php";
use XBase\Table;
echo "CRON JOB : ".date("Y-m-d H:i:s")."\n";

$isTest = false;

$tbl_upload = "temp_upload";
$tbl_glsai = "t_glsai1_upload";
$db_uname = 'dev_usr';
$db_passwd = 'GPATigaN0l';
$db = 'saiba';
$conn = mysql_pconnect('localhost',$db_uname, $db_passwd);
mysql_select_db($db, $conn);

$dirUpload = "/var/www/html/dev/saiba/uploads/03/2016/bckfiles";
$dirExtract = "/var/www/html/dev/saiba/assets/upload/saiba_upload/extract_dir";
//get list uploaded
dirToArray($dirUpload, $dirs);
echo "opening dir : $dirUpload \n";
foreach ($dirs as $file){
    if(eregi(strtolower(".bck"), strtolower($file))){
        echo "parsing : $file \n";
        process_bck($file);
    }
}
echo "CRON JOB END ".date("Y-m-d H:i:s")."\n";
mysql_close();

function process_bck($filename, $isTest=true){
    global $conn,$path,$tbl_glsai,$dirUpload,$dirExtract;
    #print_r($row);
    
    $fBck = $dirUpload . "/".$filename;
    $fZip = $dirUpload . "/". str_replace(".bck", ".zip", $filename);
    $dExtract = $dirExtract . "/". str_replace(".bck", "", $filename);    
    if (file_exists($fBck) || $isTest)
    {
        rename($fBck, $fZip);
        $cmd = "unzip -d $dExtract $fZip";
        exec($cmd, $output);
        $db_path = $dExtract . "/T_GL1600.DBF";
        if (file_exists($db_path))
        {
            $table = new Table($db_path);
            $cnt =0;
            $error = array();
            while ($record = $table->nextRecord()) {
                $cols = array_keys($table->getColumns());
                $arrValues = $raw_data = array();                
                if($record->thnang != '2016') 
                {
                    #echo "SKIP, bukan tahun anggaran 2016<br />";
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
                }
                
                $cols[] = 'batch_id';
                $arrValues[] = str_replace(".bck", "", $filename);
                $sql2 = "INSERT INTO $tbl_glsai(".implode(",",$cols).") VALUES('";
                $sql2 .= implode("','", $arrValues)."')";    
                if ($cnt++%50 == 0) 
                {   
                }
                $rs = mysql_query($sql2, $conn);
                if (!$rs)
                {
                    $error[] = $sql2;
                }
            }
            #echo "Sukses upload<br />\n";
            echo "Error Query <br/>\n";
            echo implode("\n", $error); 
        }
        else
        {
            echo "\n\nDATABASE GLSAI TIDAK DITEMUKAN<br/>";
        } 
    }
    else
    {
        ECHO "\n\nfile $fBck tidak ada<br />\n";
    }
}

function dirToArray($dir, &$result) { 
   
   $cdir = scandir($dir); 
   foreach ($cdir as $key => $value) 
   { 
      if (!in_array($value,array(".",".."))) 
      { 
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) 
         { 
            dirToArray($dir . DIRECTORY_SEPARATOR . $value, $result); 
         } 
         else 
         { 
            $result[] = $value; 
         } 
      } 
   } 
}     

?>
