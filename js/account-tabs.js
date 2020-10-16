jQuery(function( $ ){
	// #taa-account-tab-wrap is the id of the div that wraps ALL of our tab markup
	var tab = taa_tab_number.affiliate_tab;
	if ( tab == 'none' ) {
		$("#taa-account-tab-wrap").tabs();
	} else {
		$("#taa-account-tab-wrap").tabs({active: tab});
		var active = $("#taa-account-tab-wrap").tabs( "option", "active" );
		$( "#taa-account-tab-wrap" ).tabs( "option", "active", tab );
	}
});
