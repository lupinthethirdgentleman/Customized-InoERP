<!-- * 
inoERP
 *
 * @copyright   2014 Nishit R. Das
 * @license     https://www.mozilla.org/MPL/2.0/
 * @link        http://inoideas.org
 * @source code https://github.com/inoerp/inoERP
-->

<div id ="form_header"><span class="heading"><?php echo gettext('Bank Statement') ?></span>
 <form method="post" id="cm_statement_header"  name="cm_statement_header">
  <div id="tabsHeader">
   <ul class="tabMain">
    <li><a href="#tabsHeader-1"><?php echo gettext('Basic Info') ?></a></li>
		<li><a href="#tabsHeader-2"><?php echo gettext('Bank') ?></a></li>
    <li><a href="#tabsHeader-3"><?php echo gettext('Amount') ?></a></li>
    <li><a href="#tabsHeader-4"><?php echo gettext('Note') ?></a></li>
    <li><a href="#tabsHeader-5"><?php echo gettext('Attachments') ?></a></li>
	 </ul>
   <div class="tabContainer">
    <div id="tabsHeader-1" class="tabContent">
     <ul class="column header_field">
      <li><?php $f->l_text_field_dr_withSearch('cm_statement_header_id') ?>
       <a name="show" href="form.php?class_name=cm_statement_header&<?php echo "mode=$mode"; ?>" class="show document_id cm_statement_header_id"><i class="fa fa-refresh"></i></a> 
      </li>
      <li><?php $f->l_text_field_d('statement_num', 'primary_column2'); ?></li>
      <li><?php $f->l_select_field_from_object('bu_org_id', org::find_all_business(), 'org_id', 'org', $cm_statement_header->bu_org_id, 'bu_org_id', $readonly1, '', ''); ?>						 </li>
      <li><?php $f->l_text_field_dr('status') ?></li>
			<li><?php $f->l_text_field_d('description') ?></li>
			<li><?php $f->l_date_fieldAnyDay('statement_date', $$class->statement_date) ?></li>
     </ul>
    </div>
		<div id="tabsHeader-2" class="tabContent">
     <ul class="column header_field">
			<li><?php
					echo $f->l_val_field_dm('account_number', 'mdm_bank_account', 'account_number', '', 'account_number', 'vf_select_account_number');
					echo $f->hidden_field_withId('mdm_bank_account_id', $$class->mdm_bank_account_id);
					?><i class="generic g_select_bank_account select_popup clickable fa fa-search" data-class_name="mdm_bank_account"></i></li>
			<li><?php $f->l_text_field_d('bank_number'); ?></li> 
			<li><?php $f->l_text_field_dr('branch_number'); ?></li> 
			<li><?php $f->l_text_field_dr('bank_name_short'); ?></li> 
			<li><?php $f->l_text_field_dr('bank_name_alt'); ?></li> 
			<li><?php $f->l_text_field_dr('ifsc_code'); ?></li> 
			<li><?php $f->l_text_field_dr('swift_code'); ?></li> 
			<li><?php $f->l_text_field_dr('routing_number'); ?></li> 
			<li><?php $f->l_text_field_dr('iban_code'); ?></li> 
     </ul>
    </div>
    <div id="tabsHeader-3" class="tabContent">
     <ul class="column header_field">
			<li><?php $f->l_select_field_from_object('doc_currency', option_header::currencies(), 'option_line_code', 'option_line_code', $$class->doc_currency, 'doc_currency', '', 1, $readonly); ?></li>
      <li><?php $f->l_number_field('opening_balance', $$class->opening_balance, '15', 'opening_balance'); ?></li>
      <li><?php $f->l_number_field('closing_balance', $$class->closing_balance, '15', 'closing_balance'); ?></li>
      <li><?php $f->l_number_field('receipt', $$class->receipt, '15', 'receipt'); ?></li>
      <li><?php $f->l_number_field('payments', $$class->payments, '15', 'payments'); ?></li>
     </ul>
    </div>
		<div id="tabsHeader-4" class="tabContent">
		 <div id="comments">
			<div id="comment_list">
					<?php echo!(empty($comments)) ? $comments : ""; ?>
			</div>
			<div id ="display_comment_form">
					<?php
					$reference_table = 'cm_statement_header';
					$reference_id = $$class->cm_statement_header_id;
					?>
			</div>
			<div id="new_comment">
			</div>
		 </div>
		</div>
    <div id="tabsHeader-5" class="tabContent">
     <div> <?php echo ino_attachement($file) ?> </div>
    </div>

   </div>

  </div>
 </form>
