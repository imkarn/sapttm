<!-- Content -->
<article class="container_12">
	<?php if($per!=true){ ?>
    <section class="grid_12">
        <div class="block-border">
            <div class="block-content">
                <h1>แสดงรายละเอียด</h1>
                    <ul class="shortcuts-list">
                    <?php echo $tb;?>
					</ul>
			</div>
        </div>
    </section>
	<script>
	$(function() {
		$('#model').hide();
	});
	function detailModal(id){
		$('#model').modal({
			title: 'แสดงรายละเอียดย่อย',
			width: '80%',
			closeButton:false,
			buttons: {
				'ปิด': function(win) { win.closeModal(); }
			},
			onOpen: function( event, ui ) {
				$("[class^='cs']").hide();
				$(".cs"+id).show();
			}
		});
	}
	function Approve(id){
		$.modal({
			content: '<p>คุณต้องการอนุมัติ PrNo.'+id+' นี้ใช่หรือไม่</p>',
			title: 'ยืนยันการอนุมัติ',
			maxWidth: '50%',
			closeButton:false,
			buttons: {
                'ตกลง': function(win) {
					$.ajax({
						url: "<?php echo site_url('Z_RFC_MM/Z_RFC_MM_201');?>",
						type: "POST",
						data: "id="+id+"&ran="+Math.random(),
						cache: false,
						async: false,
						success: function(data){
							if(data=="NP"){
								win.closeModal(); 
								alert("ERROR : permission denied หากมีข้อสงสัยกรุณาติดต่อ แผนกสารสนเทศ 2331, 2339");
								$('input:checkbox[name=approve'+id+']:nth(0)').attr('checked',false);
							}else if(data=="NA"){
								win.closeModal(); 
								alert("ERROR : Not Authen หากมีข้อสงสัยกรุณาติดต่อ แผนกสารสนเทศ 2331, 2339");
								$('input:checkbox[name=approve'+id+']:nth(0)').attr('checked',false);
							}else if(data=="SU"){
								win.closeModal();
								$('tr[rel=m'+id+']').remove();
								alert("ทำการอนุมัตืเรียบร้อยแล้ว");
							}else{
								win.closeModal(); 
								alert(data+" หากมีข้อสงสัยกรุณาติดต่อ แผนกสารสนเทศ 2331, 2339");
								$('input:checkbox[name=approve'+id+']:nth(0)').attr('checked',false);
							}
						}
					});
				},
				'ยกเลิก': function(win) {
					$('input:checkbox[name=approve'+id+']:nth(0)').attr('checked',false);
					win.closeModal(); 
				}
            }
		});
	}
</script>
<div id="model" align="center">
	<table width="80%" cellspacing="0" class="table" id="subtb">
<?php
		$head = "";
		$stb = "";
		$hstb = "";
		$first = 0;
		for($i=1;$i<=count($rs['TAB_DISPLAY_202']);$i++){
			$css = ($i!=1)? '<tr class="':'';
			$sstb = "";
			foreach ($rs['TAB_DISPLAY_202'][$i] as $key => $value) {
				if($i==1){
					
					if($key=="BANFN"){$first = $value;}
					$head .= '<th scope="col">'.$key.'</th>';
					$hstb .= '<td align="center">'.$value.'</td>';
				}else{
					if($key=="BANFN"){$css .= 'cs'.$value.'">';}
					$sstb .= '<td align="center">'.$value.'</td>';
				}
			}
			$stb .= $css.$sstb;
			$stb .= ($i!=1)? '</tr>':'';
		}
		echo '<thead><tr>'.$head.'</tr></thead><tbody><tr class="cs'.$first.'">'.$hstb.'</tr>'.$stb.'</tbody>';
?>
	</table>
</div>
	<?php }else{?>
	<p class="message error grid_12">สิทธิ์ของคุณไม่สามารถเข้าใช้งานส่วนนี้ได้  <strong>หากมีข้อสงสัยกรุณาติดต่อ แผนกสารสนเทศ 2331, 2339</strong></p>
	<?php }?>
    <div class="clear"></div>
</article>
</body>
</html>