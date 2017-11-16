	<footer class="footer">
		<div class="footer-content">
			<p class="footer-element">2016 &copy; </p>
			<a href="http://sustainablecorvallis.org/" class="footer-element">Corvallis Sustainability Coalition</a>
			<p class="footer-element"> | </p>
			<a href="mailto:info@sustainablecorvallis.org?Subject=Reuse%20And%20Repair%20Directory"
			   target="_top"
			   class="footer-element">
				info@sustainablecorvallis.org
			</a>
		</div>
	</footer>

	</div>

    <!-- jQuery required for proper page rendering (It would be nice to not rely on jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <?php if ($this->data['preJsSpecial']): ?>
        <?php foreach ($this->data['preJsSpecial'] as $js): ?>
            <!--  Inject JS that needs to run before other scripts  -->
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if ($this->data['hasMap']): ?>
	    <!-- Inject map stuff if needed -->
        <script src="/js/mapFunct.js" type="text/javascript"></script>
        <script defer
                src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDiF8JALjnfAymACLHqPAhlrLlUj3y9DTo&callback=initJsonMap">
        </script>
    <?php endif; ?>

	<?php if ($this->data['postJsSpecial']): ?>
        <?php foreach ($this->data['postJsSpecial'] as $js): ?>
            <!--  inect JS that needs to run after other scripts  -->
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
	<?php endif; ?>

</body>
</html>