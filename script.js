fetch("https://hellolinker.000webhostapp.com/master/apilink.php")
.then(result => result.json())
.then(links => {
  console.log(links);
  // ----- show link in index ---
    $(document).ready(function(){
      $data = "";
        links.forEach(link => {
            $data += `
            <div class="card m-1" style="width: 10rem;">
            <img src="${link.link_img}" class="card-img-top" alt="...">
            <div class="card-body">
              <div class=""><h6 class="card-title">${link.title}</h6> <small class="fs-smallest opacity-75">${link.name}</small></div>
              <button data-bs-toggle="modal" data-bs-target="#linkInfo${link.id}" class="btn btn-outline-primary">More</button>
            </div>
          </div>`
        });
        $('.linkContainer').html($data);
    })

    $('.searchInputLinks').keyup(function(){
      let key = $(this).val().toLowerCase();
        let searchResult = links.filter(e =>{
          return e.title.toLowerCase().includes(key);
        })
        $data = "";
        searchResult.forEach(link => {
          $data += `
          <div class="card m-1" style="width: 10rem;">
          <img src="${link.link_img}" class="card-img-top" alt="...">
          <div class="card-body">
            <div class="d-flex justify-content-between"><h5 class="card-title">${link.title}</h5> <small class="fs-smallest opacity-75">${link.name}</small></div>
            <button data-bs-toggle="modal" data-bs-target="#linkInfo${link.id}" class="btn btn-primary">More</button>
          </div>
        </div>`
      });      
      $('.linkContainer').html($data);
    })
// --Comment--

    $(document).ready(function(){
      
    })
    function deleteComment(){
      $('.delCommentBtn').click(function(){
        const delId = $(this).attr('id');
        const linkId = $(this).attr('linkId')
        if (confirm('Delete Comment?')) {
          $(this).closest('tr').hide(500);
          $.ajax({
            url:"user/comment/comment.php",
            type:"POST",
            data:{delId},
            success:function(data){
               modalAlert(data,'green');
            $('.commentCount'+linkId).html(parseInt($('.commentCount'+linkId).html())-1);
               
            },
            error:function(data){
              alert(data);
            }
          })
        }
      })
    }
    function modalAlert(text,color) {
      $('.modalnotiArea').css({'color':color}).html(text);
            setTimeout(() => {
              $('.modalnotiArea').html('');
            }, text.length*200);
    }
    function selectComment(selId){
        $.ajax({
          url:'user/comment/comment.php',
          type:"POST",
          data:{selId},
          success:function(data){
            $('.tableBodyComment'+selId).html(data);
            deleteComment();
          },
          error:function(data){
            console.log(data);
            
          }
        })
    }
  
    deleteComment();

    $('.commentSubmit').click(function(){
      const userId = $(this).attr('userId'); 
      const linkId = $(this).attr('linkId');
      const  commentText = $('.commentInput'+linkId).val() ;
      if (commentText != '') {
        $.ajax({
          url:'user/comment/comment.php',
          type:'POST',
          data:{commentText,userId,linkId},
          success:function(data){
            $('.commentInput'+linkId).val('');
            modalAlert(data,'green');
            selectComment(linkId);
            let count  = parseInt($('.commentCount'+linkId).html())
            
            $('.commentCount'+linkId).html(parseInt($('.commentCount'+linkId).html())+1);
          },
          error:function(data){
            alert(data);
          }
        })
      }else if(commentText == ''){
        modalAlert('Comment text is empty!','red');
      }
    })
    $('.reportLinkBtn').click(function(){
      let reportLink = $(this).attr('id');
      if (confirm("The Link is not work.(လင့်က အလုပ်မလုပ်ပါ)")){
        $.ajax({
          url:'admin/action/linkAction.php',
          type:"POST",
          data:{reportLink},
          success:function(data){
            modalAlert(data,"orange");
          },
          error:function(data){
            alert(data);
          }
        })
      }
    })
    

})
$(".menuContainer").click(function () {
  $(".line-1").toggleClass("cross-line-1");
  $(".line-3").toggleClass("cross-line-3");
  $(".line-2").toggle();
  if ($(".line-1").hasClass("cross-line-1")) {
      $('.menuForPhone').fadeIn(100);
  }else{
      $('.menuForPhone').fadeOut(100);
  }
})
