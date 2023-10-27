<div class="col-12">
    <!-- List of items -->

      <form id="order-form" role="form" method="post" action="<?php echo e(route('order.store')); ?>" autocomplete="off" enctype="multipart/form-data">
      <?php echo csrf_field(); ?>
      <?php if(count($timeSlots)>0): ?>
      <!-- Payment -->
      <?php echo $__env->make('cart.payment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php else: ?>
          <!-- Closed restaurant -->
          <?php echo $__env->make('cart.closed', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      <?php endif; ?>
      
      <?php if(!config('settings.social_mode')): ?>

          <?php if(config('app.isft')&&count($timeSlots)>0): ?>
          <!-- FOOD TIGER -->
              <!-- Delivery method -->
              <?php if($restorant->can_pickup == 1): ?>
                  <?php if($restorant->can_deliver == 1): ?>
                    <?php echo $__env->make('cart.delivery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                  <?php endif; ?>
              <?php endif; ?>

              <!-- Delivery time slot -->
              <?php echo $__env->make('cart.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Delivery address -->
              <div id='addressBox'>
                  <?php echo $__env->make('cart.address', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>

              <!-- Custom Fields -->
              <?php echo $__env->make('cart.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Comment -->
              <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php elseif(config('app.isag')): ?>  
              <?php if(count($timeSlots)>0): ?>
                  <!-- Delivery method -->
                  <?php echo $__env->make('cart.delivery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <!-- Delivery time slot -->
                  <?php echo $__env->make('cart.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <!-- Custom Fields  -->
                  <?php echo $__env->make('cart.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <!-- Delivery adress -->
                  <?php echo $__env->make('cart.newaddress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <!-- Client informations -->
                  <?php echo $__env->make('cart.newclient', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <!-- Comment -->
                  <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              <?php endif; ?>

          <?php elseif(config('app.isqrsaas')&&count($timeSlots)>0): ?>

            <!-- QRSAAS -->
            
            <!-- DINE IN OR TAKEAWAY -->
            <?php if(config('settings.enable_pickup')): ?>
            
                <?php if(in_array("poscloud", config('global.modules',[])) || in_array("deliveryqr", config('global.modules',[])) ): ?>
                  <!-- We have POS in QR -->
                  <?php echo $__env->make('cart.localorder.dineiintakeawaydeliver', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                  <!-- Delivery adress -->
                  <div class="qraddressBox" style="display: none">
                    <?php echo $__env->make('cart.newaddress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <br />
                  </div>
                  
                  
                 
                <?php else: ?>
                   <!-- Simple QR -->
                  
                <?php endif; ?>
                
                
            <?php endif; ?>

           

            

            <!-- Custom Fields -->
            <?php echo $__env->make('cart.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            
              

          <?php endif; ?>
      <?php else: ?>
          <!-- Social MODE -->

          <?php if(count($timeSlots)>0): ?>
              <!-- Delivery method -->
              <?php echo $__env->make('cart.delivery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Delivery time slot -->
              <?php echo $__env->make('cart.time', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Custom Fields  -->
              <?php echo $__env->make('cart.customfields', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Delivery adress -->
              <?php echo $__env->make('cart.newaddress', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Client informations -->
              <?php echo $__env->make('cart.newclient', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

              <!-- Comment -->
              <?php echo $__env->make('cart.comment', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          <?php endif; ?>
      <?php endif; ?>

    
  </div><?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/cart/cartcheckouts.blade.php ENDPATH**/ ?>