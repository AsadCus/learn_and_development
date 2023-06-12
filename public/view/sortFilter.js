$(document).ready(function() {
    $('.dropdown').on('click', function(event) {
        const dropdown = $(event.target);
        if (dropdown.hasClass('show')) {
            console.log('sup');
        } else {
            console.log('sup n');
        }

        function addOrUpdateURLParam (key, value) {
            const searchParams = new URLSearchParams(window.location.search)
            searchParams.set(key, value)
            const newRelativePathQuery = window.location.pathname + "?" + searchParams.toString()
            history.pushState(null, "", newRelativePathQuery)
        };
    
        $('input#active').change(function() {
            if($(this).prop('checked')) {
                var showActive = 'true';
            } else {
                var showActive = 'false';
            }
            addOrUpdateURLParam('show_active', showActive);
        });
    
        $('input#inactive').change(function() {
            if($(this).prop('checked')) {
                var showInactive = 'true';
            } else {
                var showInactive = 'false';
            }
            addOrUpdateURLParam('show_inactive', showInactive);
        });

        $('#applySortFilter').click(function(event) {
            location.reload();
        });
    });

    $('.dropdown-attendance').on('click', function(event) {
        const dropdown = $(event.target);

        function addOrUpdateURLParam (key, value) {
            const searchParams = new URLSearchParams(window.location.search)
            searchParams.set(key, value)
            const newRelativePathQuery = window.location.pathname + "?" + searchParams.toString()
            history.pushState(null, "", newRelativePathQuery)
        };
    
        $('input#pending').change(function() {
            if($(this).prop('checked')) {
                var showPending = 'true';
            } else {
                var showPending = 'false';
            }
            addOrUpdateURLParam('show_pending', showPending);
        });
    
        $('input#reject').change(function() {
            if($(this).prop('checked')) {
                var showReject = 'true';
            } else {
                var showReject = 'false';
            }
            addOrUpdateURLParam('show_reject', showReject);
        });

        $('input#present').change(function() {
            if($(this).prop('checked')) {
                var showPresent = 'true';
            } else {
                var showPresent = 'false';
            }
            addOrUpdateURLParam('show_present', showPresent);
        });

        $('#applySortFilterAttendance').click(function(event) {
            location.reload();
        });
    });
});