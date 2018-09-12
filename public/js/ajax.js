const baseUrl = 'http://localhost/Laravel/SocialBlog/public';
$(document).ready(function(){

    //show post
    $('.showPost').on('click', function(e){
        e.preventDefault();

        var id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'GET',
            url: baseUrl + '/comments',
            data: {
                id
            },
            success: function(data){
                var text = '';

                $.each(data, function(index, value){
                    text += `
                    <p><a href="" class="usernameComment">${value['user']['username']}</a> <span class="comment">${value['comment']}</span></p>
                    `;
                });
                $('#comments-'+id).html(text);
            }
        });
    });

    //insert comment
    $('.commentBtn').click(function(e){
        e.preventDefault();

        var id = $(this).attr('id');
        var comment = $('.comment-'+id).val();
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'POST',
            url: baseUrl + '/comments/create',
            data: {
                id,
                comment
            },
            success: function(data){
                var text = '';
                var number = '';
                
                $.each(data, function(index, value){
                    text += `
                    <p><a href="" class="usernameComment">${value['user']['username']}</a> <span class="comment">${value['comment']}</span></p>
                    `;
                });
                number += ` <i class="far fa-comment-alt"> &nbsp;${data.length}</i>`;
                
                $('.numOfComments-'+id).html(number);
                $('#comments-'+id).html(text);
                $('.comment-'+id).val('');
            }
        });
    });


});