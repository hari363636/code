  <!-- Center -->
        <div class="row">
          <div class="col-12">
            <div class="page-title-box">
              <div class="page-title-right">
                <ol class="breadcrumb m-0">
                  <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                  <li class="breadcrumb-item active">Completed Orders</li>
                </ol>
              </div>
              <h4 class="page-title">Completed Orders</h4>
            </div>
          </div>
        </div>
		 <?php $this->load->view('partials/_messages'); ?>
				  
        <div class="row">
          <div class="col-lg-12">
            <div class="card-box">
              <div class="table-responsive">
                <table id="basic-datatable" class="table table-striped table-hover dt-responsive nowrap w-100 table-sm">
                  <thead>
                    <tr>
                      <th class="hidden-xs">S.No</th>
					  <th class="hidden-xs">Order #</th>
                      <th>Seller Name</th>
                      <th>Phone</th>
                      <th>Email</th>
                      <th>Verification Type</th>
					  <th>Agent</th>
                      <th class="hidden-xs">Date From</th>
					  <th class="hidden-xs">Date To</th>
                      <th>Report</th>
					  <th>Status</th>
					  <th>Service</th>
                   
                    </tr>
                  </thead>
                  <tbody>
				  <?php 
				  $i = 1;
				    foreach($result AS $item ){
                    $user = get_user($item->user_id);						
					$startdate = date("d/m/Y", strtotime($item->created_date));
					$duration = $item->duration;
					$datestr = strtotime($item->created_date);
					$dateend = strtotime("+".$duration." day", $datestr);
				    $enddate = date('d/m/Y', $dateend);
					$startdate = date("d/m/Y", strtotime($item->created_date));
					$status = get_process_type($item->status);	
					$reportid = get_report_data($item->id);
					$enquire = get_enquiry_indi($item->lead_id);
					?>
					 <tr>
                      <td class="hidden-xs"><?php echo $i;?></td>
					  <td class="hidden-xs"><?php echo getinvoice_number($item->id);?></td>
                      <td><?php echo $reportid->seller;?></td>
                      <td><?php echo $item->billing_phone;?></td>
                      <td><?php echo $item->billing_email;?></td>
                      <td><?php $vtype = get_verification_type($item->verification_type); echo $vtype->name;?></td>
					    <td><?php if($item->agent_id != 0) {$agent = get_user($item->agent_id); echo $agent->first_name.' '.$agent->last_name; } else { echo '---';} ?></td>
                  
					  <td class="hidden-xs"><?php echo $startdate;?></td>
                      <td class="hidden-xs"><?php echo $enddate;?></td>
					   <td><?php if($item->status == 3) {?>
					 <a href="<?php echo base_url();?>view-cuser-report/<?php echo $item->id; ?>" type="button" class="btn btn-secondary btn-xs waves-effect waves-light">View</a>
					  <?php }else {echo"---";} ?> </td>
					    <td><?php  echo $reportid->report_status; ?></td>
                    <td>
					<?php if($item->verification_type == 1 && $enquire->request == 0) { ?>
					<button type="button" onclick="getresponse(<?php echo $item->lead_id; ?>);" class="btn btn-success btn-xs waves-effect waves-light" data-toggle="modal" data-target="#crequest">Request</button></td>
					<?php }else { echo '-';} ?>
					   </tr>
                    <?php
					$i++;
					}
				    ?>
                   
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- Center --> 
		