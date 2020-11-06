<style type="text/css">
	.ig_es_offer {	
		width:55%;
		margin: 0 auto;
		text-align: center;
		padding-top: 1.2em;
	}

</style>
<?php

if ( ( get_option( 'ig_es_offer_halloween_2020' ) !== 'yes' ) && ( $ig_current_date >= strtotime( '2020-10-30' ) ) && ( $ig_current_date <= strtotime( '2020-11-02' ) )) { ?>
		<div class="ig_es_offer">
			<a target="_blank" href="?es_dismiss_admin_notice=1&option_name=offer_halloween_2020"><img src="<?php echo esc_url ( ES_PLUGIN_URL ); ?>/lite/admin/images/halloween_2020.png"/></a>
		</div>

<?php } ?>
