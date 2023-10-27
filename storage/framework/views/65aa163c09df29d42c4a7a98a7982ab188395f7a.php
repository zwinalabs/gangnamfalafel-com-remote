<div class="card card-profile">
    <div class="px-4">
      <div class="mt-3">
        <h6><span class="delTime delTimeTS"><?php echo e(__('Delivery time')); ?></span><span class="picTime picTimeTS"><?php echo e(__('Pickup time')); ?></span><span class="font-weight-light"></span></h6>
      </div>
      <div class="card-content border-top">
        <br />
        <?php if(($doWeHaveOrderAfterHours&&count($timeSlots)==1&&$timeSlots[0]==null)|| $restorant->getConfig('always_order_date_time_enable',false)=="true"): ?>
          <input type="datetime-local" id="timeslot" name="timeslot" class="form-control<?php echo e($errors->has('timeslot') ? ' is-invalid' : ''); ?>">
        <?php else: ?>
          <select name="timeslot" id="timeslot" class="form-control<?php echo e($errors->has('timeslot') ? ' is-invalid' : ''); ?>" required>
            <?php $__currentLoopData = $timeSlots; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $text): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value=<?php echo e($value); ?>><?php echo e($text); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          </select>
        <?php endif; ?>
        
      </div>
    </div>
  </div>
<?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/cart/time.blade.php ENDPATH**/ ?>