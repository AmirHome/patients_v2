<div class="row m-1 pb-3">
    <form action="{{ route('admin.travel-statuses.index') }}" method="get">
        <div class="input-group">
            <input type="text" class="form-control filter" name="title" placeholder="Title">
            <input type="text" class="form-control filter" name="id" placeholder="Id">
            <div class="input-group-append">
                <button class="btn btn-primary" type="button" id="form-filter-submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
</div>