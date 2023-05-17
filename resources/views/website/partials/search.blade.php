<div class="row">
    <div class="col-sm-12">
        <form action="{{ route('website.search') }}" method="POST" class="main-search">
            @csrf
            <div class="input-group content-group">
                <input type="text" class="form-control" name="search" placeholder="Search" title="Search">
                <div class="input-group-btn">
                    <button type="submit" class="btn bg-red btn-icon"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="search-results"></div>
    </div>
</div>
