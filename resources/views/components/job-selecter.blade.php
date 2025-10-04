<div>
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <div class="mb-3">
        <label for="jobSelect" class="form-label">Job</label>
        <select class="form-select" id="jobSelect" name="job_id">
            @forelse ($all_job_opening as $job)
                <option value="{{ $job->id }}">{{ $job->jobTitle }}</option>
            @empty
                <option disabled selected>No job available</option>
            @endforelse
        </select>
    </div>
</div>