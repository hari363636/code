<?php
	include 'include.header.php';
	$objadmissionform = new admissionform();

	$arrGetDataforExport = $objadmissionform->getAll("", "admissionform_id DESC");
	
	$cond = "";
	if (isset($_POST ['search'])) {
			$name = $_POST ['searchitem'];
			//LIKE '%$name%'
			$cond = "post_date LIKE '%$name%'";
	}


	/********** BEGIN : Delete/Status *********************************** */
	if ($did) {
		$objError = $objadmissionform->delete("admissionform_id= " . $did);

		$msg = "Data deleted successfully";
		header("location:admissionform.list.php?m=3&pgNo=$pgNo");
		exit;
	}
	if ($cond != "") {

		$arrGetData = $objadmissionform->getAll($cond);
	} else {

		/************** END : Delete/Status *********************************** */
		define("COUNT", 25);
		$from = $pgNo * COUNT - COUNT;
		$urlPgNo = "<li class='paginate_button ' aria-controls='dataTables-example' tabindex='0'><a href=admissionform.list.php?pgNo={pgNo}>{pgTxt}</a></li>";
		$arrGetData = $objadmissionform->getLimit($from, COUNT, "", "admissionform_id DESC");
		$totalPages = $objadmissionform->count("admissionform_id");
		$totalPages = $totalPages['count(admissionform_id)'];
		$totalPages = ceil($totalPages / COUNT);
	}
	/* ``````````````````````` END : Finalize ``````````````````````` */
?>
<script src="js/jquery-1.10.2.js"></script>
<script type="text/javascript">
$(document).ready(function () {

	$("#btnExport").click(function (e) {
			e.stopPropagation();
			//var table = $("." + $(this).data('target'));
			window.open('data:application/vnd.ms-excel,' + encodeURIComponent($('#dvData').html()));
			e.preventDefault();
	});

});

</script>

