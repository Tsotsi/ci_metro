 <?php
$filearr = file('CI_Autocomplete_2.0.php');
$startpos = array();
$conpos = 0;
$modpos=0;
getpos($startpos, $conpos, $modpos, $filearr);
$model = '';
$lib = '';
$resultnames = array();
//getdirfilesname('../application/models');
$filesmodel = ListFiles('../application/models');
$fileslib = ListFiles('../application/libraries');
$test=filenamechange($filesmodel);
$test1=filenamechange($fileslib);
$resultnames = array_merge(filenamechange($filesmodel), filenamechange($fileslib));//过滤到index并且得到字符串
//$insertarr=array();
//var_dump($resultnames);

array_splice($filearr, $startpos[0] + 1, $conpos - $startpos[0] - 3, $resultnames);
getpos($startpos, $conpos, $modpos, $filearr);
$porarr=array_slice($filearr, 3, $conpos-5);
array_splice($filearr, $conpos+3, $modpos - $conpos - 5, $porarr);
$resultstr = "";
for ($i = 0; $i < count($filearr); $i++) {
    $temstr = $filearr[$i];
    //   var_dump($filearr[$i]);
    $resultstr.=$temstr;
}
///$resultstr=implode(" ", $filearr);
//var_dump($resultstr);
//写入文件
//file_put_contents ( string filename, string data [, int flags [, resource context]])
if (file_exists('CI_Autocomplete_2.0.php')) {
    unlink('CI_Autocomplete_2.0.php');
 // rename('CI_Autocomplete_2.0.php', 'CI_Autocomplete_2.0.php'.time());
}
file_put_contents('CI_Autocomplete_2.0.php', $resultstr);
echo '<html><head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/><title></title>';
echo '</head><body>';
echo '<p align="center">转换完成!</p></body></html>';
//var_dump($files);
//scandir//();
//var_dump($startpos.' '.$endpos);
//$start=array_search('* @property CI_Zip $zip\n', $filearr);
//array_splice(array,offset,length,array);
//var_dump($start);
//var_dump($filearr);
//var_dump($filearr);
function getdirfilesname($dir) {
    $namearr = scandir($dir);
    $namearr = array_diff($namearr, array('..', '.'));
    var_dump($namearr);
}
function ListFiles($dir) {
    if ($dh = opendir($dir)) {
        $files = array();
        $inner_files =array();
        while ($file = readdir($dh)) {
            if ($file != "." && $file != ".." && $file[0] != '.') {
                if (is_dir($dir . "/" . $file)) {
                    $inner_files = ListFiles($dir . "/" . $file);
                    if (is_array($inner_files))
                        $files = array_merge($files, $inner_files);
                } else {
                    //    array_push($files, $dir . "/" . $file);
                    array_push($files, $file);
                }
            }
        }
        closedir($dh);
        return $files;
    }
}
function filenamechange($filesname, $ucfirst=0) {
    $count=count($filesname);
    $resultnames=array();
    for ($i = 0; $i <$count ; $i++) {
        //$startpos=strrpos($filearr[$i],$startstr)===FALSE?continue:
        if (strrpos($filesname[$i], 'ndex.html'))
            unset($filesname[$i]);
        if (isset($filesname[$i])) {
            $filesname[$i] = str_ireplace('.php', '', $filesname[$i]);
            //   $resultnames[$i]['name']=ucfirst($filesname[$i]);
            //  $resultnames[$i]['value']='$'.$filesname[$i];
            if ($ucfirst) {
                $resultnames[] = "* @property " . ucfirst($filesname[$i]) . " $" . ucfirst($filesname[$i]) . "\r\n";
            }else
                $resultnames[] = "* @property " . ucfirst($filesname[$i]) . " $" . strtolower($filesname[$i]) . "\r\n"; //* @property Kslevel $kslevel
 
//  $filesname[$i]=strtr($filesname[$i],'php',' ' );
        }
    }
    return $resultnames;
}
function getpos(&$startpos,&$conpos,&$modpos,$filearr) {
    $startstr = '* @property CI_Zip $zip';
$constr = 'class CI_Controller {};';
$modstr='class CI_Model {};';
    for ($i = 0; $i < count($filearr); $i++) {//找到位置
    //$startpos=strrpos($filearr[$i],$startstr)===FALSE?continue:
    if (strrpos($filearr[$i], $startstr) !== FALSE)
        $startpos[] = $i;
    if (strrpos($filearr[$i], $constr) !== FALSE)
        $conpos = $i;
        if (strrpos($filearr[$i], $modstr) !== FALSE)
        $modpos = $i;
}
//echo 'OK';
}
?>
