let Blog = {};
Blog.toList = function(callback)
{
    $.ajax({
        type: 'GET',
        url:'/getPost'
    }).done(function(res){
        callback(res.posts);
    });
}
Blog.delete = function(id, callback){
    $.ajax({
        type: 'delete',
        url:'/post/'+id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).done(function(res){
        callback(res);
    });
}
Blog.saveChange = function(request, callback){
    $.ajax({
        type: 'POST',
        url: '/post',
        data: request
    }).done(function (data) {
        callback();
    });
}


Blog.toList(function(data){
    renderTable(data);
});

Blog.getById = function(id, callback){
    $.ajax({
        type:'GET',
        url:'/post/edit/'+id
    }).done(function(res){
        callback(res);
    });
}
function renderTable(data){
    $('#ltable tbody').html('');
    $.each(data, function(index, item){
        var row = '<tr data-id="'+item.id+'">'+
            '<td>'+(index+1)+'</td>'+
            '<td>'+item.title+'</td>'+
            '<td>'+item.body+'</td>'+
            '<td><button class="btn btn-defualt "><a href="javascript:void(0)" class="btnDel ">Delete</a></button> <a class="btn btn-primary btnedit">Edit</a></td>'+'</tr>';
        $('#ltable tbody').append(row);
    });
}

$('body').on('click','.btnDel', function(){
    let tr = $(this).closest('tr');
    let id = tr.attr('data-id');
    Blog.delete(id, function(res){
        tr.remove();
    });
});

$('body').on('click', '#insert', function(){
    let item = $('#form').serialize();
    Blog.saveChange(item, function(){
        Blog.toList(function(data){
            renderTable(data);
            $('#exampleModalCenter').modal('hide');
        });
    });
});

$('body').on('click', '.btnedit', function(e){
    e.preventDefault();
    let tr = $(this).closest('tr');
    let id = tr.attr('data-id');
    Blog.getById(id, function(data){
        //pass from object ot html.
       console.log(data);
       $('#t').val($(this).data('title'));
       $('#b').val($(this).data('body'));
       $('#form_update').modal('show');
    });
        
});

// new follow
// $('body').on('click' ,'.create-modal', function(){
//     $('#create').modal('show');
//     $('.form-horizontal').show();
//     $('.modal-title').text('Add New Post');
// });

// $('body').on('click', '#add', function(){
//     let item = $('#form').serialize();
//     Blog.saveChange(item, function(){
//         Blog.toList(function(data){
//             renderTable(data);
//             $('#exampleModalCenter').modal('hide');
//         });
//     });
// });

//  new follow code for crud


// $(document).ready(function() {
//     $(document).on('click', '.edit-modal', function() {
//           $('#footer_action_button').text("Update");
//           $('#footer_action_button').addClass('glyphicon-check');
//           $('#footer_action_button').removeClass('glyphicon-trash');
//           $('.actionBtn').addClass('btn-success');
//           $('.actionBtn').removeClass('btn-danger');
//           $('.actionBtn').addClass('edit');
//           $('.modal-title').text('Edit');
//           $('.deleteContent').hide();
//           $('.form-horizontal').show();
//           $('#fid').val($(this).data('id'));
//           $('#n').val($(this).data('title'));
//           $('#myModal').modal('show');
//       });
//       $(document).on('click', '.delete-modal', function() {
//           $('#footer_action_button').text(" Delete");
//           $('#footer_action_button').removeClass('glyphicon-check');
//           $('#footer_action_button').addClass('glyphicon-trash');
//           $('.actionBtn').removeClass('btn-success');
//           $('.actionBtn').addClass('btn-danger');
//           $('.actionBtn').addClass('delete');
//           $('.modal-title').text('Delete');
//           $('.did').text($(this).data('id'));
//           $('.deleteContent').show();
//           $('.form-horizontal').hide();
//           $('.dname').html($(this).data('title'));
//           $('#myModal').modal('show');
//       });
  
//       $('.modal-footer').on('click', '.edit', function() {
  
//           $.ajax({
//               type: 'post',
//               url: '/editItem',
//               data: {
//                   '_token': $('input[name=_token]').val(),
//                   'id': $("#fid").val(),
//                   'title': $('#n').val(),
//                   'body': $('#b').val()
//               },
//               success: function(data) {
//                   $('.item' + data.id).replaceWith(
//                       "<tr class='item" + data.id + "'><td>" + data.id + 
//                       "</td><td>" + data.title + "</td><td>" + data.body + 
//                       "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-title='" + data.name + "' data-body='" + data.body+ 
//                       "'><span class='glyphicon glyphicon-edit'></span>Edit</button> <button class='delete-modal btn btn-danger' data-id='" + 
//                       data.id + "' data-title='" + data.title +"' data-body='" + data.body +"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
//               }
//           });
//       });
//       $("#add").click(function() {
  
//           $.ajax({
//               type: 'post',
//               url: '/addItem',
//               data: {
//                   '_token': $('input[name=_token]').val(),
//                   'title': $('input[name=title]').val(),
//                   'body': $('input[name=body]').val()
//               },
//               success: function(data) {
//                   if ((data.errors)){
//                     $('.error').removeClass('hidden');
//                       $('.error').text(data.errors.name);
//                   }
//                   else {
//                       $('.error').addClass('hidden');
//                       $('#table').append("<tr class='item" + data.id + "'><td>" + data.id + "</td><td>" + data.name + "</td><td><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.name + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
//                   }
//               },
  
//           });
//           $('#name').val('');
//       });
//       $('.modal-footer').on('click', '.delete', function() {
//           $.ajax({
//               type: 'post',
//               url: '/deleteItem',
//               data: {
//                   '_token': $('input[name=_token]').val(),
//                   'id': $('.did').text()
//               },
//               success: function(data) {
//                   $('.item' + $('.did').text()).remove();
//               }
//           });
//       });
//   });

// $('#add').click(function(data){
    
	// $.ajax({
	// 	type: 'POST',
    //     url: '/addPost',
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     },
	// 	data : {
	// 		'_token': $('input[name=_token]').val(),
	// 		'title': $('input[name=title]').val(),
	// 		'biody': $('input[name=body]').val(),
	// 	},
	// 	success: function(data){
	// 		if((data.errors)){
	// 			$('error').removeClass('hidden');
	// 			$('error').text(data.errors.title);
	// 			$('error').text(data.errors.body);
	// 		}else{
	// 			$('error').remove();
    //             $('#title').append("<tr class='post" + data.id + "'>")+
    //             "<td>"+data.id +"</td>"+
    //             "<td>"+data.title +"</td>"+
    //             "<td>"+data.body +"</td>"+
    //             "<td> <a class='show-modal btn btn-info btn-sm data-id='"+ data.id +"' data-title='" + data.title +"' data-body='"+ data.body +"'>view"+"</a>"+
    //             "<a class='show-modal btn btn-info btn-sm data-id='"+ data.id +"' data-title='" + data.title +"' data-body='"+ data.body +"'>edite"+"</a>"+
    //             "<a class='show-modal btn btn-info btn-sm data-id='"+ data.id +"' data-title='" + data.title +"' data-body='"+ data.body +"'delete"+"</a></td>"
    //             +"</tr>"
	// 		}
	// 	}
	// });
// });





