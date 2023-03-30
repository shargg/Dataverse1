// CSRF token for AJAX requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Create a new user
$('#createUserForm').on('submit', function (e) {
    e.preventDefault();

    // disable submit button after click
    $(this).find('button[type="submit"]').prop('disabled', true);

    // Perform client-side validation here, if necessary

    const isActive = $('#is_active').is(':checked') ? 1 : 0;
    const Name = $('#name').val();
    const username = $('#username').val();
    const password = $('#password').val();
    const passwordConfirmation = $('#password_confirmation').val();
    const email = $('#email').val();
    const roles = $('input[name="roles[]"]:checked').map(function () {
        return this.value;
    }).get();

    const formData = {
        _token: $('meta[name="csrf-token"]').attr('content'),
        is_active: isActive,
        name: `${Name}`,
        username: username,
        password: password,
        password_confirmation: passwordConfirmation,
        email: email,
        roles: roles
    };

    $.ajax({
        type: 'POST',
        url: '/users',
        data: formData,
        dataType: 'json',
        success: function (response) {
            window.location.href = '/users';
            $('#createUserForm .alert-success').html('User created successfully.').show();
        },
        error: function (response) {
            if (response.status === 422) {
                const errors = response.responseJSON.errors;
                let errorText = '';
                for (const [key, value] of Object.entries(errors)) {
                    errorText += `${value[0]}<br>`;
                }
                $('#createUserForm .alert-danger').html(errorText).show();
            } else {
                $('#createUserForm .alert-danger').html('An error occurred while creating the user.').show();
            }
            // Re-enable the submit button after the request is completed
            $(this).find('button[type="submit"]').prop('disabled', false);
        }
    });
});

// Update an existing user
$('#editUserForm').on('submit', function (e) {
    e.preventDefault();
    // Perform client-side validation here, if necessary

    const userId = $(this).data('user-id');

    const isActive = $('#is_active').is(':checked') ? 1 : 0;
    const formData = new FormData(this);
    formData.set('is_active', isActive);

    $.ajax({
        type: 'PUT',
        url: `/users/${userId}`,
        data: formData,
        processData: false,
        contentType: false,
        dataType: 'json',
        success: function (response) {
            window.location.href = '/users';
        },
        error: function (response) {
            if (response.status === 422) {
                const errors = response.responseJSON.errors;
                let errorText = '';
                for (const [key, value] of Object.entries(errors)) {
                    errorText += `${value[0]}<br>`;
                }
                $('#createUserForm .alert-danger').html(errorText).show();
            } else {
                $('#createUserForm .alert-danger').html('An error occurred while creating the user.').show();
            }       
        }
    });
});

// Delete a user
function deleteUser(userId) {
    if (confirm('Are you sure you want to delete this user?')) {
        $.ajax({
            type: 'DELETE',
            url: `/users/${userId}`,
            dataType: 'json',
            success: function (response) {
                window.location.href = '/users';
            },
            error: function (response) {
                $('#createUserForm .alert-danger').html('An error occurred while deleting the user.').show();
            }
        });
    }
}
