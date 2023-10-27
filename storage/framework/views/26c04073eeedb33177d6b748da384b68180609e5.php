<div class="card card-profile" id="localorder_phone">
    <div class="px-4">
      <div class="mt-3">
        <h6><?php echo e(__('Phone')); ?><span class="font-weight-light"></span></h6>
      </div>
      <div class="card-content border-top">
        <br />
        <div class="form-group<?php echo e($errors->has('phone') ? ' has-danger' : ''); ?>">
            <input type="text"  <?php if(auth()->guard()->check()): ?> value="<?php echo e(auth()->user()->phone); ?>" <?php endif; ?> name="phone" id="phone" class="form-control<?php echo e($errors->has('phone') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__( 'Your phone here' )); ?> ..." required></input>
            <?php if($errors->has('phone')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('phone')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
      </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/cart/localorder/phone.blade.php ENDPATH**/ ?>