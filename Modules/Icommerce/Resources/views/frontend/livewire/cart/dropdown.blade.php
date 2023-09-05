<!--Shopping cart-->
<div class="cart-dropdown-menu"  style="z-index: 99999;">
    <!--Shopping cart dropdown -->
    <div class="dropdown-menu dropdown-menu-right rounded-0" aria-labelledby="dropdownCart" style="  min-width: 20rem; z-index: 9999999">

      <!-- titulo -->
      @if($cart->products->count())
        <h4 class="dropdown-header mb-0 font-weight-bold text-center">
          {{trans('icommerce::cart.articles.cart')}} ({{$cart->products->count()}})
          <i class="fa fa-trash text-muted float-right" title="Vaciar carrito" wire:click="deleteCart"></i>
        </h4>
      @else
        <h5 class="dropdown-header mb-0 font-weight-bold text-center" v-else>
          {{trans('icommerce::cart.articles.empty_cart')}}
        </h5>
      @endif

      <!-- articulos en el carrito -->
      @if($cart->products->count())
        @foreach($cart->products as $cartProduct)

          <div class="item_carting px-3 w-100 row m-0">
            <hr class="mt-0 mb-3 w-100">

            <!-- imagen -->
            <div class="col-3 px-0 mb-3">
              <div class="img-product-cart">
                <x-media::single-image
                  :alt="$cartProduct->product->name"
                  :title="$cartProduct->product->name"
                  :url="$cartProduct->product->url"
                  :isMedia="true"
                  imgClasses="img-fluid"
                  :mediaFiles="$cartProduct->product->mediaFiles()"/>
              </div>
            </div>

            <!-- descripción -->
            <div class="col-9">

              <!-- titulo -->
              <h6 class="mb-2 w-100 __title">
                <a href="{{$cartProduct->product->url}}">
                  {{ $cartProduct->product->name }}
                  @if($cartProduct->productOptionValues->count())
                    <br>
                    @foreach($cartProduct->productOptionValues as $productOptionValue)
                      <label>{{$productOptionValue->option->description}} : {{$productOptionValue->optionValue->description}}</label>
                    @endforeach
                  @endif
                </a>
              </h6>

              <!-- valor y cantidad -->
              <p class="mb-0 text-muted pb-2" style="font-size: 13px">
                {{trans('icommerce::cart.table.quantity')}}: {{ $cartProduct->quantity }} <br>
                {{trans('icommerce::cart.table.price_per_unit')}}: {{isset($currency) ? $currency->symbol_left : '$'}}
                {{formatMoney($cartProduct->product->discount->price ?? $cartProduct->product->price)}} {{isset($currency) ? $currency->symbol_right : ''}}
              </p>

              <!-- boton para eliminar-->
              <div style="width: 20px;  position: absolute; right: -7px; top: 0;">
                <a class="close cart-remove text-danger" style="font-size: 1rem;"
                   wire:click="deleteFromCart({{$cartProduct->id}})"
                   title="quitar producto">
                  <i class="fa fa-times"></i>
                </a>
              </div>

            </div>

          </div>
        @endforeach
      @endif

      <!-- FOOTER CARTING -->
      @if($cart->products->count())
        <div class="dropdown-footer text-center">

          <hr class="mt-1 mb-3">
          <!-- total -->
          <h6 class="font-weight-bold">
            {{trans('icommerce::cart.table.total')}}
            <span class="text-primary">
         {{isset($currency) ? $currency->symbol_left : '$'}} {{ formatMoney( $cart->total )}} {{isset($currency) ? $currency->symbol_right : ''}}
            </span>
          </h6>
          <!-- botones-->
          <a href="{{ tenant_route(request()->getHost(),locale() . '.icommerce.store.checkout') }}" tabindex="-1" class="btn btn-warning btn-sm mx-1 text-white">
            {{trans('icommerce::cart.button.view_cart')}}
          </a>

        </div>
      @endif
    </div>
</div>


<style>
  .cart-dropdown-menu .cart-remove {
    cursor: pointer;
  }
  .cart-dropdown-menu .dropdown-menu {
    max-height: 380px;
    overflow-y: auto;
  }
  .cart-dropdown-menu .dropdown-menu::-webkit-scrollbar {
    width: 10px;
    background-color: #F5F5F5;
  }
  .cart-dropdown-menu .dropdown-menu::-webkit-scrollbar-track {
    background-color: #CCCCCC;
  }
  .cart-dropdown-menu .dropdown-menu::-webkit-scrollbar-thumb {
    background-color: #aaa;
  }


</style>

