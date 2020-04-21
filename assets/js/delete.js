$('body').on('click', '.delete-button', function(e){
    let form = $(this).parent().parent().parent();
    let id = form.find('input[name="item_task_id"]').val();
    let user_id = form.find('input[name="item_user_id"]').val();
    let is_done = form.find('input[name="item_is_done"]').prop('checked');
    let task_name = form.find('input[name="item_task_name"]').val();
    let task_description = form.find('textarea[name="item_task_description"]').val();
    $.post('/delete.php',{id:id, user_id:user_id, is_done: is_done, task_name: task_name, task_description: task_description}).done(function(result) {
        $.post("show_tasks.php").done(function(result) {
                $(".items").empty(); // удаление html кода
                $(".items").append(result);
                
        });
    }).fail(function(error) {
        console.log(error.message);
    });
});