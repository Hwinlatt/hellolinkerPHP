<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>More</title>
    <?php

    use function PHPSTORM_META\type;

    include('../../master/cdnTop.php');
    include('../../function.php');

    $linkTitle = "";
    if (ig('linkPatch')) {
        $linkTitle = $_GET['linkPatch'];
        $linkId = $_GET['linkId'];
        $user = selectQuery('users', 'id', $_SESSION['id']);
    }
    if ($_SESSION['role'] == "member" || $_SESSION['role'] == "admin") {
        $links = selectQuery('linksinformation', 'id', $linkId);
        $link = $links[0];
    } else {
        $link = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM linksinformation WHERE id='$linkId' AND type='free'"));
    }
    ?>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-3 my-2">
            <div> <a href="../../index.php" class="btn btn-outline-primary"><i class="fa-solid fa-arrow-left"></i> Back</a></div>
        </div>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-7">
                <?php if ($link == null) {
                    echo '<h1><i class="text-warning fa-solid fs-1 fa-triangle-exclamation"></i> This is Premium Link!Access Denied <h1>
                    <h1 class="mt-5"><i class="text-warning fa-solid fs-1 fa-triangle-exclamation"></i> ဒီလင့်ဟာ premium user များအတွက်ဖြစ်ပါတယ် <h1>
                    <a href="reqPremium.php" class="btn btn-primary mt-4 fs-5">Get Premium |ပရီမီယမ်(မန်ဘာ) plan ကို ရယူရန်</a>
                    ';
                    return;
                } ?>
                <div class="row">
                <div class="col-md-6">
                        <div class=""><?php echo $link['link_trailer'] ?></div>
                    </div>
                    <div class="col-md-6 bg-silver p-2 rounded mb-3 shadow overflow-auto" style="height: 315px;">
                        <h5><?php echo $link['title'] ?></h5>
                        <p class="text-break">
                            <?php echo $link['detail'] ?>
                        </p>
                        <div>

                        </div>
                    </div>
                </div>
                <!-- Like And Report  -->
                <?php $likeCountThis = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM likes WHERE link_id='" . $link['id'] . "' AND user_id='" . $_SESSION['id'] . "'")); ?>

                <div class="row mx-1  mt-3 text-center">
                    <div linkId="<?php echo  $link['id'] ?>" class="col pointer btn btn-white likeBtn <?php if ($likeCountThis > 0) {
                                                                                                            echo 'text-primary';
                                                                                                        } ?>"><i class="fa-solid fa-thumbs-up fs-3"></i>
                        <span class="likeCount" id="<?php echo $link['id'] ?>"><?php echo countQuery('likes', 'link_id', $link['id']) ?></span>
                    </div>
                    <div class="col pointer btn btn-warning reportLinkBtn " id="<?php echo $link['id'] ?>"><i class="fa-solid fa-triangle-exclamation"></i> Report</div>
                    <a href="<?php echo $link['link'] ?>" target="_black" class="btn btn-outline-primary p-2 mt-2">Watch Now <i class="fa-solid fa-circle-play"></i></a>
                </div>

                <!-- Comment Area  -->
                <div class="row mt-2">
                    <h6 class="opacity-75 text-center mt-2">Comments (<span class="commentCount"></span>)</h6>
                    <div class="d-flex justify-content-between px-2">
                        <textarea type="text" class="form-control commentInput<?php echo  $link['id'] ?>" placeholder="Enter Comment" rows="4"></textarea>
                        <div class="d-flex align-items-center">
                            <button userId='<?php echo $user[0]['id'] ?>' linkId="<?php echo $link['id'] ?>" class="btn btn-primary mx-2 commentSubmit"><i class="fa-solid fa-comment"></i>
                            </button>
                        </div>
                    </div>
                    <div class="rounded-3 p-3 text-center modalnotiArea">
                        HELLO
                    </div>
                    <div class="commentTable border rounded mt-2">
                        <div class="row">
                            <div class="text-center m-auto p-2 border" style="width: fit-content;">
                                <i class="fa-solid fa-pager"></i>
                                <span class="PaginationNumber">1</span>
                            </div>
                            <div>
                                <nav aria-label="Page navigation example" class="paginationContainer">
                                    <ul class="pagination paginationSelect d-flex justify-content-center">
                                        <li class="page-item"><button class="page-link PaginationSelected">1</button></li>
                                        <li class="page-item"><button class="page-link">2</button></li>
                                        <li class="page-item"><button class="page-link">3</button></li>
                                        <li class="page-item"><button class="page-link">4</button></li>
                                        <li class="page-item"><button class="page-link">5</button></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <table class="table">
                            <tbody class="tableBodyComment<?php echo  $link['id'] ?>" style="transition: 0.5s;">
                                <!--  -->
                            </tbody>
                        </table>
                        <!-- ---Pagination--  -->
                        <div class="row">
                            <div class="text-center m-auto p-2 border" style="width: fit-content;">
                                <i class="fa-solid fa-pager"></i>
                                <span class="PaginationNumber">1</span>
                            </div>
                            <div>
                                <nav aria-label="Page navigation example" class="paginationContainer">
                                    <ul class="pagination paginationSelect d-flex justify-content-center">
                                        <li class="page-item"><button class="page-link PaginationSelected">1</button></li>
                                        <li class="page-item"><button class="page-link">2</button></li>
                                        <li class="page-item"><button class="page-link">3</button></li>
                                        <li class="page-item"><button class="page-link">4</button></li>
                                        <li class="page-item"><button class="page-link">5</button></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
    </div>

    <?php include('../../master/cdnBotton.php') ?>
    <script>
        $(document).ready(function() {
            change();
            setInterval(() => {
                likeCommentCount();
            }, 500);
        })

        //Comment Pagination Script
        function change() {
            $('.paginationSelect li button').click(function() {
                let slected = parseInt($(this).html());
                $('.selectedNow').removeClass('selectedNow');
                $(this).addClass('selectedNow');
                $('.PaginationNumber').html(slected);
                commentPagination(parseInt($('.PaginationNumber').html()));
            })
        }

        function commentPagination($i) {
            if ($i >= 2) {
                let check = ''
                if($i-2==0){
                    check = "d-none";
                }
                $('.paginationContainer').html(`
                <ul class="pagination paginationSelect d-flex justify-content-center">
                <li class="page-item"><li class="page-item"><button  class="${check} page-link">${$i-2}</button></li>
                                    <li class="page-item"><button class="page-link">${$i-1}</button></li>
                                    <li class="page-item"><button class="page-link selectedNow">${$i}</button></li>             
                                    <li class="page-item"><button class="page-link">${$i+1}</button></li>             
                                    <li class="page-item"><button class="page-link">${$i+2}</button></li> </ul>`);
            }
            change()

        }

        function likeCommentCount() {
            const likeCount = true;
            const commentCount = true;
            const likeId = $('.likeCount').attr('id');
            selectComment(likeId);
            $.ajax({
                url: "../likeUnlike/likeAction.php",
                type: "POST",
                data: {
                    likeCount,
                    likeId
                },
                success: function(data) {
                    $('.likeCount').html(data);
                },
            })
            $.ajax({
                url: "../comment/comment.php",
                type: "POST",
                data: {
                    commentCount,
                    likeId
                },
                success: function(data) {
                    $('.commentCount').html(data);
                },
            })
        }
        // like Unlike 
        $('.likeBtn').click(function() {
            let linkId = $(this).attr('linkId');
            const Like = true;
            $.ajax({
                url: "../likeUnlike/likeAction.php",
                type: "POST",
                data: {
                    linkId,
                    Like
                },
                success: function(data) {
                    likeCount();
                }
            })
            if ($(this).hasClass('text-primary')) {
                $(this).removeClass('text-primary');
            } else {
                $(this).addClass('text-primary');
            }
        })
        // Comments 

        function deleteComment() {
            $('.delCommentBtn').click(function() {
                const delId = $(this).attr('id');
                const linkId = $(this).attr('linkId')
                if (confirm('Delete Comment?')) {
                    $(this).closest('tr').hide(500);
                    $.ajax({
                        url: "../comment/comment.php",
                        type: "POST",
                        data: {
                            delId
                        },
                        success: function(data) {
                            modalAlert(data, 'green');


                        },
                        error: function(data) {
                            alert(data);
                        }
                    })
                }
            })
        }

        function modalAlert(text, color) {
            $('.modalnotiArea').show();
            $('.modalnotiArea').css({
                'color': color
            }).html(text);
            setTimeout(() => {
                $('.modalnotiArea').fadeOut(200);
            }, text.length * 200);
        }

        function selectComment(selId) {
            let startPoint = parseInt($('.PaginationNumber').html());
            $.ajax({
                url: '../comment/comment.php',
                type: "POST",
                data: {
                    selId,
                    startPoint
                },
                success: function(data) {
                    $('.tableBodyComment' + selId).html(data);
                    deleteComment(); //recall function to new inserts

                },
                error: function(data) {
                    console.log(data);

                }
            })
        }

        deleteComment();

        $('.commentSubmit').click(function() {
            const userId = $(this).attr('userId');
            const linkId = $(this).attr('linkId');
            const commentText = $('.commentInput' + linkId).val();
            if (commentText != '') {
                $.ajax({
                    url: '..//comment/comment.php',
                    type: 'POST',
                    data: {
                        commentText,
                        userId,
                        linkId
                    },
                    success: function(data) {
                        $('.commentInput' + linkId).val('');
                        modalAlert(data, 'green');
                        selectComment(linkId);
                        let count = parseInt($('.commentCount' + linkId).html())

                    },
                    error: function(data) {
                        alert(data);
                    }
                })
            } else if (commentText == '') {
                modalAlert('Comment text is empty!', 'red');
            }
        })
        $('.reportLinkBtn').click(function() {
            let reportLink = $(this).attr('id');
            if (confirm("The Link is not work.(လင့်က အလုပ်မလုပ်ပါ)")) {
                $.ajax({
                    url: '../../admin/action/linkAction.php',
                    type: "POST",
                    data: {
                        reportLink
                    },
                    success: function(data) {
                        modalAlert(data, "green");
                    },
                    error: function(data) {
                        alert(data);
                    }
                })
            }
        })
    </script>
</body>

</html>