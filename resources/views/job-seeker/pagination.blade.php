<div class="d-flex flex-column align-items-center" style="margin-top: 30px">
    <div>
        {{ $jobs->links('pagination::bootstrap-4') }}
    </div>
    <div class="text-muted mt-2">
        Showing {{ $jobs->firstItem() }} to {{ $jobs->lastItem() }} of {{ $jobs->total() }} results
    </div>
</div>
