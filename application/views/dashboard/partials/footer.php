	<div class="site-footer-wrapper" id="siteFooter">
		<div class="footer-copyright">
			<p class="text-center">&copy; <?php echo $company_name; ?>. All rights reserved</p>
		</div>
	</div>
</div>
<script>var baseUrl = '<?= base_url(); ?>';</script>
<script src="<?php echo base_url('assets/js/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/popper.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/js/app.js')?>"></script>
<?php if ($is_ckeditor == true): ?>
	<script>CKEDITOR.replace('body');</script>
<?php endif ?>
</body>
</html>