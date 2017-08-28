$(document).ready(function(){

    $.ajax({
        url: '/task/returnAllTasks',
        type: 'POST',
        dataType: 'json',
        success: function(data){
                for (var i in data){
                    if(!data[i].image_path){
                        data[i].image_path = '/images/no_image.png';
                    }
                    $('#mainTasksList').append(
                        '<tr>' +
                        '<td>' +data[i].username+'</td><td>' + data[i].email +'</td><td>' +
                        data[i].task_description + '</td><td>'+ '<img width="80px" height="75px" src="'+data[i].image_path +'">' +'</td><td>' +data[i].task_status+'</td>' +
                        '</tr>'
                    );
                }
        }
    });
});