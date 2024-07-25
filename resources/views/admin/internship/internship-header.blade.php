<!-- resources/views/admin/internship/internship-header.blade.php -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<form method="GET" action="{{ url()->current() }}" class="form-inline m-3 d-flex" id="filterForm">
    <div class="flex-grow-1 me-2">
        <input type="text" name="search" class="form-control w-100" placeholder="Search by Position, or Supervisor"
            value="{{ request('search') }}" id="searchInput"
            style="background-color: #F8F8F8; border: none; border-radius: 8px;">
    </div>
    <div class="flex-shrink-1 me-2" style="flex-basis: 15%;">
        <div class="select-wrapper">
        <select name="status" class="form-control w-100" id="statusSelect"
            style="background-color: #F8F8F8; border: none; border-radius: 8px;">
            <option value="">Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        <i class="bi bi-chevron-down select-icon"></i>
        </div>
    </div>
</form>

<style>
    .select-wrapper {
        position: relative;
    }

    .select-wrapper .select-icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        color: black;
        font-size: 1rem;
        pointer-events: none;
    }

    .form-control {
        padding-right: 2.5rem;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filterForm = document.getElementById('filterForm');
        const searchInput = document.getElementById('searchInput');
        const statusSelect = document.getElementById('statusSelect');

        function applyFilter() {
            filterForm.submit();
        }

        searchInput.addEventListener('input', applyFilter);
        statusSelect.addEventListener('change', applyFilter);
    });
</script>
