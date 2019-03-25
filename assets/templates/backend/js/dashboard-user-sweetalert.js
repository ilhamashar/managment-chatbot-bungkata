$(document).ready(function() {
    $('#btnavail').on('click', function () {
        var uid = $(this).data('uid');
        var status = $(this).data('status');
        var col = 'available';
        showConfirmBlockAvailMessage(uid, col, status);
    });
    $('#btnblock').on('click', function () {
        var uid = $(this).data('uid');
        var status = $(this).data('status');
        var col = 'blocked';
        showConfirmBlockAvailMessage(uid, col, status);
    });
    $('#btndel').on('click', function () {
        var uid = $(location).attr('href').substring($(location).attr('href').lastIndexOf('/') + 1);
        showConfirmDeleteUser(uid);
    });
});
function showConfirmDeleteUser(uid) {
    swal({
        title: "Are you sure?",
        text: "User will be deleted from database",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        $.ajax(
            {
                type: "post",
                url: "dashboard/user/delete/"+uid,
                data: "uid="+uid,
                success: function(data){
                }
            }
        )
            .done(function(data) {
                swal("Success!", "User has been deleted!", "success");
                setTimeout(function(){// wait for 2 secs(2)
                    location.replace("dashboard/user"); // then reload the page.(3)
                }, 2000);
            })
            .error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
    });
}
function showConfirmBlockAvailMessage(uid, col, status) {
    if (col === 'blocked'){
        if (status === 1){
            var teks = "User will not be able to interact!";
            var confirmTeks = "Yes, block it!"
            var confirmColor = "#DD6B55"
        } else {
            var teks = "User will be able to interact.";
            var confirmTeks = "Yes, unblock it!";
            var confirmColor = "#408100"
        }
    } else if (col === 'available') {
        if (status === 0) {
            var teks = "User will be disabled!";
            var confirmTeks = "Yes, disable it!";
            var confirmColor = "#DD6B55"
        } else {
            var teks = "User will be enabled!";
            var confirmTeks = "Yes, enable it!";
            var confirmColor = "#408100"
        }
    }
    swal({
        title: "Are you sure?",
        text: teks,
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: confirmColor,
        confirmButtonText: confirmTeks,
        closeOnConfirm: false
    }, function () {
        $.ajax(
            {
                type: "post",
                url: "dashboard/user/update/"+uid,
                data: col+"="+status,
                success: function(data){
                }
            }
        )
            .done(function(data) {
                swal("Success!", "User has been updated!", "success");
                setTimeout(function(){// wait for 2 secs(2)
                    location.reload(); // then reload the page.(3)
                }, 2000);
            })
            .error(function(data) {
                swal("Oops", "We couldn't connect to the server!", "error");
            });
    });
}