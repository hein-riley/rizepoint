<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
	<div><label class="screen-reader-text" for="s"><!--Search for:--></label>
		<ul class="searchform-wrapper">
			<li><input type="text" value=" " name="s" id="s" placeholder="<?php the_search_query(); ?>" autocomplete="on"/></li>
			<li><p><i class="fa fa-search" aria-hidden="true"></i></p></li>
		</ul>
		
		
		<input type="hidden" id="searchsubmit" value="Search"/>
	</div>
</form>