<div class="itemsSearchHolder">
    <select class="itemsSearch" id="itemsSearch" style="margin-right: 5px" placeholder="<?php echo e(__('Search')); ?>">
        <option></option>
        <?php if(!$restorant->categories->isEmpty()): ?>
        <?php $__currentLoopData = $restorant->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(!$category->items->isEmpty()): ?>
                    <optgroup label="<?php echo e($category->name); ?>" >
                        <?php $__currentLoopData = $category->aitems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($item->id); ?>" ><?php echo e($item->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?> 
    </select>
</div><?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/restorants/partials/itemsearch.blade.php ENDPATH**/ ?>