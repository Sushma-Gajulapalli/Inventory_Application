                       




                              <div class="mfb-search">
                                  <img src="<?php echo base_url(); ?>assets/front_new/img/create-quotation/s-icon.svg" class="img-fluid" alt="img"> 
                                  <input type="text" autocomplete="off" id="search-box" placeholder="Add item"/ class="search-box bold" style="width:100%;border-color: #F05200;">  
                                   <div id="suggesstion-box"></div>                             
                              </div>
                                <table class="table table-bordered mb-0 ">
                                          <thead>
                                            <tr>
                                             <!--  <th scope="col"></th> -->
                                              <th scope="col">List of Items </th>
                                              <th scope="col">Quantity</th>
                                            </tr>
                                          </thead>
                                          <tbody class="list_data">
 
                                        <?php
                                        /*its working while edit quotation from customer profile*/


                                        if(!empty(@$customer_quotation_item)){

                                        $index_auto = 1;    
                                        foreach ($customer_quotation_item as $key => $item) {   
                                        ?>

                                            <tr item_id_value="<?php echo $item['item_slug'];?>" id="remove_item_id_<?php echo $index_auto;?>"> 
                                              <td><?php echo $item['item_name'];?><input type="hidden" class="item_selected_list" name="storage_item_slug[]" value="<?php echo $item['item_slug'];?>"></td>
                                              <td>
                                                  <div class="number">
                                                    <span class="minus" data-id="<?php echo $index_auto;?>">-</span>
                                                    <input onkeypress="return isNumberKey(event,this)" id="set_item_qty_<?php echo $item['item_slug'];?>" class="form-control item_qty_valid" value="<?php echo $item['item_count'];?>" type="text" name="storage_item_qty[<?php echo $item['item_slug'];?>]">
                                                    <span class="plus">+</span>
                                                </div>
                                              </td>
                                            </tr>
                                          <?php   
                                            $index_auto++; 
                                            }
                                            }
                                          ?>
                   
                                           
                                          </tbody>
                                </table>

                                <script type="text/javascript">
                                  selected_item_arr=[];
                                </script>


