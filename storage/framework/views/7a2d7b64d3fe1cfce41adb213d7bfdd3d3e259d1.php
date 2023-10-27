<nav id="navbar-main" class="navbar navbar-main navbar-expand-lg headroom py-lg-3 px-lg-6 navbar-light navbar-theme-primary">
    <div class="container">
        <a class="navbar-brand @logo_classes" href="/">
            <img class="navbar-brand-dark common" src="<?php echo e(config('global.site_logo_dark')); ?>" height="35" alt="Logo">
            <img class="navbar-brand-light common" src="<?php echo e(config('global.site_logo')); ?>" height="35" alt="Logo">
        </a>
        <div class="navbar-collapse collapse" id="navbar_global">
            <div class="navbar-collapse-header">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="/">
                            <img src="<?php echo e(config('global.site_logo')); ?>" height="35" alt="Logo">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <a href="#navbar_global" role="button" class="fas fa-times" data-toggle="collapse"
                            data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false"
                            aria-label="Toggle navigation"></a>
                    </div>
                </div>
            </div>
            <ul class="navbar-nav navbar-nav-hover justify-content-center">
                
                <li class="nav-item" data-toggle="collapse" data-target=".navbar-collapse.show">
                    <a data-scroll href="#qrcodemenu" class="nav-link"><?php echo e(__('qrlanding.qr_code_menu')); ?></a>
                </li>
                <?php if(count($availableLanguages)>1): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#">
                        <?php $__currentLoopData = $availableLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $short => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(strtolower($short) == strtolower($locale)): ?> <span><?php echo e(__($lang)); ?></span> <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <i class="fas fa-angle-down nav-link-arrow ml-2"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <?php $__currentLoopData = $availableLanguages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $short => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <a class="dropdown-item" href="/<?php echo e(strtolower($short)); ?>"><?php echo e(__($lang)); ?></a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </li>
                <?php endif; ?>
                <?php if(!empty(config('global.facebook'))): ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="<?php echo e(config('global.facebook')); ?>" target="_blank" data-toggle="tooltip" title="<?php echo e(__('Like us on Facebook')); ?>">
                        <i class="fab fa-facebook-square mr-2"></i>
                        <span class="nav-link-inner--text d-lg-none"><?php echo e(__('Facebook')); ?></span>
                    </a>
                </li>
                <?php endif; ?>
                <?php if(!empty(config('global.instagram'))): ?>
                <li class="nav-item">
                    <a class="nav-link nav-link-icon" href="<?php echo e(config('global.instagram')); ?>" target="_blank" data-toggle="tooltip" title="<?php echo e(__('Follow us on Instagram')); ?>">
                        <i class="fab fa-instagram mr-2"></i>
                        <span class="nav-link-inner--text d-lg-none"><?php echo e(__('Instagram')); ?></span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
        <div class=" @cta_button_classes">
            
        </div>
        <div class="d-flex d-lg-none align-items-center">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global"
                aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon"></span></button>
        </div>
    </div>
</nav>
<?php /**PATH C:\laragon\www\gangnamfalafel-com\resources\views/qrsaas/partials/nav.blade.php ENDPATH**/ ?>