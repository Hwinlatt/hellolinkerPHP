$(document).ready(function () {
  // widths start
  const searchResultTop = $('.searchContainerBoth').innerHeight();
  $('.searchResult').css({ 'top': `${searchResultTop + 1}px` });
  const navBarWidth = $('.mainNavBar').innerHeight();
  $('.leftMenuBar').css({ 'top': `${navBarWidth + 1}px`});


  //width End 

})
$('.clearInput').click(function () {
  $('.searchInputLinks').val('');
  $('.navSearchBtn').attr('href', `index.php`);
  $('.searchResult').css({ 'height': '0vh' });
})


$(".menuContainer").click(function () {
  $(".line-1").toggleClass("cross-line-1");
  $(".line-3").toggleClass("cross-line-3");
  $(".line-2").toggle();
  if ($(".line-1").hasClass("cross-line-1")) {
    $('.menuForPhone').fadeIn(100);
  } else {
    $('.menuForPhone').fadeOut(100);
  }
})



// fetch("http://localhost/Linker/master/apilink.php")
//       .then(result => result.json())
//       .then(links => {
//         console.log(links);
//         // ----- show link in index ---
//         $(document).ready(function() {
//           $data = "";
//           links.forEach(link => {
//             let premium = '';
//             if (link.type == "premium") {
//               premium = '<i class="fa-solid fa-crown text-warning"></i>';
//             }
//             $data += `
//             <div class="card m-1" style="width: 10rem;">
//             <img src="${link.link_img}" class="card-img-top" style="height: 8rem;" alt="...">
//             <div class="card-body">
//               <div class=""><h6 class="card-title">${link.title} ${premium}</h6> <small class="fs-smallest opacity-75">${link.name}</small></div>
//               <a class="btn btn-sm mt-1 btn-primary" href="user/view/selectPatch.php?linkPatch=${link.title} & linkId=${link.id}">More <i class="fa-solid fa-circle-arrow-right"></i></a>
//             </div>
//           </div>`
//           });
//           $('.linkContainer').html($data);
//         })
//         $('.searchInputLinks').keyup(function() {
//           let key = $(this).val().toLowerCase();
//           let searchResult = links.filter(e => {
//             return e.title.toLowerCase().includes(key);
//           })
//           $data = "";
//           searchResult.forEach(link => {
//             $data += `
//           <div class="card m-1" style="width: 10rem;">
//           <img src="${link.link_img}" class="card-img-top" alt="...">
//           <div class="card-body">
//             <div class="d-flex justify-content-between"><h5 class="card-title">${link.title}</h5> <small class="fs-smallest opacity-75">${link.name}</small></div>
//             <button data-bs-toggle="modal" data-bs-target="#linkInfo${link.id}" class="btn btn-primary">More</button>
//           </div>
//         </div>`
//           });
//           $('.linkContainer').html($data);
//         })


//       })