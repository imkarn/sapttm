<?php

// function genGridView
function genGrid(array $rs){
    $tab = (isset($rs['TAB_ZT29AUTR'])? count($rs['TAB_ZT29AUTR']):0);
    $head = "";
    $hdata = "";
    $data = "";
    $tb = "<table width=\"90%\">";
    if($rs['EP_MESSAGE']!=""){
        $tb .= "<tr><td>".$rs['EP_MESSAGE']."</td></tr>";  
    }else if($tab>0){
        for($i=1;$i<=$tab;$i++){
            $data .= ($i!=1)? "<tr>":"";
            foreach ($rs['TAB_ZT29AUTR'][$i] as $key => $value) {
               if($i==1){
                   $head .= "<th>".$key."</th>";
                   $hdata .= "<td align=\"center\">".$value."</td>";
               }else{
                   $data .= "<td align=\"center\">".$value."</td>";
               }
            }
            $data .= ($i!=1)? "</tr>":"";
        }
    }
    $tb .= "<tr>".$head."</tr><tr>".$hdata."</tr>".$data;
    $tb .= "</table>";
    
    return $tb;
}
?>
