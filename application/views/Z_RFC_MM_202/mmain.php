	<?php if($per!=true){ ?>
	<article>
		<section>
			<div class="block-content">
				<h1>แสดงรายละเอียด</h1>
					 <?php echo $tb;?>
			</div>
		</section>
	</article>
	<?php }else{ ?>
		<article>
			<p class="message error full-width">สิทธิ์ของคุณไม่สามารถเข้าใช้งานส่วนนี้ได้  <strong>หากมีข้อสงสัยกรุณาติดต่อ แผนกสารสนเทศ 2331, 2339</strong></p>
		</article>
	<?php } ?>
</body>
</html>