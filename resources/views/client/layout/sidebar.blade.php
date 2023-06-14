<style>
    .ui-slider-horizontal .ui-slider-range{
        background: yellow;
    }
</style>
<form action="shop">
    <div class="filter-widget">
        <h4 class="fw-title">Danh mục</h4>
        <ul class="filter-catagories">
            @foreach ($category as $key=>$cate)
            <li><a href="{{route('danh-muc', $cate->slug)}}">{{$cate->name}}</a></li>
            @endforeach
        </ul>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Thương hiệu</h4>
        <div class="fw-brand-check">
            @foreach ($brand as $key=>$bra)
            <div class="bc-item">
                <label for="bc- {{$bra->id}}">
                   {{$bra->name}} 
                   <input type="checkbox" 
                   {{(request("brand")[$bra->id] ?? '') == 'on' ? 'checked':'' }}
                   id="bc- {{$bra->id}}" name="brand[{{$bra->id}}]" onchange="this.form.submit();">
                    <span class="checkmark"></span>
                </label>
            </div>
            @endforeach

        </div>
    </div>
    <div class="filter-widget">
        <h4 class="fw-title">Giá</h4>
        <div class="filter-range-wrap">
            <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
            <input type="hidden" id="start_price" name="start_price">
            <input type="hidden" id="end_price" name="end_price">
            <div id="slider-range" style="height:10px;color:#f6931f;">
                
             </div>
        </div>
        <button type="submit" class="filter-btn">Filter</button>
    </div>
  
    {{-- <div class="filter-widget">
        <h4 class="fw-title">Size</h4>
        <div class="fw-size-choose">
            <div class="sc-item">
                <input type="radio" name="" id="s-size">
                <label for="s-size">s</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="" id="m-size">
                <label for="m-size">m</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="" id="l-size">
                <label for="l-size">l</label>
            </div>
            <div class="sc-item">
                <input type="radio" name="" id="xs-size">
                <label for="xs-size">xs</label>
            </div>
         </div>
    </div> --}}

    <div class="filter-widget">
        <h4 class="fw-title">Tags</h4>
        <div class="fw-tags">
            <a href="#">Towel</a>
            <a href="#">Shoes</a>
            <a href="#">Coat</a>
            <a href="#">Dresses</a>
            <a href="#">Trousers</a>
            <a href="#">Men's hats</a>
            <a href="#">Backpack</a>
        </div>
    </div>
</form>