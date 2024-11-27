<div class="row">
    @forelse ($companies as $company)
        @include('job-seeker.companies.company-card', ['company' => $company])
    @empty
        <p class="text-center">Không có công ty nào để hiển thị.</p>
    @endforelse
</div>

<!-- Pagination -->
<div>
    {{ $companies->links() }}
</div>
