@if($categories && count($categories)>0)
<div class="filter-categories {{$this->style}} mb-4">

  <div class="title">
    <a class="item" data-toggle="collapse" href="#collapseCategories" role="button" aria-expanded="{{$isExpanded ? 'true' : 'false'}}" aria-controls="collapseCategories" class="{{$isExpanded ? '' : 'collapsed'}}">
        
        <h5 class="p-3 border-top border-bottom">
          {{ trans($titleFilter) }}
          <i class="fa fa angle float-right" aria-hidden="true"></i>
        </h5>

      </a>
  </div>
  
  <div class="collapse {{$isExpanded ? 'show' : ''}}" id="collapseCategories">
    <div class="row">
      <div class="col-12">
        <div class="list-categories">
          <ul class="list-group list-group-flush">
            
            @foreach($categories->where("parent_id",0) as $category)
                @include('icommerce::frontend.livewire.index.filters.categories.category-item',["level" => 0,"category" => $category,"categoryId" => $category->id])
            @endforeach
          
          
          </ul>
        </div>
      </div>
    </div>
  </div>

</div>
@endif

