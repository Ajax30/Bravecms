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
<?php if ($is_cookieconsent == true): ?>
	<script>
		window.cookieconsent.initialise({
    container: document.getElementById("cookieconsent"),
    palette:{
     popup: {background: "#0068BB"},
     button: {background: "#fff"},
    },
    revokable: true,
    onStatusChange: function(status) {
     console.log(this.hasConsented() ?
      'enable cookies' : 'disable cookies');
    },
    "position": "bottom-left",
    "theme": "classic",
    "secure": true,
    "content": {
      "header": 'Cookies used on the website!',
      "message": 'This website uses cookies to improve your experience.',
      "dismiss": 'Got it!',
      "allow": 'Allow cookies',
      "deny": 'Decline',
      "link": 'Learn more',
      "close": '&#x274c;',
      "policy": 'Cookie Policy',
      "target": '_blank',
      }
   });
	</script>
  <?php endif ?>
</body>
</html>