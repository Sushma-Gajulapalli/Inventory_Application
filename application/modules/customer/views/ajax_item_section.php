<style type="text/css">
#cssTable th,td 
{
    padding: 5px;
}
.frmSearch {padding:10px 0;border-radius:4px;}
#country-list{z-index: 999;float:left;list-style:none;margin-top:-3px;padding:0;position: absolute;}
#country-list li{padding: 10px; background: #f0f0f0; border-bottom: #bbb9b9 1px solid;}
#country-list li:hover{background:#ece3d2;cursor: pointer;}
#search-box{padding: 10px;border: #a8d4b1 1px solid;border-radius:4px;}


#list_item_table td span:hover {
    cursor: pointer;
    color: #ef5921;
}

.style_class{

    color: #fff;padding: 8px;background-color: #021a47 !important;
}
</style>
<div class="row">
    <div class="mt-4">
        <h4 class="header-title mb-4">Select Items</h4>
        <div style="color: red;font-size: 16px;" id="goods_error_div"></div>
    </div> <!-- end card-box-->
</div> <!-- end col -->

<div class="row">
    <div class="col-md-7">
        <div class="table-responsive-sm">
            <table border="1" width="100%" class="item_list_tbl cssTable" style="margin-top:50px;">
                <thead>
                    <tr>
                        <th class="style_class"><b>List of items</b></th>
                        <!-- th class="style_class"><b>Points</b></th> -->
                        <th class="style_class" style="text-align: center;"><b>Qty</b></th>
                        <th class="style_class" style="text-align: center;"><i class="fa fa-times" aria-hidden="true"></i></th>
                    </tr>   
                </thead>
                <tbody>
                   <!-- for edit quotation -->
                   <?php
                        /*its working while edit quotation from customer profile*/
                        if(!empty(@$customer_quotation_item)){

                        $index_auto = 1;    
                            foreach ($customer_quotation_item as $key => $item) {
                        ?>
                            <tr item_id_value="<?php echo $item->item_slug;?>" id="remove_item_id_<?php echo $index_auto;?>">
                            <td style="width:40%;"><?php echo $item->item_name;?>
                            <input type="hidden" class="item_selected_list" name="storage_item_slug[]" value="<?php echo $item->item_slug;?>">
                            </td>
                           
                            <td style="width:20%;"><input onkeypress="return isNumberKey(event,this)" id="set_item_qty_<?php echo $item->item_slug;?>" class="form-control item_qty_valid" value="<?php echo $item->item_count;?>" type="text" name="storage_item_qty[<?php echo $item->item_slug;?>]"></td>
                            <td style="width:20%;text-align: center;"><i onclick="remove_item_fun('<?php echo $index_auto;?>')" style="width:30px !important;height:30px !important;line-height:2px;" class="fa fa-trash btn btn-danger" aria-hidden="true"></i></td>
                        </tr>
                        <?php   

                           $index_auto++; 
                            }
                        }
                   ?>
                </tbody>
            </table>
            <!-- used while edit quotation -->
                <?php
                    if(!empty($customer_quotation_item)){
                ?>
                    <input type="hidden" name="quotation_id" value="<?php echo $customer_quotation_item[0]->quotation_id;?>">
                <?php        
                }
                ?>
        </div>  
    </div> <!-- end col-->

    <div class="col-md-5">
        <div class="frmSearch">
            <input type="text" autocomplete="off" id="search-box" placeholder="Search Item Name"/>
            <div id="suggesstion-box"></div>
        </div>

        <table border="1" width="100%" id="list_item_table" class="cssTable" style="margin: 0px;">
            <tr>
                <th style="color: #fff;padding: 8px;background-color: #021a47 !important;">Item Description</th>
                <!-- <th>Item Point</th> -->
            </tr>
            <?php
            if(!empty($quotation_item_list)){

                foreach ($quotation_item_list as $item_list) {
                
                foreach ($item_list as $item) {
              ?>    
                <tr>
                    <td><span class="item_click_btn" onclick="select_item_name('<?php echo $item->storage_item_id;?>','<?php echo $item->storage_item_slug;?>')"><?php echo $item->storage_item_name;?></span></td>
                    <!-- <td><?php //echo $item->storage_item_point;?></td> -->
                </tr>
            <?php      
                    }
                }
            }
            ?>    
        </table>
       
    </div> <!-- end col-->
</div> <!-- end row-->

<script type="text/javascript">

function isNumberKey(evt, obj) {

      var charCode = (evt.which) ? evt.which : event.keyCode
      var value = obj.value;
      var dotcontains = value.indexOf(".") != -1;
      if (dotcontains)
          if (charCode == 46) return false;
      if (charCode == 46) return true;
      if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
      return true;
}


var tableBody = $("table.item_list_tbl tbody"); 

var index_auto =500;

var selected_item_arr =[]; /*global array*/


<?php

    if(!empty($customer_quotation_item)){

        foreach ($customer_quotation_item as $key => $item) {
    ?>
        selected_item_arr.push('<?php echo $item->item_slug;?>');
    <?php       
        }
    }
?>

$("#search-box").keyup(function(){
    $.ajax({
        type: "POST",
        url: '<?php echo base_url()?>customer/get_items',
        data:'keyword='+$(this).val(),
        beforeSend: function(){
            //$("#search-box").css("background","#FFF url(LoaderIcon.gif) no-repeat 165px");
        },
        success: function(data){
            $("#suggesstion-box").show();
            $("#suggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
    });
});


function select_item_name(storage_item_id,item_slug) {



    if(jQuery.inArray(item_slug, selected_item_arr) !== -1){

        var old_val =  $("#set_item_qty_"+item_slug).val();  
        var new_val = parseInt(old_val) + parseInt(1);
        $("#set_item_qty_"+item_slug).val(new_val); 

    }else{

        $(".item_click_btn").css('pointer-events','none');

        $.ajax({
          url: '<?php echo base_url()?>customer/get_item_data',
          type: 'POST',
          data: {'storage_item_id':storage_item_id},
          success: function (response)
          {
            var obj = JSON.parse(response);
            $("#search-box").val(obj.storage_item_name);

               $(".item_click_btn").css('pointer-events','auto');
            
                var markup =`<tr id="remove_item_id_${index_auto}">
                    <td style="width:40%;">${obj.storage_item_name}
                    <input type="hidden" class="item_selected_list" name="storage_item_slug[]" value="${obj.storage_item_slug}">
                    </td>
                   
                    <td style="width:20%;"><input class="form-control item_qty_valid" value="1" type="text" onkeypress="return isNumberKey(event,this)" id="set_item_qty_${item_slug}" name="storage_item_qty[${obj.storage_item_slug}]"></td>
                    <td style="width:20%;text-align: center;"><span onclick="remove_item_fun(${index_auto})"><i style="color:red;font-size:18px;" class="fa fa-trash" aria-hidden="true"></i><span></td>
                </tr>`; 

            tableBody.append(markup);

            $('#remove_item_id_'+index_auto).attr('item_id_value',item_slug);

            $("#search-box").val('');

            selected_item_arr.push(item_slug);

            index_auto++;

          }

        });
    }

    

    $("#suggesstion-box").hide();
}

function remove_item_fun(inc){

    var item_id = $(`#remove_item_id_${inc}`).attr('item_id_value');
    var item_index = selected_item_arr.indexOf(item_id);
    if (item_index !== -1) selected_item_arr.splice(item_index, 1);
    $(`#remove_item_id_${inc}`).remove();
} 
</script>
