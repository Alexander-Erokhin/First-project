<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php if(isset($data['data_bd_view'][0]['title'])) echo $data['data_bd_view'][0]['title']." - "; echo SAIT_NAME; ?></title>
	<meta name="description" content="{head_description}">
	<meta name="Keywords" content="{head_keywords}">
	<link rel="stylesheet" href="/css/style.css">
	<!--[if lte IE 8]><link rel="stylesheet" type="text/css" href="/css/style-ie8.css"><![endif]-->
		<script src="/js/jquery.js"></script>
	<script defer src="/js/all_javascript.js"></script>
</head>
<body>
	<div id="container">
		<div id="up_header">
			<div class="sin"></div><div class="kras"></div><div class="zel"></div><div class="oran"></div>
		</div>
		<div id="header">
			<div id="logo">
				<a href="/"><img src="/images/logo.png" alt="Страна Моторов"></a>
			</div>
			<div id="cont"><?php echo CONT_TEL2?><br><?php echo CONT_TEL1?><br><span>Мы работаем круглосуточно, без выходных</span></div>
			<div id="nav" class="clear">
				<ul>
					<li class="cher"><a href="/o_nas">О компании</a>
					<li class="sin"><a href="/dvigateli_dlya_legkovyh">Двигатели для легковых</a>
					<li class="kras"><a href="/kpp_dlya_legkovyh">КПП для легковых</a>
					<li class="zel"><a href="/dvigateli_dlya_gruzovyh">Двигатели для грузовых</a>
					<li class="oran"><a href="/kabiny_dlya_gruzovyh">Кабины для грузовых</a>
					<li class="cher"><a href="/kontakty">Контакты</a>
				</ul>
			</div>
		</div>
		<div id="content">
				<?php include 'application/views/'.$content_view; 
				
				?>
		</div>
		<div id="footer">
			<div class="footer_in sin">
				<p>Для легковых</p>
				<ul>
					<li><a href="/dvigateli_dlya_legkovyh">Двигатели</a>
					<li><a href="/kpp_dlya_legkovyh">КПП</a>
				</ul>
				<p>Для грузовых</p>
				<ul>
					<li><a href="/dvigateli_dlya_gruzovyh">Двигатели</a>
					<li><a href="/kabiny_dlya_gruzovyh">Кабины</a>
				</ul>
			</div><!--
			--><div class="footer_in kras">
				<p>Информация</p>
				<ul>
					<li><a href="/dokumenty">Документы</a>
					<li><a href="/garantiya">Гарантия</a>
					<li><a href="/stati">Статьи</a>
					<li><a href="/otzivi">Отзывы</a>
				</ul>
			</div><!--
			--><div class="footer_in zel">
				<p>Услуги</p>
				<ul>
					<li><a href="/dostavka">Доставка</a>
					<li><a href="/partneram">Партнерам</a>
					<li><a href="/avtoservis">Автосервис</a>
				</ul>
			</div><!--
			--><div class="footer_in oran">
				<p>Контакты</p>
				<ul>
					<li>Тел: <?php echo CONT_TEL2; ?>
					<li>Тел: <?php echo CONT_TEL1; ?>
					<li>E-mail: <?php echo CONT_EMAIL1; ?>
					<li><?php echo CONT_ADRESS;?></li>
				</ul>
			</div>
			<div id="footer_sub">
				<div id="footer_sub_left">© <?php echo $_SERVER['HTTP_HOST']?>, 2008--<?php echo date("Y"); ?></div>
				<div id="footer_sub_right"><?php echo CONT_TEL2; ?><br><?php echo CONT_TEL1; ?></div>
				<div class="clear"></div>
			</div>
		</div>
	</div>
	<!-- {literal} -->
	<!-- {/literal} -->
	<!-- Yandex.Metrika counter -->
	<!-- /Yandex.Metrika counter -->
</body>
</html>