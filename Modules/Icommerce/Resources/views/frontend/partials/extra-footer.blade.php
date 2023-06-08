 @if(config("asgard.icommerce.config.extraFooter"))

    <div class="extra-footer">
    	@foreach(config("asgard.icommerce.config.extraFooter") as $key => $block)
    		@if($block['status'])

					@switch($block['type'])
						
						@case('owlCarousel')
						@default
    			<x-isite::carousel.owl-carousel
			    	:id="$block['id']" 
			    	:title="$block['title']"
			    	:subTitle="$block['subTitle']"
			        repository="Modules\Icommerce\Repositories\ProductRepository"     
			        :params="$block['props']['params']" 
			        :responsive="$block['props']['responsive']"/>
        		@break
						@case('view')
							@include($block['view'],["block" => $block])
						@break
					@endswitch
        	@endif
        @endforeach
    </div>

     
 @endif