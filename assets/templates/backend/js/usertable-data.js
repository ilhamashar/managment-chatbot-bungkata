$("#usertable").DataTable({
    // ordering: true,
    responsive: true,
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
        url: "user/get_users",
        type:'POST',
    },
    columnDefs: [
        {
            targets: [0,1,3,-1],
            orderable: false,
        },
    ]
});
$("#authusertable").DataTable({
    // ordering: true,
    responsive: true,
    processing: true,
    serverSide: true,
    order: [],
    ajax: {
        url: "get_auth_users",
        type:'POST',
    },
    columnDefs: [
        {
            targets: [0, 3, 6],
            orderable: false,
        },
    ]
});