@extends('layouts.admin')

@section('hide_alerts', '1')

@section('title')
Studentship Letter
@endsection

@section('breadcrumb')
<li class="breadcrumb-item"><a href="/admin/student">Student management</a></li>
<li class="breadcrumb-item">Studentship Letter</li>
@endsection

@section('custom-css')
<style>
.search-results-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    right: 0;
    z-index: 1050;
    max-height: 280px;
    overflow-y: auto;
    background: #fff;
    border: 1px solid rgba(0,0,0,.15);
    border-radius: 0.25rem;
    box-shadow: 0 0.5rem 1rem rgba(0,0,0,.175);
    display: none;
}
.search-result-item {
    padding: 8px 12px;
    cursor: pointer;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.15s ease-in-out;
}
.search-result-item:last-child {
    border-bottom: none;
}
.search-result-item:hover, .search-result-item.active {
    background-color: #f8f9fa;
}
.search-result-item.ineligible {
    background-color: #fff9f9;
}
.search-result-item.ineligible:hover, .search-result-item.ineligible.active {
    background-color: #fbeded;
}
</style>
@endsection

@section('content')
<div class="card mb-2">
  <div class="card-body">
    <h4 class="text-secondary mb-3 mt-3"><i data-feather="file-text" class="mr-0 pb-1"></i> Generate Studentship Letter</h4>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/admin/student/generate-student-ship-letter') }}" id="frmStudentship">
        @csrf
        <div class="row">
            <div class="col-md-5">
                <div class="form-group position-relative">
                    <label for="registration_no">Student Search (Reg No / NIC / Name)</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="registration_no" name="registration_no" 
                               placeholder="Type Reg No, NIC, or Name..." 
                               autocomplete="off" required value="{{ old('registration_no') }}">
                        <div class="input-group-append" id="searchSpinner" style="display:none;">
                            <span class="input-group-text bg-white"><i class="fa fa-spinner fa-spin text-primary"></i></span>
                        </div>
                    </div>
                    @if($errors->has('registration_no'))
                        <span class="text-danger">{{ $errors->first('registration_no') }}</span>
                    @endif

                    {{-- Live Search Results Dropdown --}}
                    <div id="studentSearchResults" class="search-results-dropdown"></div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select class="form-control" id="semester" name="semester" required>
                        <option value="1st Semester" {{ old('semester', '1st Semester') == '1st Semester' ? 'selected' : '' }}>1st Semester</option>
                        <option value="2nd Semester" {{ old('semester') == '2nd Semester' ? 'selected' : '' }}>2nd Semester</option>
                    </select>
                    @if($errors->has('semester'))
                        <span class="text-danger">{{ $errors->first('semester') }}</span>
                    @endif
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="BtnSubmit" class="d-block">&nbsp;</label>
                    <button type="submit" class="btn btn-primary btn-grey-overlay btn-icon-split" id="BtnSubmit">
                        <span class="icon"><i class="fa fa-download"></i></span>
                        <span class="text">Download Letter</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Selected Student Details Card --}}
        <div id="selectedStudentCard" class="card bg-light border mt-2" style="display:none;">
            <div class="card-body py-2 px-3">
                <div class="d-flex justify-content-between align-items-center flex-wrap">
                    <div>
                        <strong class="text-dark" id="dispStudentName"></strong>
                        <span class="badge badge-primary ml-2" id="dispStudentReg"></span>
                        <span class="badge badge-secondary ml-1" id="dispStudentBatch"></span>
                        <span class="text-muted small ml-2" id="dispStudentNic"></span>
                    </div>
                    <div id="dispEligibilityBadge"></div>
                </div>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

