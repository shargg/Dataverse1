/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************!*\
  !*** ./resources/js/user.js ***!
  \******************************/
function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }
function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }
function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }
function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) arr2[i] = arr[i]; return arr2; }
function _iterableToArrayLimit(arr, i) { var _i = null == arr ? null : "undefined" != typeof Symbol && arr[Symbol.iterator] || arr["@@iterator"]; if (null != _i) { var _s, _e, _x, _r, _arr = [], _n = !0, _d = !1; try { if (_x = (_i = _i.call(arr)).next, 0 === i) { if (Object(_i) !== _i) return; _n = !1; } else for (; !(_n = (_s = _x.call(_i)).done) && (_arr.push(_s.value), _arr.length !== i); _n = !0); } catch (err) { _d = !0, _e = err; } finally { try { if (!_n && null != _i["return"] && (_r = _i["return"](), Object(_r) !== _r)) return; } finally { if (_d) throw _e; } } return _arr; } }
function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }
// CSRF token for AJAX requests
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

// Create a new user
$('#createUserForm').on('submit', function (e) {
  e.preventDefault();

  // Perform client-side validation here, if necessary

  var isActive = $('#is_active').is(':checked') ? 1 : 0;
  var Name = $('#name').val();
  var username = $('#username').val();
  var password = $('#password').val();
  var passwordConfirmation = $('#password_confirmation').val();
  var email = $('#email').val();
  var roles = $('input[name="roles[]"]:checked').map(function () {
    return this.value;
  }).get();
  var formData = {
    _token: $('meta[name="csrf-token"]').attr('content'),
    is_active: isActive,
    name: "".concat(Name),
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
    success: function success(response) {
      window.location.href = '/users';
      $('#createUserForm .alert-success').html('User created successfully.').show();
    },
    error: function error(response) {
      if (response.status === 422) {
        var errors = response.responseJSON.errors;
        var errorText = '';
        for (var _i = 0, _Object$entries = Object.entries(errors); _i < _Object$entries.length; _i++) {
          var _Object$entries$_i = _slicedToArray(_Object$entries[_i], 2),
            key = _Object$entries$_i[0],
            value = _Object$entries$_i[1];
          errorText += "".concat(value[0], "<br>");
        }
        $('#createUserForm .alert-danger').html(errorText).show();
      } else {
        $('#createUserForm .alert-danger').html('An error occurred while creating the user.').show();
      }
    }
  });
});

// Update an existing user
$('#editUserForm').on('submit', function (e) {
  e.preventDefault();
  // Perform client-side validation here, if necessary

  var userId = $(this).data('user-id');
  var isActive = $('#is_active').is(':checked') ? 1 : 0;
  var formData = new FormData(this);
  formData.set('is_active', isActive);
  $.ajax({
    type: 'POST',
    url: "/users/".concat(userId),
    data: formData,
    processData: false,
    contentType: false,
    dataType: 'json',
    success: function success(response) {
      $('#editUserForm .alert-success').html('User updated successfully.').show();
      setTimeout(function() {
        window.location.href = '/users';
      }, 500);
    },
      error: function error(response) {
          console.log('Error response:', response);
          if (response.status === 422) {
              var errors = response.responseJSON.errors;
              console.log('Errors object:', errors);
              var errorText = '';
              for (var key in errors) {
                  if (errors.hasOwnProperty(key)) {
                      var value = errors[key];
                      errorText += "".concat(value[0], "<br>");
                  }
              }
              console.log('Error text:', errorText);
              $('#editUserForm .alert-danger').html(errorText).show();
          } else {
              $('#editUserForm .alert-danger').html('An error occurred while editting the user.').show();
          }
      }
  });
});

// Delete a user
function deleteUser(userId) {
  if (confirm('Are you sure you want to delete this user?')) {
    $.ajax({
      type: 'DELETE',
      url: "/users/".concat(userId),
      dataType: 'json',
      success: function success(response) {
        location.reload();
      },
      error: function error(response) {
        $('#createUserForm .alert-danger').html('An error occurred while deleting the user.').show();
      }
    });
  }
}
/******/ })()
;
