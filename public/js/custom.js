
$(document).ready(function () {
    $.ajax({
        url: "books.php",
        type: "get",
        dataType: "JSON",
        success: function (books) {
        var len = books.length;
        for (var i = 0; i < len; i++) {
            var author = books[i].author;
            var name = books[i].name;

            var tr =
            "<tr>" +
            "<td align='center'>" +
            author +
            "</td>" +
            "<td align='center'>" +
            name +
            "</td>";

            $("#booksTable").append(tr);
        }
        },
        type: "GET",
    });
});

$("#searchButton").click(function (e) {
    e.preventDefault();
    $("#booksSearchTable tbody tr").remove();
    $.ajax({
        url: "books.php?search=true",
        data: {
        search: $("#search").val(),
        },
        type: "get",
        dataType: "JSON",
        success: function (books) {
        var len = books.length;
        for (var i = 0; i < len; i++) {
            var author = books[i].author;
            var name = books[i].name;

        //   var tr = "<tr>" + "<td align='center'>" + author + "</td>";
            var tr =
            "<tr>" +
            "<td align='center'>" +
            author +
            "</td>" +
            "<td align='center'>" +
            name +
            "</td>";
            $("#booksSearchTable").append(tr);
        }
        $("#booksSearchTable").removeClass("hidden");
        },
        type: "GET",
    });
});