@section('custom-js')
<script>
$(document).ready(function() {
    feather.replace();

    let debounceTimer = null;
    let currentFocus = -1;
    const $input = $('#registration_no');
    const $results = $('#studentSearchResults');
    const $spinner = $('#searchSpinner');
    const $studentCard = $('#selectedStudentCard');

    function debounce(callback, delay) {
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => callback.apply(context, args), delay);
        };
    }

    $input.on('input', debounce(function() {
        const query = $.trim($input.val());
        currentFocus = -1;

        if (query.length < 1) {
            $results.empty().hide();
            $spinner.hide();
            return;
        }

        $spinner.show();

        $.ajax({
            url: "{{ url('/admin/student/studentship-letter/search') }}",
            type: "GET",
            data: { q: query },
            dataType: "json",
            success: function(data) {
                $spinner.hide();
                $results.empty();

                if (!data || data.length === 0) {
                    $results.html('<div class="p-3 text-muted text-center small"><i class="fa fa-info-circle mr-1"></i> No matching students found</div>').show();
                    return;
                }

                $.each(data, function(index, student) {
                    const badgeClass = student.is_eligible ? 'badge-success' : 'badge-danger';
                    const itemClass = student.is_eligible ? '' : 'ineligible';

                    const itemHtml = `
                        <div class="search-result-item ${itemClass}" 
                             data-reg="${student.registration_no}" 
                             data-name="${student.name}" 
                             data-nic="${student.id_no || ''}" 
                             data-batch="${student.batch}" 
                             data-year="${student.current_year}" 
                             data-status="${student.status_text}" 
                             data-eligible="${student.is_eligible}">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong class="text-primary">${student.registration_no}</strong>
                                    <span class="text-dark ml-2 font-weight-bold">${student.name}</span>
                                </div>
                                <div>
                                    <span class="badge ${badgeClass} mr-1">${student.status_text}</span>
                                    <span class="badge badge-light border">${student.batch}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center text-muted small mt-1">
                                <span>NIC: ${student.id_no || 'N/A'}</span>
                                <span>${student.current_year || ''}</span>
                            </div>
                        </div>
                    `;
                    $results.append(itemHtml);
                });

                $results.show();
            },
            error: function() {
                $spinner.hide();
                $results.empty().hide();
            }
        });
    }, 250));

    // Select student from dropdown click
    $(document).on('click', '.search-result-item', function(e) {
        e.preventDefault();
        selectStudent($(this));
    });

    function selectStudent($item) {
        const reg = $item.data('reg');
        const name = $item.data('name');
        const nic = $item.data('nic');
        const batch = $item.data('batch');
        const status = $item.data('status');
        const isEligible = $item.data('eligible') === true || $item.data('eligible') === 'true' || $item.data('eligible') === 1;

        $input.val(reg);
        $results.empty().hide();

        // Populate detail card
        $('#dispStudentName').text(name);
        $('#dispStudentReg').text(reg);
        $('#dispStudentBatch').text(batch ? 'Batch: ' + batch : '');
        $('#dispStudentNic').text(nic ? 'NIC: ' + nic : '');

        const badgeHtml = isEligible 
            ? '<span class="badge badge-success px-2 py-1"><i class="fa fa-check-circle mr-1"></i> Eligible (' + status + ')</span>'
            : '<span class="badge badge-danger px-2 py-1"><i class="fa fa-times-circle mr-1"></i> Ineligible (' + status + ')</span>';

        $('#dispEligibilityBadge').html(badgeHtml);
        $studentCard.slideDown(150);
    }

    // Keyboard navigation (Arrow keys and Enter)
    $input.on('keydown', function(e) {
        const items = $results.find('.search-result-item');
        if (!items.length) return;

        if (e.keyCode === 40) { // Down arrow
            currentFocus++;
            addActive(items);
            e.preventDefault();
        } else if (e.keyCode === 38) { // Up arrow
            currentFocus--;
            addActive(items);
            e.preventDefault();
        } else if (e.keyCode === 13) { // Enter
            if (currentFocus > -1 && items[currentFocus]) {
                e.preventDefault();
                selectStudent($(items[currentFocus]));
            }
        }
    });

    function addActive(items) {
        if (!items) return;
        items.removeClass('active');
        if (currentFocus >= items.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = items.length - 1;
        $(items[currentFocus]).addClass('active');

        // Scroll active item into view
        const activeItem = items[currentFocus];
        const container = $results[0];
        if (activeItem.offsetTop < container.scrollTop) {
            container.scrollTop = activeItem.offsetTop;
        } else if (activeItem.offsetTop + activeItem.offsetHeight > container.scrollTop + container.clientHeight) {
            container.scrollTop = activeItem.offsetTop + activeItem.offsetHeight - container.clientHeight;
        }
    }

    // Close dropdown when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#registration_no, #studentSearchResults').length) {
            $results.hide();
        }
    });

    // Reopen dropdown on input focus if it has content
    $input.on('focus', function() {
        if ($results.children().length > 0) {
            $results.show();
        }
    });
});
</script>
@endsection
