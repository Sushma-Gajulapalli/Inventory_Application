<input type="hidden" name="total_pallet" value="<?php echo $input_pallet;?>">
<input type="hidden" name="total_distance" value="<?php echo $input_distance;?>">
<input type="hidden" name="lift_cost" value="<?php echo $total_lift_cost;?>">
<input type="hidden" name="transport_cost" value="<?php echo $total_transport_cost;?>">
<input type="hidden" name="labour_cost" value="<?php echo $total_labor_cost;?>">

<div style="margin-top:20px;" class="row">
    <div style="text-align: center;" class="col-md-12">
        <span style="color: green;font-size: 20px;font-weight: 500;" class="success_msg_id"></span>
    </div>    
</div>
<div style="margin-top:20px;" class="row">
	   
     <div class="col-md-5">
        <div class="form-group">
            <label for="">Transport charges</label>
            <input type="text" readonly="" name="pickup_charges" value="<?php echo $total_transport_charges;?>" class="form-control" id="pickup_charges">
            <span style="color: red" id="pickup_charges_err"></span>
        </div>
    </div>   

    <div class="col-md-5">
        <div class="form-group">
            <label for="">Storage Charges</label>
            <input readonly="" value="<?php echo $total_storage_charges;?>" type="text" name="storage_charges" class="form-control" id="storage_charges">
        </div> 
	</div>

   
    <div style="display: none;" class="col-md-4">
		<div class="form-group">
			<label for="">Apply coupon</label>
            <select class="form-control" id="storage_tax" name="storage_tax">
            <option value="">Select option</option>
           
            </select>
		</div>
    </div>

    <div id="storage_discount_div" style="display: none;" class="col-md-4">
        <div class="form-group">
            <label for="">Discounted Charges</label>
            <input type="text" readonly="" name="total_storage_charges" class="form-control" value="" id="total_storage_charges">
        </div> 
    </div>
</div>

<!-- <div class="row">
    <div class="col-md-5">
        <div class="form-group">
            <input type="button" name="previous" class="previous action-button-previous" value="Recalculate"/>
        </div>
    </div>   
</div> -->

<div class="row">
    <!-- <div class="col-md-4">
    	<div class="form-group">
            <label for="">Transport charges</label>
            <input type="text" readonly="" name="pickup_charges" value="<?php //echo $total_transport_charges;?>" class="form-control" id="pickup_charges">
            <span style="color: red" id="pickup_charges_err"></span>
        </div>
    </div> -->
    <div style="display: none;" class="col-md-4">
		<div class="form-group">
			<label for="">Apply coupon</label>
            <select class="form-control" id="pickup_tax" name="pickup_tax">
            <option value="">Select option</option>
            
            </select>
		</div>
    </div>

    <div id="pickup_discount_div" style="display: none;" class="col-md-4">
        <div class="form-group">
            <label for="">Discounted Charges</label>
            <input type="text" readonly="" name="total_pickup_charges" class="form-control" value="" id="total_pickup_charges">
        </div> 
    </div>
</div>    


<div style="display: none;" class="row">
    <div class="col-md-3">
    	<div class="form-group">
            <label for="">Stacking & Barcode charges</label>
            <input type="text" readonly="" name="stack_barcode_charges" value="<?php echo $stacking_barcode_charges;?>" class="form-control" id="stack_barcode_charges">
            <span style="color: red" id=""></span>
        </div>
    </div>
    <div class="col-md-3">
		<div class="form-group">
			<label for="">Apply coupon</label>
            <select class="form-control" id="stack_barcode_tax" name="stack_barcode_tax">
            <option value="">Select option</option>
            
            </select>
		</div>
    </div>

    <div id="stack_discount_div" style="display: none;" class="col-md-3">
        <div class="form-group">
            <label for="">Discounted Charges</label>
            <input type="text" readonly="" name="total_stack_barcode_charges" class="form-control" value="" id="total_stack_barcode_charges">
        </div> 
    </div>
</div>

<div style="margin-top: 20px;" class="row">
    <div class="col-md-12">
        <h4>Quotation item List</h4>
    </div>
    <br/>
    <div class="col-md-12">
        <table width="60%" class="table">
            <thead>
                <tr>
                    <th><b>Item Name</b></th>
                    <th><b>Item Quantity</b></th>
                </tr>
            </thead>
            <tbody>                     
            <?php

                if(!empty($quotation_item_list)){

                    foreach ($quotation_item_list as $item) { 
                ?>  
                <tr>                            
                    <td><?php echo $item->storage_item_name;?></td>
                    <td><?php echo @$_POST['storage_item_qty'][$item->storage_item_slug];?></td>
                </tr>
            <?php  } } ?>

            </tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    
$("#book_slot_btn").attr("href",'<?php echo $quotation_pickup_link;?>');

/*step3 */
$(document).on('change','#storage_tax',function(event){

    if($(this).val() != ""){

    	var tax = $(this).val();
		var storage_amt = '<?php echo $total_storage_charges;?>'; 
		var tax_amt = (parseFloat(storage_amt) * parseFloat(tax))/parseFloat(100);
		var final_amt = (parseFloat(storage_amt) - parseFloat(tax_amt));
		$("#total_storage_charges").val(Number(final_amt).toFixed(2));
        $("#storage_discount_div").show();
    }
    else {

        $("#total_storage_charges").val('<?php echo $total_storage_charges;?>');
        $("#storage_discount_div").hide();
    }
});


$(document).on('change','#pickup_tax',function(event){

    if($(this).val() != ""){

    	var tax = $(this).val();
		var transport_amt = '<?php echo $total_transport_charges;?>'; 
		var tax_amt = (parseFloat(transport_amt) * parseFloat(tax))/parseFloat(100);
		var final_amt = (parseFloat(transport_amt) - parseFloat(tax_amt));
		$("#total_pickup_charges").val(Number(final_amt).toFixed(2));
        $("#pickup_discount_div").show();
    }
    else{

        $("#total_pickup_charges").val('<?php echo $total_transport_charges;?>');
        $("#pickup_discount_div").hide();
    }
});

$(document).on('change','#stack_barcode_tax',function(event){

    if($(this).val() != ""){

    	var tax = $(this).val();
		var stack_amt = '<?php echo $stacking_barcode_charges;?>'; 
		var tax_amt = (parseFloat(stack_amt) * parseFloat(tax))/parseFloat(100);
		var final_amt = (parseFloat(stack_amt) - parseFloat(tax_amt));
		$("#total_stack_barcode_charges").val(Number(final_amt).toFixed(2));
        $("#stack_discount_div").show();
    }
    else{

        $("#total_stack_barcode_charges").val('<?php echo $stacking_barcode_charges;?>');
        $("#stack_discount_div").hide();
    }
});
</script>