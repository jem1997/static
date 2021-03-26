<?php  
	$cid = isset($_GET['cid']) ? htmlspecialchars(trim($_GET['cid']), ENT_QUOTES) : '';
	$cid = explode(',', $cid);
	$cid = array_filter($cid);
	foreach ($cid as $key => $value) {
		if( !is_numeric($value) || $cat_root_id !== _get_cat_root_id($value) ) unset($cid[$key]);
	}

	$root = get_category($cat_root_id);
	$rlink = get_category_link($root);
	$plink = '';
	if( strstr($rlink, '?') ){
		$plink .= '&';
	}else{
		$plink .= '?';
	}
	$plink .= 'cid=';
?>
<section class="container">
	<div class="content-wrap">
		<div class="content">
			<?php _the_ads($name='ads_cat_01', $class='orbui-cat orbui-cat-01') ?>
			<div class="cat-filter">
				<h1><?php single_cat_title() ?></h1>
				<?php  
					$list = get_terms( 'category', array(
						'child_of'   => $cat_root_id,
						'hide_empty' => false,
					) );

					$flag = array();
					foreach( $list as $key => $item ) {
						$id = $item->parent;
						if( $item->parent == $cat_root_id ) {
							$id = $item->term_id;
						}

						if( !isset($flag[$id]) ){
							$flag[$id] = array();
						}

						if( in_array($item->term_id, $cid) ){
							$flag[$id][] = $item->term_id;
						}
					}

					$output = '';
					foreach( $list as $key => $item ) {

						$on = in_array($item->term_id, $cid);

						$cid2 = $cid;

						if( $on ){
							$k = array_search($item->term_id, $cid2);
							unset($cid2[$k]);
						}else{
							$cid2[] = $item->term_id;

							$id = $item->parent;
							if( $item->parent == $cat_root_id ) {
								$id = $item->term_id;
							}
							if( isset($flag[$id]) && $flag[$id] ){
								foreach ($flag[$id] as $kk => $v) {
									$k = array_search($v, $cid2);
									unset($cid2[$k]);
								}
							}
						}

						$link = $rlink . ( $cid2 ? $plink . implode(',', $cid2) : '' );

				        if( $item->parent == $cat_root_id ) {
				        	if( $key ) $output.= '</li><li>';
							$output.= '<strong><i class="fa fa-chevron-right"></i>'. $item->name .'</strong>';
							$output.= '<a href="'. $link .'" '. ($on?'class="active"':'') .'>全部</a>';
				        }else{
				            $output.= '<a href="'. $link .'" '. ($on?'class="active"':'') .'>'. $item->name .'</a>';
				        }

				    }
				    echo '<ul><li>'.$output.'</li></ul>';
				?>
			</div>
			<?php 
				$args = array(
					'cat'                 => $cid ? implode(',', $cid) : $cat_root_id,
					'paged'               => $paged,
					'ignore_sticky_posts' => 1
		        );
		        query_posts($args);
				get_template_part( 'excerpt' ); 
				_moloader('mo_paging');
				wp_reset_query();
			?>
		</div>
	</div>
	<?php get_sidebar() ?>
</section>