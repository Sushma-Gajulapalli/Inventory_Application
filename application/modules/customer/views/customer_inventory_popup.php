


<h5 class="mb-4" style="color: #021a47"><span class="badge subcategory-badge"> Select Category</span></h5>
<div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-3">
    <?php
    if (!empty($quotation_item_list)) {
        foreach ($quotation_item_list as $item_list) {
            foreach ($item_list as $item) { ?>

               

                       


                <div class="col-md-6 col-xl-2 mt-2">
                    <div class="card subcategory-card shadow-sm border" 
                         onclick="select_item_name_subcategory('<?php echo $item->main_category;?>','<?php echo $item->storage_icon;?>')">
                        <div class="card-body">
                            <div class="icon-container mb-3">

                               
                                <i class="fa fa-truck fa-5x subcategory-icon"></i>
                            

                            


                            </div>
                            <h6 class="card-title text-center">
                                <?php echo $item->storage_item_name; ?> 
                            </h6>
                            <div class="text-center"><?php echo $item->storage_sub_type; ?>
                            </div>

              
              
              


                          
                            


                        </div>

                       


                    </div>

                   


                </div>
    <?php
            }
        }
    }
    ?>
</div>