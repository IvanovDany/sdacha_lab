$('body').on('change', '.checkbox-value', function(e){
    let form = $(this).parent().parent();
    let id = form.find('input[name="item_task_id"]').val();
    let user_id = form.find('input[name="item_user_id"]').val();
    let is_done;

    if(form.find('input[name="item_is_done"]').prop('checked')==true)
    	is_done = 1;
    else
    	is_done = 0;

    let task_name = form.find('input[name="item_task_name"]').val();
    let task_description = form.find('textarea[name="item_task_description"]').val();

    $.post('/is_done.php',{id:id, user_id:user_id, is_done: is_done}).done(function(result) {
  	 $.post("show_tasks.php").done(function(result) {
                $('.items').empty(); // удаление html кода
                $('.items').append(result);
                
        });
    }).fail(function(error) {
        console.log(error.message);
    });
});


$('body').on('click', '.decline-button', function(e){
	setTimeout( 'location="/";', 0 );
});