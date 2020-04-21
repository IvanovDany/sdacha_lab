$('#add-form').hide();


$('.show-add-Task').on('click', function(e){
    $('#add-form').fadeToggle('slow');
    if($('.show-add-Task').html()=='Создать задачу')
        $('.show-add-Task').html('Скрыть');
    else
        $('.show-add-Task').html('Создать задачу');
})


$('#add-form').submit(function(e){
    e.preventDefault();
    let task_name = $('.task-Name').val();
    let task_description = $('.task-Description').val();
    $.post('/create.php',{task_name: task_name, task_description: task_description}).done(function(result) {
        if(result.search('Название не может быть пустым!')){
            $('.error').remove();
            $('.task-Name').val('');
            $('.task-Description').val('');
            $.post("show_tasks.php").done(function(result) {
                $(".items").empty(); // удаление html кода
                $(".items").append(result);
            });
            if(result.search('Error')){
                $("#add-form").append("<span class = 'success'>"+result+"</span>");
            }else{
                console.log(result);
            }
        }
        else
        {
            $("#add-form").append("<span class = 'error'>"+result+"</span>");
        }   
    }).fail(function(error) {
        console.log(error.message);
    });
});



