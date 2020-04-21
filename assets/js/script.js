
$.post("show_tasks.php").done(function(result) {
    $(".items").empty(); // удаление html кода
    $(".items").append(result);
	});