</div>

<div id="form_line" class="form_line"><span class="heading"><?php echo gettext('Statement Lines') ?></span>
 <form method="post" id="so_site"  name="cm_statement_line">
  <div id="tabsLine">
   <ul class="tabMain">
    <li><a href="#tabsLine-1"><?php echo gettext('Basic') ?></a></li>
    <li><a href="#tabsLine-2"><?php echo gettext('Exchange') ?> </a></li>
    <li><a href="#tabsLine-3"><?php echo gettext('Reference') ?> </a></li>
   </ul>
   <div class="tabContainer">
    <div id="tabsLine-1" class="tabContent">
     <table class="form_line_data_table">
      <thead> 
       <tr>
        <th><?php echo gettext('Action') ?></th>
        <th><?php echo gettext('Seq') ?>#</th>
        <th><?php echo gettext('Line Id') ?></th>
        <th><?php echo gettext('Line') ?> #</th>
        <th><?php echo gettext('Type') ?></th>
        <th><?php echo gettext('Code') ?></th>
        <th><?php echo gettext('Trx Date') ?></th>
				<th><?php echo gettext('Amount') ?></th>
				<th><?php echo gettext('Recon Amount') ?></th>
				<th><?php echo gettext('Status') ?></th>
       </tr>
      </thead>
      <tbody class="form_data_line_tbody">
					<?php
					$count = 0;
					foreach ($cm_statement_line_object as $cm_statement_line) {
					 if( $$class_second->status == 'RECON'){
						$status_class = ' always_readonly dont_copy';
					 }else{
						$status_class = ' ';
					 }
					 ?>         
 			 <tr class="cm_statement_line<?php echo $count ?>">
 				<td>
						 <?php
						 echo ino_inline_action($cm_statement_line->cm_statement_line_id, array('cm_statement_header_id' => $cm_statement_header->cm_statement_header_id));
						 ?>
 				</td>
 				<td><?php $f->seq_field_d($count) ?></td>
 				<td><?php form::text_field_wid2sr('cm_statement_line_id', 'line_id always_readonly'); ?></td>
 				<td><?php $f->text_field_wid2('line_num'); ?></td>
 				<td><?php echo $f->select_field_from_array('line_type', cm_statement_line::$line_type_a, $$class_second->line_type, '', 'medium'); ?></td>
 				<td><?php $f->text_field_wid2('line_code'); ?></td>
 				<td><?php $f->text_field_wid2('transaction_date'); ?></td>
 				<td><?php $f->text_field_wid2('transaction_value'); ?></td>
 				<td><?php $f->text_field_wid2('reconciled_value'); ?></td>
 				<td><?php echo $f->select_field_from_array('status', cm_statement_line::$line_status_a, $$class_second->status , '' , $status_class); ?></td>

 			 </tr>
				<?php
				$count = $count + 1;
			 }
			 ?>
      </tbody>
     </table>
    </div>
    <div id="tabsLine-2" class="scrollElement tabContent">
     <table class="form_line_data_table">
      <thead> 
       <tr>
        <th><?php echo gettext('Seq') ?></th>
				<th><?php echo gettext('Currency') ?></th>
        <th><?php echo gettext('Rate Type') ?></th>
        <th><?php echo gettext('Rate Date') ?></th>
        <th><?php echo gettext('Rate Value') ?></th>
        <th><?php echo gettext('Original Amount') ?></th>
				<th><?php echo gettext('Source Status'); ?></th>
       </tr>
      </thead>
      <tbody class="form_data_line_tbody">
					<?php
					$count = 0;
					foreach ($cm_statement_line_object as $cm_statement_line) {
					 if ((empty($cm_statement_line->price_list_header_id)) && !empty($document_type_i->price_list_header_id)) {
						$cm_statement_line->price_list_header_id = $document_type_i->price_list_header_id;
						$cm_statement_line->price_date = empty($cm_statement_line->price_date) ? current_time(true) : $cm_statement_line->price_date;
					 }
					 ?>         
 			 <tr class="cm_statement_line<?php echo $count ?>">
 				<td><?php $f->seq_field_d($count) ?></td>
 				<td><?php echo $f->select_field_from_object('currency', option_header::currencies(), 'option_line_code', 'option_line_value', $$class_second->currency, '', 'medium', 1); ?></td>
 				<td><?php echo $f->select_field_from_object('exchange_type', gl_currency_conversion::currency_conversion_type(), 'option_line_code', 'option_line_value', $$class_second->exchange_type, '', 'medium', 1); ?></td>
 				<td><?php $f->text_field_wid2('exchange_date'); ?></td>
 				<td><?php $f->text_field_wid2('exchange_rate'); ?></td>
 				<td><?php $f->text_field_wid2('original_amount'); ?></td>
				<td><?php echo $$class_second->source_status ; ?></td>
 			 </tr>
				<?php
				$count = $count + 1;
			 }
			 ?>
      </tbody>
      <!--                  Showing a blank form for new entry-->
     </table>
    </div>
    <div id="tabsLine-3" class="scrollElement tabContent">
     <table class="form_line_data_table">
      <thead> 
       <tr>
        <th><?php echo gettext('Seq') ?>#</th>
        <th><?php echo gettext('Agent') ?></th>
        <th><?php echo gettext('Agent Bank AC') ?></th>
        <th><?php echo gettext('Invoice') ?></th>
        <th><?php echo gettext('Description') ?></th>
				<th><?php echo gettext('Receipt Number'); ?></th>
				<th><?php echo gettext('Receipt Line'); ?></th>
				<th><?php echo gettext('Payment Number'); ?></th>
				<th><?php echo gettext('Payment Line'); ?></th>
				
       </tr>
      </thead>
      <tbody class="form_data_line_tbody">
					<?php
					$count = 0;
					foreach ($cm_statement_line_object as $cm_statement_line) {
					 if (!empty($$class_second->ar_receipt_header_id)) {
						$ar_recipt_header_i = ar_receipt_header::find_by_id($$class_second->ar_receipt_header_id);
						$$class_second->receipt_number = $ar_recipt_header_i->receipt_number;
						$$class_second->ar_customer_id = $ar_recipt_header_i->ar_customer_id;
						if (!empty($$class_second->ar_receipt_line_id)) {
						 $$class_second->line_number = ar_receipt_line::find_by_id($$class_second->ar_receipt_line_id)->line_number;
						} else {
						 $$class_second->line_number = null;
						}
					 } else {
						$$class_second->receipt_number = $$class_second->line_number = $$class_second->ar_customer_id = null;
					 }

					 if (!empty($$class_second->ap_payment_header_id)) {
						$ap_payment_header_i = ap_payment_header::find_by_id($$class_second->ap_payment_header_id);
						$$class_second->payment_number = $ap_payment_header_i->payment_number;
						$$class_second->supplier_id = $ap_payment_header_i->supplier_id;
						if (!empty($$class_second->ap_payment_line_id)) {
						 $$class_second->ap_line_number = ap_payment_line::find_by_id($$class_second->ap_payment_line_id)->line_number;
						} else {
						 $$class_second->ap_line_numberx = null;
						}
					 } else {
						$$class_second->payment_number = $$class_second->ap_line_number = $$class_second->supplier_id = null;
					 }
					 ?>         
 			 <tr class="cm_statement_line<?php echo $count ?>">
 				<td><?php $f->seq_field_d($count) ?></td>
 				<td><?php $f->text_field_wid2('agent_name'); ?></td>
 				<td><?php $f->text_field_wid2('agent_bank_account'); ?></td>
 				<td><?php $f->text_field_wid2('invoice_num'); ?></td>
 				<td><?php $f->text_field_wid2('description'); ?></td>
 				<td><?php
						 $f->val_field_wid2('receipt_number', 'ar_receipt_all_v', 'receipt_number', 'ar_customer_id');
						 echo $f->hidden_field_withCLass('ar_receipt_header_id', $$class_second->ar_receipt_header_id, 'dont_copy_r');
//						 echo $f->hidden_field_withCLass('ar_customer_id', $$class_second->ar_customer_id, 'popup_value ar_customer_id');
//						 echo $f->hidden_field_withCLass('receipt_status', 'PENDING', 'popup_value receipt_status');
						 ?>
 				 <i class="generic g_select_ar_receipt_number select_popup clickable fa fa-search" data-class_name="ar_receipt_all_v"></i></td>
 				<td><?php
						 $f->val_field_wid2('line_number', 'ar_receipt_all_v', 'line_number', 'ar_customer_id');
						 echo $f->hidden_field_withCLass('ar_receipt_line_id', $$class_second->ar_receipt_line_id, 'dont_copy_r');
//						 echo $f->hidden_field_withCLass('ar_customer_id', $$class->ar_customer_id, 'popup_value ar_customer_id');
						 echo $f->hidden_field_withCLass('receipt_status', 'PENDING', 'popup_value receipt_status');
						 ?>
 				 <i class="generic g_select_ar_receipt_number select_popup clickable fa fa-search" data-class_name="ar_receipt_all_v"></i></td>
 				<td><?php
						 $f->val_field_wid2('payment_number', 'ap_payment_all_v', 'payment_number', 'supplier_id');
						 echo $f->hidden_field_withCLass('ap_payment_header_id', $$class_second->ap_payment_header_id, 'dont_copy_r');
						 echo $f->hidden_field_withCLass('supplier_id', $$class_second->supplier_id, 'popup_value supplier_id');
						 ?>
 				 <i class="generic g_select_ap_payment_number select_popup clickable fa fa-search" data-class_name="ap_payment_all_v"></i></td>
 				<td><?php
						 $f->val_field_wid2('ap_line_number', 'ap_payment_all_v', 'line_number', 'supplier_id');
						 echo $f->hidden_field_withCLass('ap_payment_line_id', $$class_second->ap_payment_line_id, 'dont_copy_r');
//						 echo $f->hidden_field_withCLass('supplier_id', $$class->supplier_id, 'popup_value supplier_id');
						 ?>
 				 <i class="generic g_select_ap_payment_number select_popup clickable fa fa-search" data-class_name="ap_payment_all_v"></i></td>
				
 			 </tr>
				<?php
				$count = $count + 1;
			 }
			 ?>
      </tbody>
      <!--                  Showing a blank form for new entry-->
     </table>
    </div>
   </div>
  </div>
 </form>

</div>

<div id="js_data">
 <ul id="js_saving_data">
  <li class="headerClassName" data-headerClassName="cm_statement_header" ></li>
  <li class="lineClassName" data-lineClassName="cm_statement_line" ></li>
  <li class="savingOnlyHeader" data-savingOnlyHeader="false" ></li>
  <li class="primary_column_id" data-primary_column_id="cm_statement_header_id" ></li>
  <li class="form_header_id" data-form_header_id="cm_statement_header" ></li>
  <li class="line_key_field" data-line_key_field="line_num" ></li>
  <li class="single_line" data-single_line="false" ></li>
  <li class="form_line_id" data-form_line_id="cm_statement_line" ></li>
 </ul>
 <ul id="js_contextMenu_data">
  <li class="docHedaderId" data-docHedaderId="cm_statement_header_id" ></li>
  <li class="docLineId" data-docLineId="cm_statement_line_id" ></li>
  <li class="btn1DivId" data-btn1DivId="cm_statement_header" ></li>
  <li class="btn2DivId" data-btn2DivId="form_line" ></li>
  <li class="tbodyClass" data-tbodyClass="form_data_line_tbody" ></li>
  <li class="noOfTabbs" data-noOfTabbs="3" ></li>
 </ul>
</div>