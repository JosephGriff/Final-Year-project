<div class="content-wrapper">

  <section class="content">

    <div class="row">
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="saleForm">

            <div class="box-body">
                
                <div class="box">

                    <!-- Employee Name -->              
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control" name="newSeller" id="newSeller" value="<?php echo $_SESSION["name"]; ?>" readonly>

                        <input type="hidden" name="idSeller" value="<?php echo $_SESSION["id"]; ?>">

                      </div>

                    </div>

                    <!-- Receipt Number -->
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-key"></i></span>

                        <?php 
                          $item = null;
                          $value = null;

                          $sales = SalesController::ShowSalesController($item, $value);

                          if(!$sales){

                            echo '<input type="text" class="form-control" name="newSale" id="newSale" value="10001" readonly>';
                          }
                          else{

                            foreach ($sales as $key => $value) {
                              
                            }

                            $code = $value["code"] +1;

                            echo '<input type="text" class="form-control" name="newSale" id="newSale" value="'.$code.'" readonly>';

                          }

                        ?>

                      </div>

                    </div>

                    <!-- Table Number -->              
                    <div class="form-group">

                      <div class="input-group">
                        
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>

                        <input type="text" class="form-control" name="tableNo" id="tableNo" placeholder="Table Number">

                      </div>

                    </div>
                    
                    <!-- Products -->
                    <div class="form-group row newProduct"></div>

                    <input type="hidden" name="productsList" id="productsList">

                    <button type="button" class="btn btn-default hidden-lg btnAddProduct">Add Product</button>

                    <hr>

                    <div class="row">

                      <!-- Tax and Total -->
                      <div class="col-xs-8 pull-right">

                        <table class="table">
                          
                          <thead>
                            
                            <th>Total</th>

                          </thead>


                          <tbody>
                            
                            <tr>
                              
                            <!-- <td style="width: 50%">

                                <div class="input-group">
                                  
                                  <input type="number" class="form-control" name="tax" id="tax" placeholder="0" min="0" required>

                                  <input type="hidden" name="tax" id="tax" required>

                                  <input type="hidden" name="netPrice" id="netPrice" required>
                                  
                                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                                </div>

                              </td> -->

                              <td style="width: 25%">

                                <div class="input-group">
                                  
                                  <span class="input-group-addon"><i class="ion ion-social-euro"></i></span>
                                  
                                  <input type="number" class="form-control" name="newSaleTotal" id="newSaleTotal" placeholder="00000" totalSale="" readonly required>

                                  <input type="hidden" name="saleTotal" id="saleTotal" required>

                                </div>

                              </td>

                            </tr>

                          </tbody>

                        </table>
                        
                      </div>

                      <hr>
                      
                    </div>

                    <hr>

                    <!-- Payment Method -->

                    <div class="form-group row">
                      
                      <div>

                        <div class="btn-toolbar">

                            <button type="button" class="btn btn-primary pull-right" value="cash" name="newPaymenMethod" id="newPaymenMethod" required>Cash</button>
                            <button type="button" class="btn btn-warning pull-right" value="card" name="newPaymeMethod" id="newPaymeMethod" required>Card</button>
                            <button type="button" class="btn btn-danger pull-right" value="voucher" name="newPaymentMethod" id="newPaymentMethod" required>Voucher</button>
                            <button type="submit" class="btn btn-primary pull-right">Open Table</button>
                            <button type="submit" class="btn btn-primary pull-right">Hold</button>

                        </div>

                      </div>

                    </div>

                    <br>
                    
                </div>

            </div>

          </form>

        </div>

      </div>


      <!-- Product Buttons -->
      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
          <div class="box box-warning">
            
            <div class="box-header with-border"></div>

            <div class="box-body">
              
              <table class="table table-bordered salesTable">
                  
                <thead>

                   <tr>
                     
                     <th>Product</th>
                    
                   </tr> 

                </thead>

              </table>

            </div>

          </div>

    </div>

  </section>

</div>