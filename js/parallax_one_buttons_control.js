jQuery(document).ready(function() {
	
	jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section parallax-upsells"></li>');
	
	jQuery('.parallax-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="https://github.com/Codeinwp/llorix-one" class="button" target="_blank">{github}</a>'.replace('{github}',objectL10n.github));
});