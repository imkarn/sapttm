<?php

// function genGridView
function genGrid(array $rs,array $opt,$tbhead=null){
    $tab = (isset($rs[$opt['tbname']])? count($rs[$opt['tbname']]):0);
    $head = "";
    $hdata = "";
    $data = "";
	$theme = (isset($opt['theme'])? $opt['theme']:"");
	$mb = (isset($opt['mobile'])? $opt['mobile']:"");
	$act = (isset($opt['action'])? $opt['action']:"");
	$wact = (isset($opt['action']['width'])? 'width="'.$opt['action']['width'].'"':'');
	$spk = (isset($opt['key'])? $opt['key']:"");
	$fun = (isset($opt['fun'])? $opt['fun']:"");
	$uni = (isset($opt['uni']) and isset($opt['key']))? $opt['key']:"";
    $tb = ($theme=="")? '<table width="100%" cellspacing="0">':'<table width="100%" cellspacing="0" class="table">';
    if($rs['EP_MESSAGE']!=""){
        $tb .= "<tr><td>".$rs['EP_MESSAGE']."</td></tr>";  
    }else if($tab>0){
		if($mb!=""){
			$tmp=0;
			$ft=0;
			for($i=1;$i<=$tab;$i++){
				$pk = 0;
				foreach ($rs[$opt['tbname']][$i] as $key => $value) {
					if($key==$uni){
						if($tmp==$value){
							break;
						}else{
							$data .= ($i!=1)? '<tr rel="m'.$value.'">':'';
							$tmp=$value;
						}
					}
					if($key==$spk){
						$pk = $value;
						if($i==1){
							if($key==$spk){$ft = $value;}
								if($tbhead!=null){
									$head .= ($theme=="")? '<th>'.$tbhead[$key].'</th>':'<th scope="col">'.$tbhead[$key].'</th>';
								}else{
									$head .= ($theme=="")? '<th>'.$key.'</th>':'<th scope="col">'.$key.'</th>';
								}
							$hdata .= ($key==$spk and $fun=="Z_RFC_MM_202")? '<td align="center"><a href="javascript:void(0)" onclick="detailModal('.$pk.')">'.$value.'</a></td>':'<td align="center">'.$value.'</td>';
						}else{
							$data .= ($key==$spk and $fun=="Z_RFC_MM_202")? '<td align="center"><a href="javascript:void(0)" onclick="detailModal('.$pk.')">'.$value.'</a></td>':'<td align="center">'.$value.'</td>';
						}
					}
				}
				if($pk!=0){
					$hdata .= ($i==1 and $act!="")? '<td class="table-actions" '.$wact.'>':'';
					$hdata .= ($i==1 and $act!="" and $fun=="Z_RFC_MM_202")? '<input type="checkbox" name="approve'.$pk.'" onClick="javasctipt:Approve(\''.$pk.'\')" id="approve'.$pk.'" value="1" class="switch with-tip" title="Approve/Not Approved switch" style="display: none;">':'';
					//$hdata .= ($i==1 and $act!="" and $fun=="Z_RFC_MM_202")? '<input type="radio" onclick="javascript:Approve(\''.$pk.'\')" name="'.$pk.'" id="'.$pk.'-1" value="1"><label for="'.$pk.'-1">Approve</label><input type="radio" onclick="javascript:NotApprove(\''.$pk.'\')" name="'.$pk.'" id="'.$pk.'-0" value="0"> <label for="'.$pk.'-0">Not Approve</label>':'';
					$hdata .= ($i==1 and $act!="")? '</td>':'';
					
					$data .= ($i!=1 and $act!="")? '<td class="table-actions" '.$wact.'>':'';
					$data .= ($i!=1 and $act!="" and $fun=="Z_RFC_MM_202")? '<input type="checkbox" name="approve'.$pk.'" onClick="javasctipt:Approve(\''.$pk.'\')" id="approve'.$pk.'" value="1" class="switch with-tip" title="Approve/Not Approved switch" style="display: none;">':'';
					$data .= ($i!=1 and $act!="")? '</td>':"";
					$data .= ($i!=1)? '</tr>':'';
				}
			}
			$bh = ($act=="")? '':'<th scope="col" class="table-actions">Actions</th>';
			$tb .= '<thead><tr>'.$head.$bh.'</tr></thead><tbody><tr rel="m'.$ft.'">'.$hdata.'</tr>'.$data.'</tbody>';
			$tb .= '</table>';
		
			return $tb;
		}else{
			$tmp=0;
			$ft=0;
			for($i=1;$i<=$tab;$i++){
				$pk = 0;
				foreach ($rs[$opt['tbname']][$i] as $key => $value) {
					if($key==$uni){
						if($tmp==$value){
							break;
						}else{
							$data .= ($i!=1)? '<tr rel="m'.$value.'">':'';
							$tmp=$value;
						}
					}
					if($key==$spk){$pk = $value;}
					if($i==1){
						if($key==$spk){$ft = $value;}
							if($tbhead!=null){
								$head .= ($theme=="")? '<th>'.$tbhead[$key].'</th>':'<th scope="col">'.$tbhead[$key].'</th>';
							}else{
								$head .= ($theme=="")? '<th>'.$key.'</th>':'<th scope="col">'.$key.'</th>';
							}
						$hdata .= ($key==$spk and $fun=="Z_RFC_MM_202")? '<td align="center"><a href="javascript:void(0)" onclick="detailModal('.$pk.')">'.$value.'</a></td>':'<td align="center">'.$value.'</td>';
					}else{
						$data .= ($key==$spk and $fun=="Z_RFC_MM_202")? '<td align="center"><a href="javascript:void(0)" onclick="detailModal('.$pk.')">'.$value.'</a></td>':'<td align="center">'.$value.'</td>';
					}
				}
				if($pk!=0){
					$hdata .= ($i==1 and $act!="")? '<td class="table-actions" '.$wact.'>':'';
					$hdata .= ($i==1 and $act!="" and isset($act['v']))? '<a href="'.$act['v'].'/'.$pk.'" title="View" class="with-tip"><img src="'.base_url().'images/icons/fugue/balloon.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$hdata .= ($i==1 and $act!="" and isset($act['e']))? '<a href="'.$act['e'].'/'.$pk.'" title="Edit" class="with-tip"><img src="'.base_url().'images/icons/fugue/pencil.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$hdata .= ($i==1 and $act!="" and isset($act['d']))? '<a href="'.$act['d'].'/'.$pk.'" title="Delete" class="with-tip"><img src="'.base_url().'images/icons/fugue/cross-circle.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$hdata .= ($i==1 and $act!="" and isset($act['o']))? '<a href="'.$act['o'].'/'.$pk.'" title="Option" class="with-tip"><img src="'.base_url().'images/icons/fugue/tick-circle-blue.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$hdata .= ($i==1 and $act!="" and $fun=="Z_RFC_MM_202")? '<input type="checkbox" name="approve'.$pk.'" onClick="javasctipt:Approve(\''.$pk.'\')" id="approve'.$pk.'" value="1" class="switch with-tip" title="Approve/Not Approved switch" style="display: none;">':'';
					//$hdata .= ($i==1 and $act!="" and $fun=="Z_RFC_MM_202")? '<input type="radio" onclick="javascript:Approve(\''.$pk.'\')" name="'.$pk.'" id="'.$pk.'-1" value="1"><label for="'.$pk.'-1">Approve</label><input type="radio" onclick="javascript:NotApprove(\''.$pk.'\')" name="'.$pk.'" id="'.$pk.'-0" value="0"> <label for="'.$pk.'-0">Not Approve</label>':'';
					$hdata .= ($i==1 and $act!="")? '</td>':'';
					
					$data .= ($i!=1 and $act!="")? '<td class="table-actions" '.$wact.'>':'';
					$data .= ($i!=1 and $act!="" and isset($act['v']))? '<a href="'.$act['v'].'/'.$pk.'" title="View" class="with-tip"><img src="'.base_url().'images/icons/fugue/balloon.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$data .= ($i!=1 and $act!="" and isset($act['e']))? '<a href="'.$act['e'].'/'.$pk.'" title="Edit" class="with-tip"><img src="'.base_url().'images/icons/fugue/pencil.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$data .= ($i!=1 and $act!="" and isset($act['d']))? '<a href="'.$act['d'].'/'.$pk.'" title="Delete" class="with-tip"><img src="'.base_url().'images/icons/fugue/cross-circle.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$data .= ($i!=1 and $act!="" and isset($act['o']))? '<a href="'.$act['o'].'/'.$pk.'" title="Option" class="with-tip"><img src="'.base_url().'images/icons/fugue/tick-circle-blue.png" width="16" height="16"></a>&nbsp;&nbsp;':'';
					$data .= ($i!=1 and $act!="" and $fun=="Z_RFC_MM_202")? '<input type="checkbox" name="approve'.$pk.'" onClick="javasctipt:Approve(\''.$pk.'\')" id="approve'.$pk.'" value="1" class="switch with-tip" title="Approve/Not Approved switch" style="display: none;">':'';
					$data .= ($i!=1 and $act!="")? '</td>':"";
					$data .= ($i!=1)? '</tr>':'';
				}
			}
			$bh = ($act=="")? '':'<th scope="col" class="table-actions">Actions</th>';
			$tb .= '<thead><tr>'.$head.$bh.'</tr></thead><tbody><tr rel="m'.$ft.'">'.$hdata.'</tr>'.$data.'</tbody>';
			$tb .= '</table>';
		
			return $tb;
		}
    }else{
		$tb .= "<tr><td><b>ไม่พบข้อมูล</b></td></tr>";  
		$tb .= '</table>';
		return $tb;
	}
}
?>
