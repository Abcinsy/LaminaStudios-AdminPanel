<!-- resources/views/admin/internship/internship-header.blade.php -->

<form method="GET" action="{{ url()->current() }}" class="form-inline m-3 d-flex" id="filterForm">
    <div class="flex-grow-1 me-2">
        <input type="text" name="search" class="form-control w-100" placeholder="Search by Position, or Supervisor"
            value="{{ request('search') }}" id="searchInput"
            style="background-color: #F8F8F8; border: none; border-radius: 8px;">
    </div>
    <div class="flex-shrink-1" style="flex-basis: 15%;">
        <select name="status" class="form-control w-100" id="statusSelect"
            style="background-color: #F8F8F8; border: none; border-radius: 8px;">
            <option value="">Select Status</option>
            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
</form>


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
