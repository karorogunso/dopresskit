<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title><?=$content->getTitle()?></title>
		<link href="http://cdnjs.cloudflare.com/ajax/libs/uikit/1.2.0/css/uikit.gradient.min.css" rel="stylesheet" type="text/css">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>

	<body>
		<div class="uk-container uk-container-center">
			<div class="uk-grid">
				<div id="navigation" class="uk-width-medium-1-4">
					<h1 class="nav-header"><?=$content->getTitle()?></h1>

					<a class="nav-header" href="<?=$content->getWebsite()->url()?>"><?=$content->getWebsite()->name()?></a>

					<ul class="uk-nav uk-nav-side">
						<?php if (count($content->getAdditionalInfo()->languages) > 1): ?>
							<li class="language-select">
								<a>
									<?=tl('Language: ')?>
									<select onchange="document.location = '<?= \Presskit\Helpers::url('?l=', '')?>' + this.value;">
										<?php foreach($content->getAdditionalInfo()->languages as $tag => $name): ?>
											<option value="<?=$tag?>" <?php if ($tag == $content->getAdditionalInfo()->language): ?>selected="selected"<?php endif; ?>><?= htmlspecialchars($name)?></option>
										<?php endforeach; ?>
									</select>
								</a>
							</li>
							<li class="uk-nav-divider"></li>
						<?php endif; ?>

						<li><a href="#factsheet"><?=tl('Factsheet')?></a></li>
						<li><a href="#description"><?=tl('Description')?></a></li>
						<li><a href="#history"><?=tl('History')?></a></li>
						<li><a href="#projects"><?=tl('Projects')?></a></li>
						<li><a href="#trailers"><?=tl('Videos')?></a></li>
						<li><a href="#images"><?=tl('Images')?></a></li>
						<li><a href="#logo"><?=tl('Logo & Icon')?></a></li>

						<?php if (count($content->getAwards()) > 0): ?>
							<li><a href="#awards"><?=tl('Awards & Recognition')?></a></li>
						<?php endif; ?>

						<?php if (count($content->getQuotes()) > 0): ?>
							<li><a href="#quotes"><?=tl('Selected Articles')?></a></li>
						<?php endif; ?>

						<?php if (count($content->getAdditionalLinks()) > 0): ?>
							<li><a href="#links"><?=tl('Additional Links')?></a></li>
						<?php endif; ?>

						<li><a href="#credits"><?=tl('Team')?></a></li>
						<li><a href="#contact"><?=tl('Contact')?></a></li>
					</ul>
				</div>

				<div id="content" class="uk-width-medium-3-4">
					<?php if (file_exists("images/header.png")): ?>
						<img src="images/header.png" class="header">
					<?php endif; ?>

					<div class="uk-grid">
						<div class="uk-width-medium-2-6">
							<h2 id="factsheet"><?=tl('Factsheet')?></h2>

							<p>
								<strong><?=tl('Developer:')?></strong><br/>
								<a href="<?=$content->getWebsite()->url()?>"><?=$content->getTitle()?></a><br/>
								<?=tl('Based in %s', $content->getLocation())?>
							</p>

							<p>
								<strong><?=tl('Founding date:')?></strong><br/>
								<?=$content->getFoundingDate()?>.
							</p>

							<p>
								<strong><?=tl('Website:')?></strong><br/>
								<a href="http://<?=$content->getWebsite()->url()?>"><?=$content->getWebsite()->name()?></a>
							</p>

							<p>
								<strong><?=tl('Press / Business Contact:')?></strong><br/>
								<a href="mailto:<?=$content->getPressContact()?>"><?=$content->getPressContact()?></a>
							</p>

							<p>
							  <strong><?=tl('Social:')?></strong><br/>

								<?php foreach($content->getSocialContacts() as $contact): ?>
									<a href="<?=$contact->uri()?>"><?=$contact->name()?></a><br/>
								<?php endforeach; ?>
							</p>

							<p>
								<strong><?=tl('Releases:')?></strong><br />

								<?php foreach ($content->getAdditionalInfo()->releases as $release): ?>
									<a href="<?=$release['url']?>"><?=$release['name']?></a><br/>
								<?php endforeach; ?>
							</p>

							<p>
								<?php if (count($content->getAddress()) > 0): ?>
									<strong><?=tl('Address:')?></strong><br/>
									<?php foreach($content->getAddress() as $addressLine): ?>
										<?=$addressLine?><br/>
									<?php endforeach; ?>
								<?php endif; ?>
							</p>

							<?php if (!empty($content->getPhone())): ?>
							<p>
								<strong><?=tl('Phone:')?></strong><br/>
								<?=$content->getPhone()?>
							</p>
							<?php endif; ?>
						</div>

						<div class="uk-width-medium-4-6">
							<h2 id="description"><?=tl('Description')?></h2>
							<p><?=$content->getDescription()?></p>

							<h2 id="history"><?=tl('History')?></h2>
							<?php foreach ($content->getHistory() as $history): ?>
								<strong><?=$history->heading()?></strong>
								<p><?=$history->body()?></p>
							<?php endforeach; ?>

							<?php if (count($content->getAdditionalInfo()->releases) > 0): ?>
							<h2 id="projects"><?=tl('Projects')?></h2>
							<ul>
								<?php foreach ($content->getAdditionalInfo()->releases as $release): ?>
									<li><a href="<?=$release['url']?>"><?=$release['name']?></a></li>
								<?php endforeach; ?>
							</ul>
							<?php endif; ?>
						</div>
					</div>

					<hr>

					<h2 id="trailers"><?=tl('Videos')?></h2>

					<?php if (count($content->getTrailers()) === 0): ?>
						<p><?=tlHtml('There are currently no trailers available for %s. Check back later for more or <a href="#contact">contact us</a> for specific requests!', $content->getTitle())?></p>
					<?php else: ?>
						<?php foreach ($content->getTrailers() as $trailer): ?>
							<p><strong><?=$trailer->name()?></strong>&nbsp;

							<?php foreach ($trailer->locations() as $index => $location): ?>

								<?php if ((string) $location->format() === 'youtube'): ?>
									<a href="<?=$location?>">Youtube</a><?php if ($index < (count($trailer->locations()) - 1)): ?>, <?php endif; ?>
								<?php endif; ?>

								<?php if ((string) $location->format() === 'vimeo'): ?>
									<a href="<?=$location?>">Vimeo</a><?php if ($index < (count($trailer->locations()) - 1)): ?>, <?php endif; ?>
								<?php endif; ?>

								<?php if ((string) $location->format() === 'mov'): ?>
									<a href="trailers/<?=$location?>">.mov</a><?php if ($index < (count($trailer->locations()) - 1)): ?>, <?php endif; ?>
								<?php endif; ?>

								<?php if ((string) $location->format() === 'mp4'): ?>
									<a href="trailers/<?=$location?>">.mp4</a><?php if ($index < (count($trailer->locations()) - 1)): ?>, <?php endif; ?>
								<?php endif; ?>
							<?php endforeach; ?>

							<?php if ((string) $trailer->youtube() !== ''): ?>
								<div class="uk-responsive-width iframe-container">
									<iframe src="http://www.youtube.com/embed/<?=$trailer->youtube()?>" frameborder="0" allowfullscreen></iframe>
								</div>
							<?php elseif ((string) $trailer->vimeo() !== ''): ?>
								<div class="uk-responsive-width iframe-container">
									<iframe src="http://player.vimeo.com/video/<?=$trailer->vimeo()?>" frameborder="0" allowfullscreen></iframe>
								</div>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>

					<hr>

					<h2 id="images"><?=tl('Images')?></h2>

					<?php if ($content->getAdditionalInfo()->images_archive_size != 0): ?>
						<a href="images/images.zip"><div class="uk-alert"><?=tl('download all screenshots & photos as .zip (%s)', $content->getAdditionalInfo()->images_archive_size)?></div></a>
					<?php endif; ?>

					<?php if (count($content->getAdditionalInfo()->images) > 0): ?>
						<div class="uk-grid images">
							<?php foreach ($content->getAdditionalInfo()->images as $image): ?>
								<div class="uk-width-medium-1-2">
									<a href="images/<?=$image?>"><img src="images/<?=$image?>" alt="<?=$image?>" /></a>
								</div>
							<?php endforeach; ?>
						</div>
					<?php else: ?>
						<div class="uk-width-medium-1-1">
							<p class="images-text"><?=tlHtml('There are far more images available for %s, but these are the ones we felt would be most useful to you. If you have specific requests, please do <a href="#contact">contact us</a>!', $content->getTitle())?></p>
						</div>
					<?php endif; ?>

					<hr>

					<h2 id="logo"><?=tl('Logo & Icon')?></h2>

					<?php if ($content->getAdditionalInfo()->logo_archive_size != 0): ?>
						<a href="<?=
							$content->getAdditionalInfo()->config->relativePath(
								$content->getAdditionalInfo()->config->imageLogoZipFilename
							)?>"><div class="uk-alert"><?=tl('download logo files as .zip (%s)', $content->getAdditionalInfo()->logo_archive_size)?></div></a>
					<?php endif; ?>

					<div class="uk-grid images">
						<?php if ($content->getAdditionalInfo()->logo !== NULL): ?>
							<div class="uk-width-medium-1-2"><a href="<?=$content->getAdditionalInfo()->logo?>"><img src="<?=$content->getAdditionalInfo()->logo?>" alt="logo" /></a></div>
						<?php endif; ?>

						<?php if ($content->getAdditionalInfo()->icon !== NULL): ?>
							<div class="uk-width-medium-1-2"><a href="<?=$content->getAdditionalInfo()->icon?>"><img src="<?=$content->getAdditionalInfo()->icon?>" alt="icon" /></a></div>
						<?php endif; ?>
					</div>

					<?php if ($content->getAdditionalInfo()->logo === NULL && $content->getAdditionalInfo()->icon === NULL): ?>
						<p><?=tlHtml('There are currently no logos or icons available for %s. Check back later for more or <a href="#contact">contact us</a> for specific requests!', $content->getTitle())?></p>
					<?php endif; ?>

					<hr>

					<?php if (count($content->getAwards()) > 0): ?>
						<h2 id="awards"><?=tl('Awards & Recognition')?></h2>

						<ul>
							<?php foreach ($content->getAwards() as $award): ?>
								<li><?=$award->award()?> - <cite><?=$award->description()?></cite></li>
							<?php endforeach; ?>
						</ul>

						<hr>
					<?php endif; ?>

					<?php if (count($content->getQuotes()) > 0): ?>
						<h2 id="quotes"><?=tl('Selected Articles')?></h2>

						<ul>
							<?php foreach ($content->getQuotes() as $quote): ?>
								<li>
									<?=$quote->description()?><br/>
									<cite>- <?=$quote->name()?><?php if ((string) $quote->website() !== ''): ?>, <a href="<?=$quote->website()->url()?>"><?=$quote->websiteName()?></a><?php endif; ?></cite>
								</li>
							<?php endforeach; ?>
						</ul>

						<hr>
					<?php endif; ?>

					<?php if (count($content->getAdditionalLinks()) > 0): ?>
						<h2 id="links"><?=tl('Additional Links')?></h2>

						<?php foreach ($content->getAdditionalLinks() as $additionaLink): ?>
							<p>
								<strong><?=$additionaLink->title()?></strong><br/>
								<?=$additionaLink->description()?> <a href="<?=$additionaLink->website()->url()?>"><?=$additionaLink->website()->name()?></a>.
							</p>
						<?php endforeach; ?>

						<hr>
					<?php endif; ?>

					<div class="uk-grid">
						<div class="uk-width-medium-1-2">
							<h2 id="credits"><?=tl('Team & Repeating Collaborators')?></h2>

							<?php foreach ($content->getCredits() as $credit): ?>
								<p>
									<?php if ((string) $credit->website() === ''): ?>
										<strong><?=$credit->name()?></strong><br/>
										<?=$credit->role()?>
									<?php else: ?>
										<strong><?=$credit->name()?></strong><br/>
										<a href="<?=$credit->website()->url()?>"><?=$credit->role()?></a>
									<?php endif; ?>
								</p>
							<?php endforeach; ?>
						</div>

						<div class="uk-width-medium-1-2">
							<h2 id="contact"><?=tl('Contact')?></h2>

							<?php foreach($content->getContacts() as $contact): ?>
								<p>
									<strong><?=$contact->name()?></strong><br/>
									<?php if ((string) $contact->website() !== ''): ?>
										<a href="<?=$contact->website()->url()?>">
											<?php if ((string) $contact->website()->path() !== ''): ?>
												<?=$contact->website()->name()?><?=$contact->website()->path()?>
											<?php else: ?>
												<?=$contact->website()->name()?>
											<?php endif; ?>
										</a>
									<?php elseif ((string) $contact->uri() !== ''): ?>
										<a href="<?=$contact->uri()?>"><?=$contact->uri()?></a>
									<?php elseif ((string) $contact->email() !== ''): ?>
										<a href="mailto:<?=$contact->email()?>"><?=$contact->email()?></a>
									<?php endif; ?>
								</p>
							<?php endforeach; ?>
						</div>
					</div>

					<hr>

					<p><a href="http://dopresskit.com/">presskit()</a> by Rami Ismail (<a href="http://www.vlambeer.com/">Vlambeer</a>)
						- also thanks to <a href="<?=  \Presskit\Helpers::url('/?p=', '/').\Presskit\Request::REQUEST_CREDITS_PAGE;?>">these fine folks</a>.</p>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.imagesloaded/3.0.4/jquery.imagesloaded.js"></script>
		<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/masonry/3.1.2/masonry.pkgd.min.js"></script>
		<script type="text/javascript">
			$( document ).ready(function() {
				var container = $('.images');

			container.imagesLoaded( function() {
				container.masonry({
					itemSelector: '.uk-width-medium-1-2',
				});
			});
		});
		</script>

		<?php if ($content->getAdditionalInfo()->google_analytics !== null): ?>
			<script type="text/javascript">
				var _gaq = _gaq || [];
				_gaq.push(['_setAccount', '<?=$company['google_analytics']?>');
				_gaq.push(['_trackPageview']);

				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
			</script>
		<?php endif; ?>
	</body>
</html>