<div id="page-wrapper">
        <?php include 'include.statistics.php'; ?>
        <div class="row"><div style="float:right;margin-right:15px;padding-bottom:5px;"><button type="button" id="btnExport" class="btn btn-outline btn-primary" >
                                <i class="fa fa-plus"></i> Export to Excel</button></div>


                <div id="dvData" style="display: none;">

                        <table >
                                <thead>
                                        <tr>
                                                <td><b>Serial</b> </td>
                                                <td><b>Student's Full Name</b></td>
                                                <td><b>Nationality</b></td>
                                                <td><b>Date of Birth</b></td>
                                                <td><b>Name of Current School</b></td>
                                                <td><b>Grade Level at Current School</b> </td>
                                                <td><b>Current School Educational System</b></td>
                                                <td><b>School Location</b></td>
                                                <td><b>Applied grade at Al-Bayan in September</b></td>
                                                <td><b>Sender's Name</b></td>
                                                <td><b>Sender's Relationship with Student</b> </td>
                                                <td><b>Contact Numbers</b></td>
                                                <td><b>Email Address</b></td>
                                                <td><b>Inquiries/Remarks</b></td>


                                        </tr>
                                </thead>
                                <tbody>

                                        <tr><td>&nbsp;</td></tr>
                                        <?php
                                                foreach ($arrGetDataforExport as $key => $val) {
                                                        ?>

                                                        <tr >
                                                                <td><?= $key + 1 ?>&nbsp;</td>
                                                                <td> <?= $val['name'] ?>&nbsp;</td>
                                                                <td><?= $val['nationality'] ?>&nbsp;</td>
                                                                <td><?= $val['dob'] ?>&nbsp;</td>
                                                                <td><?= $val['cschool'] ?>&nbsp;</td>

                                                                <td> <?= $val['cgrade'] ?>&nbsp;</td>
                                                                <td><?= $val['csystem'] ?>&nbsp;</td>
                                                                <td><?= $val['location'] ?>&nbsp;</td>
                                                                <td><?= $val['appliedgrade'] ?>&nbsp;</td>

                                                                <td> <?= $val['sendername'] ?>&nbsp;</td>
                                                                <td><?= $val['sendrelation'] ?>&nbsp;</td>
                                                                <td><?= $val['phone'] ?>&nbsp;</td>
                                                                <td><?= $val['emailid'] ?>&nbsp;</td>

                                                                <td> <?= $val['remark'] ?>&nbsp;</td>


                                                        </tr>

                                                <?php } ?>

                                </tbody>
                        </table>





                </div>  <!-- /.dvData -->      




                <div class="col-lg-12">
                        <div class="panel panel-default">
                                <div class="panel-heading">
                                        Applied candidates
                                </div>



                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                        <div class="dataTable_wrapper">

                                                <!--                                 <form name="frmlinks" action="" method="post" onsubmit="return searchcheck()">
                                                                                <div class="col-sm-6" style="float: right;margin-bottom: 3px;">
                                                                                                                                                                                <div id="dataTables-example_filter" style="float: right">
                                                                                                                    
                                                                                                                                    
                                                                                                <button type="submit" name="search">Search</button><input size="30" type="text" id="datepicker" name="searchitem" placeholder="Enter date" readonly>
                                                                                             
                                                                                                                </div></div></form>-->

                                                <?php
                                                        if ($arrGetData <> "") {
                                                                ?>

                                                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                                        <thead>
                                                                                <tr>
                                                                                        <th width="9%">Date </th>
                                                                                        <th width="70%">Name</th>
                                                                                        <th width="9%">Email</th>
                                                                                        <th width="7%">Phone</th>
                                                                                        <th width="5%">Actions</th>
                                                                                </tr>
                                                                        </thead><tbody>
                                                                                <?php
                                                                                foreach ($arrGetData as $key => $val) {
                                                                                        ?>

                                                                                        <tr class="<?= (($key + 1) % 2 == 0) ? 'odd gradeX' : 'even gradeC' ?>">
                                                                                        <!--<td><?= $key + 1 ?></td>-->
                                                                                                <td><?= $val['post_date'] ?></td>
                                                                                                <td> <a href="admissionform.view.php?uid=<?= $val['admissionform_id'] ?>&pgNo=<?= $pgNo ?>"><?= $val['name'] ?></a></td>
                                                                                                <td><?= $val['emailid'] ?></td>
                                                                                                <td><?= $val['phone'] ?></td>

                                                                                                <td class="center">
                                                                                                        <a href="admissionform.list.php?did=<?= $val['admissionform_id'] ?>&pgNo=<?= $pgNo ?>"> <i class="fa fa-trash-o" onclick="return window.confirm('Are You Sure To Delete This Record?')" style="font-size: large;"></i></a> 
                                                                                                </td>
                                                                                        </tr>
                                                                                <?php } ?>

                                                                        </tbody>
                                                                </table>

                                                                <?php
                                                        } else {
                                                                echo ("No items to show");
                                                        }
                                                ?> 					

                                        </div>
                                    
                                <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate" style="float: right">
                                        <ul class="pagination">

                                                <?= ($totalPages > '1') ? $objadmissionform->getPageLink($pgNo, $totalPages, $urlPgNo, COUNT) : "" ?>

                                        </ul></div>
                               
                        </div>
                       
                </div>
               
        </div>
       
      
</div>
<script type="text/javascript">

                function searchcheck() {

                        if (document.frmlinks.searchitem.value.length <= 0)
                        {
                                alert('Invalid   Date ');
                                return false;
                        }
                }


</script>
<?php include 'include.footer.php'; ?>
<link rel="stylesheet" href="css/jquery-ui.css">
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
                var j = jQuery.noConflict();
                j(document).ready(function () {
                        j("#datepicker").datepicker({
                                dateFormat: "d-m-yy"
                        });
                });
</script>