
<div class="card card-profile">
    <div class="px-2">
      <div class="mt-3">
        <h6><?php echo e(__('Comment')); ?><span class="font-weight-light"></span></h6>
      </div>
      <div class="card-content border-top">
        <br />
        <div class="form-group<?php echo e($errors->has('comment') ? ' has-danger' : ''); ?>">
            <textarea name="comment" id="comment" class="green-border comment-field form-control<?php echo e($errors->has('comment') ? ' is-invalid' : ''); ?>" placeholder="<?php echo e(__( 'Your comment here' )); ?> ..." onChange="setComments('comment');" ></textarea>
            <?php if($errors->has('comment')): ?>
                <span class="invalid-feedback" role="alert">
                    <strong><?php echo e($errors->first('comment')); ?></strong>
                </span>
            <?php endif; ?>
        </div>
      </div>
      <div class="row col-12">
        <div class="col-6"><button id="btn-cancel-comment" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close" onClick="setCommentToTxt();"><?php echo e(__('Cancel')); ?></button></div>
        <div class="col-6 text-right"><button  id="btn-valid-comment" type="button" class="btn btn-outline-primary action-btn close" data-dismiss="modal" aria-label="Close" onClick="setCommentToTxt();"><?php echo e(__('Apply')); ?></button></div>
      </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/cart/comment.blade.php ENDPATH**/ ?>