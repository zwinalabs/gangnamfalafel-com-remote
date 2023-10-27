<div class="card card-profile d-none shadow tablepicker">
    <div class="px-4">
      <div class="mt-5">
        <h3><?php echo e(__('Table')); ?><span class="font-weight-light"></span></h3>
      </div>
      <div class="card-content border-top">
        <br />
        <input type="hidden" value="<?php echo e($restorant->id); ?>" id="restaurant_id"/>
        <?php if($tid==null): ?>
          
          <input type="hidden" value="245" name="table_id" id="table_id"/>
        <?php else: ?>
          <p><?php echo e($tableName); ?></p>
          <input type="hidden" value="245" name="table_id"  id="table_id"/>
        <?php endif; ?>
      </div>
      <br />
      <br />
    </div>
  </div>
<?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/cart/localorder/table.blade.php ENDPATH**/ ?>