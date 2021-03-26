<?php if( _hui('layout') == '1' ) return; ?>
<div class="sidebar">
<?php 
	_moloader('mo_notice', false);
	
	if (function_exists('dynamic_sidebar')){
		dynamic_sidebar('gheader'); 

		if (is_home()){
			dynamic_sidebar('home'); 
		}
		elseif ( function_exists('is_woocommerce') && function_exists('is_product') && is_product() ){
			dynamic_sidebar('wooproduct'); 
		}
		elseif (is_category()){
			dynamic_sidebar('cat'); 
		}
		elseif (is_tax('topic')){
			dynamic_sidebar('topic'); 
		}
		elseif (is_tag() ){
			dynamic_sidebar('tag'); 
		}
		elseif (is_search()){
			dynamic_sidebar('search'); 
		}
		elseif (is_single()){
			dynamic_sidebar('single'); 
		}

		dynamic_sidebar('gfooter');
	} 
?>
</div>