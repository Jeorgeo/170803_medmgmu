<?php
	$contacts = get_posts( array(
		'numberposts'     => 2,
		'offset'          => 0,
		'category'        => '',
		'include'         => '',
		'exclude'         => '',
		'meta_key'        => '',
		'meta_value'      => '',
		'post_type'       => 'contacts',
		'post_parent'     => '',
		'post_status'     => 'publish'
	) );
	foreach( $contacts as $index=>$obj ){
		$contacts[ $index]->sort = get_field('sort', $obj->ID);
	}
	usort( $contacts, 'cmp_sort');
?>

	<div id="contacts" class="contact">
		<div class="row">
			<div class="col-md-12">
				<h1>Контакты</h1>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="metrof active" data-metro="m1">
					<svg version="1.1" id="metro1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 36.8 37.4" style="enable-background:new 0 0 36.8 37.4;width:22px;height:23px;" xml:space="preserve"><circle id="XMLID_2312_" class="metro11" cx="18.4" cy="18.5" r="18.5"/><g><path class="metro12" d="M7.1,28.4l3-21.1h0.3l8.6,17.3l8.5-17.3h0.3l3,21.1h-2.1l-2.1-15.1l-7.5,15.1h-0.5l-7.6-15.2L9.2,28.4H7.1z"/></g></svg>
					<p><?php echo get_field('metro',$contacts[ 0]->ID); ?></p>
				</div>
			</div>
			<?php if( isset($contacts[ 1]->ID) ) { ?>
			<div class="col-md-3 col-sm-6 col-xs-6">
				<div class="metrof" data-metro="m2">
					<svg version="1.1" id="metro2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 36.8 37.4" style="enable-background:new 0 0 36.8 37.4;width:22px;height:23px;" xml:space="preserve"><circle id="XMLID_2312_" class="metro21" cx="18.4" cy="18.5" r="18.5"/><g><path class="metro22" d="M7.1,28.4l3-21.1h0.3l8.6,17.3l8.5-17.3h0.3l3,21.1h-2.1l-2.1-15.1l-7.5,15.1h-0.5l-7.6-15.2L9.2,28.4H7.1z"/></g></svg>
					<p><?php echo get_field('metro',$contacts[ 1]->ID); ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="row mapBlock" id="m1">
			<div class="col-sm-12">
				<div class="col-sm-3">
					<h2>Телефон:</h2>
					<?php
					$phone1 = get_field('phones',$contacts[ 0]->ID);
					$phone1 = explode(',', $phone1);
					$phone1[0] = strip_tags( $phone1[0]);
					//$phone1[1] = strip_tags( $phone1[1]);
					?>
					<a style="color: <?php echo get_field('phone_color_span',$contacts[ 0]->ID); ?>;" href="tel:<?php echo strip_tags(str_replace(' ','', str_replace('-','', str_replace('(','', str_replace(')','', $phone1[0]))))); ?>"><?php echo $phone1[0]; ?></a>
					<a style="color: <?php echo get_field('phone_color_span',$contacts[ 0]->ID); ?>;" href="tel:<?php echo strip_tags(str_replace(' ','', str_replace('-','', str_replace('(','', str_replace(')','', $phone1[1]))))); ?>"><?php echo $phone1[1]; ?></a>
					<h2>Адрес:</h2>
					<p style="color: <?php echo get_field('address_color',$contacts[ 0]->ID); ?>;"><?php echo get_field('address',$contacts[ 0]->ID); ?></p>
					<h2>e-mail:</h2>
					<a style="color: <?php echo get_field('phone_color_span',$contacts[ 0]->ID); ?>;" href="mailto:<?php echo get_field('email',$contacts[ 0]->ID); ?>"><?php echo get_field('email',$contacts[ 0]->ID); ?></a>
				</div>
				<div class="col-sm-9">
					<div class="map" id="map1"></div>
				</div>
			</div>
		</div>
		<div class="row mapBlock" id="m2">
			<div class="col-sm-12">
				<div class="col-sm-3">
					<h2>Телефон:</h2>
					<?php
					$phone1 = get_field('phones',$contacts[ 1]->ID);
					$phone1 = explode(',', $phone1);
					$phone1[0] = strip_tags( $phone1[0]);
					//$phone1[1] = strip_tags( $phone1[1]);
					?>
					<a style="color: <?php echo get_field('phone_color_span',$contacts[ 1]->ID); ?>;" href="tel:<?php echo strip_tags(str_replace(' ','', str_replace('-','', str_replace('(','', str_replace(')','', $phone1[0]))))); ?>"><?php echo $phone1[0]; ?></a>
					<a style="color: <?php echo get_field('phone_color_span',$contacts[ 1]->ID); ?>;" href="tel:<?php echo strip_tags(str_replace(' ','', str_replace('-','', str_replace('(','', str_replace(')','', $phone1[1]))))); ?>"><?php echo $phone1[1]; ?></a>
					<h2>Адрес:</h2>
					<p style="color: <?php echo get_field('address_color',$contacts[ 1]->ID); ?>;"><?php echo get_field('address',$contacts[ 1]->ID); ?></p>
					<h2>e-mail:</h2>
					<a style="color: <?php echo get_field('phone_color_span',$contacts[ 1]->ID); ?>;" href="mailto:<?php echo get_field('email',$contacts[ 1]->ID); ?>"><?php echo get_field('email',$contacts[ 1]->ID); ?></a>
				</div>
				<div class="col-sm-9">
					<div class="map" id="map2"></div>
				</div>
			</div>
		</div>
	</div>

</div><!-- .site -->

<footer>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<p>Сеть медицинских центров «<span>ЛАБМГМУ</span>» Ежедневно <span><?php echo get_option('gl_time'); ?></span></p>
				<div class="metro a">
					<svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 36.8 37.4" style="enable-background:new 0 0 36.8 37.4;width:13px;height:13px;" xml:space="preserve">
                            <style type="text/css">
								.stfooter0{stroke: #fff;fill: transparent;}
								.stfooter1{fill:#FFFFFF;}
							</style>
						<circle id="XMLID_2312_" class="stfooter0" cx="18.4" cy="18.5" r="18.5"/>
						<g>
							<path class="stfooter1" d="M7.1,28.4l3-21.1h0.3l8.6,17.3l8.5-17.3h0.3l3,21.1h-2.1l-2.1-15.1l-7.5,15.1h-0.5l-7.6-15.2L9.2,28.4H7.1z"/>
						</g>
                            </svg>
					<p><?php echo get_field('metro',$contacts[ 0]->ID); ?></p>
				</div>
				<?php
				$phone = get_field('phones',$contacts[ 0]->ID);
				$phone = explode(',', $phone);
				$phone[0] = strip_tags( $phone[0]);
				//$phone[1] = strip_tags( $phone[1]);
				//$phone[0] = str_replace(array('(',')'),'',$phone[0]);
				//$phone[1] = str_replace(array('(',')'),'',$phone[1]);
				?>
				<p><?php echo get_field('address',$contacts[ 0]->ID); ?> <a href="tel:<?php echo str_replace(array('(',')',' ','-'),'',$phone[0]); ?>"><?php echo $phone[0]; ?></a> <a href="tel:<?php echo strip_tags(str_replace(array('(',')',' ','-'),'',$phone[1])); ?>"><?php echo $phone[1]; ?>.</a></p>

				<?php if( isset($contacts[ 1]->ID) ) { ?>
				<div class="metro b">
					<svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 viewBox="0 0 36.8 37.4" style="enable-background:new 0 0 36.8 37.4;width:13px;height:13px;" xml:space="preserve">
                            <circle id="XMLID_2312_" class="stfooter0" cx="18.4" cy="18.5" r="18.5"/>
						<g>
							<path class="stfooter1" d="M7.1,28.4l3-21.1h0.3l8.6,17.3l8.5-17.3h0.3l3,21.1h-2.1l-2.1-15.1l-7.5,15.1h-0.5l-7.6-15.2L9.2,28.4H7.1z"/>
						</g>
                            </svg>
					<p><?php echo get_field('metro',$contacts[ 1]->ID); ?></p>
				</div>
				<?php
				$phone = get_field('phones',$contacts[ 1]->ID);
				$phone = explode(',', $phone);
				$phone[0] = strip_tags( $phone[0]);
				?>
				<p><?php echo get_field('address',$contacts[ 1]->ID); ?> <a href="tel:<?php echo $phone[0]; ?>"><?php echo $phone[0]; ?></a> <a href="tel:<?php echo $phone[1]; ?>"><?php echo $phone[1]; ?>.</a></p>
				<?php } ?>
                <div class="regulation_on_protection">
                    <a href="/polozhenie-o-zashhite-personalnyih-dannyih/">Положение о защите персональных данных</a>
                </div>
			</div>
			<div class="col-md-4 copyright">
				<p>Запрещается полное или частичное копирование материала, <br>без активной ссылки на сайт. © Все права защищены</p>
				<p>ООО «Аладея-Мед». ОГРН:1125024005590. ИНН:5024130142. КПП:502401001.</p>
				<p>Разработка и поддержка сайта: Медиа агентство <span><a href="http://labmgmu-media.ru" target="_blank">«LABMGMU-Media»</a></span></p>
			</div>
		</div>
	</div>
</footer>

<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=<?php echo get_field('map',$contacts[ 0]->ID); ?>&width=100%&lang=ru_RU&sourceType=constructor&scroll=false&id=map1"></script>
<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=<?php echo get_field('map',$contacts[ 1]->ID); ?>&width=100%&lang=ru_RU&sourceType=constructor&scroll=false&id=map2"></script>

<?php //wp_footer(); ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-84758638-1', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

/* Accurate bounce rate by time */
if (!document.referrer ||
document.referrer.split('/')[2].indexOf(location.hostname) != 0)
setTimeout(function(){
ga('send', 'event', 'Новый посетитель', location.pathname);
}, 15000);
</script>
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (d, w, c) {
        (w[c] = w[c] || []).push(function() {
            try {
                w.yaCounter39828955 = new Ya.Metrika({
                    id:39828955,
                    clickmap:true,
                    trackLinks:true,
                    accurateTrackBounce:true,
                    webvisor:true
                });
            } catch(e) { }
        });

        var n = d.getElementsByTagName("script")[0],
            s = d.createElement("script"),
            f = function () { n.parentNode.insertBefore(s, n); };
        s.type = "text/javascript";
        s.async = true;
        s.src = "https://mc.yandex.ru/metrika/watch.js";

        if (w.opera == "[object Opera]") {
            d.addEventListener("DOMContentLoaded", f, false);
        } else { f(); }
    })(document, window, "yandex_metrika_callbacks");
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/39828955" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- /Yandex.Metrika counter -->
<script src="<?php bloginfo("template_directory"); ?>/js/accordion.js"></script>
</body>
</html>
