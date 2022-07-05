<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <?php include('../../master/cdnTop.php') ?>
    <link rel="stylesheet" href="../../style.css">
</head>

<body>
    <?php
    include('../../function.php');
    // ----------Secure Start---------
    include('../../protected/Auth.php');
    include('../../protected/IsAdmin.php');
    // -------- Secure End -----
    include('../../master/navbar.php');
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="m-0 p-0 col-md-2">
                <?php include('../leftMenus.php') ?>
            </div>
            <div class="col-md-10 mt-">
                <h5 class="mt-1 text-center section-header mt-3">Report Links</h5>
                <section class="sectionShow">
                    <div class="row">
                        <div class="col-md-10">
                            <table class="table table-striped reportsTable">
                                <thead>
                                    <tr>
                                        <th>TKT Id</th>
                                        <th scope="col">Link name</th>
                                        <th scope="col">Report User</th>
                                        <th scope="col">Problem</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="reportLinkTableBody">
                                    <?php $reports = selectQuery("report", "rep_link_id", "id  WHERE resolved_by='none'", "linksinformation");
                                    while ($report = mysqli_fetch_assoc($reports)) {
                                    ?>
                                        <tr repIdTableRow=<?php echo $report['rep_link_id'] ?>>
                                            <td><?php echo $report['rep_id']  ?></td>
                                            <td><?php echo $report['title']  ?></td>
                                            <td><?php echo $report['rep_user']  ?></td>
                                            <td></td>
                                            <td>
                                                <a href="<?php echo $report['link'] ?>" class="btn btn-sm btn-secondary" title="chek this link">Chk</a>
                                                <button class="btn btn-sm btn-success problemSolved" title="solve this tkt or problem">Sov</button>
                                                <button class="btn btn-sm btn-primary" disabled title="Delete this link">Edit</button>

                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                            <!-- Historys  -->
                            <div class="historyList" style="display: none;">
                            <div class=""><button class="btn btn-outline-primary retrepTableBtn"><i class="fa-solid fa-arrow-left"></i> Back</button></div>
                                <h5 class="mt-2 text-center">History</h5>
                                <div class="line-mf"></div>
                                <ul class="list-group">
                                <?php $historys = selectQuery("report", "rep_link_id", "id  WHERE resolved_by!='none' ORDER BY report.resolved_date DESC", "linksinformation"); 
                                    while($history = mysqli_fetch_assoc($historys)){
                                    echo '<li class="list-group-item fs-6 p-2">'.$history['rep_id'].'.'.$history["title"].' is solved by 
                                    <b>'.$history["resolved_by"].'</b> at '.$history["resolved_date"].'
                                    <a href="../action/reportLinkAction.php?undoSolved='.$history['rep_id'].'" class="btn btn-link">Undo</a></li>';
                                 }?>
                                </ul>
                            </div>
                        </div>
                        <!-- Other Action  -->
                         <!-- Dashboard  -->
                        <div class="col-md-2 border-start">
                            <div>
                                <?php $problem_counts =  mysqli_query($conn, "SELECT problem ,COUNT(problem) AS problem_count FROM report WHERE resolved_by='none' GROUP BY problem ");
                                while ($problem_count = mysqli_fetch_assoc($problem_counts)) { ?>
                                    <div class="rounded p-2" style="background: #F2F2F2;">
                                        <h6>Problems</h6>
                                        <button class="btn m-0">
                                            <small><?php echo $problem_count['problem'] ?></small>
                                            <span class="badge text-bg-primary"><?php echo $problem_count['problem_count'] ?></span>
                                        </button>
                                    </div>
                                <?php } ?>
                               
                                <div class="rounded mt-1 p-2 pointer historyBtn" style="background: #F2F2F2;">
                                    <i class="fa-solid fa-clock-rotate-left"></i> History
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>




    <?php include('../../master/cdnBotton.php'); ?>
    <script src="../../script.js"></script>
    <script>
        $(document).ready(function() {
            $('.reportLinkSection').addClass('bg-primary text-light');
            let tap = localStorage.getItem('click');
            if (tap) {
                $('.'+tap).click();
            }
        })

        //Solved
        $('.problemSolved').click(function() {
            const solvedLinkId = $(this).closest('tr').attr('repIdTableRow');
            $.ajax({
                url: '../action/reportLinkAction.php',
                type: "POST",
                data: {
                    solvedLinkId
                },
                success: function(data) {
                    if (data == 0) {
                        $(`tr[repIdTableRow=${solvedLinkId}]`).remove();
                    }
                }
            })
        })

        //History
        $(".retrepTableBtn").click(function(){
            $('.historyList').hide();
            $('.reportsTable').show();
            localStorage.setItem('click','retrepTableBtn');
        })
        $('.historyBtn').click(function() {
            $('.historyList').show();
            $('.reportsTable').hide();
            localStorage.setItem('click','historyBtn');
        })
    </script>
</body>

</html>