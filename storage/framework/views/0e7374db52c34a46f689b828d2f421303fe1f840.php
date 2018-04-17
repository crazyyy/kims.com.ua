<?php $__env->startSection('content'); ?>

   <div class="row login-block">
       <div class="col-md-4 col-md-offset-4">
           <div class="box box-primary">
               <div class="box-header with-border">
                   <h3 class="box-title"><?php echo app('translator')->get("labels.login_form_heading"); ?></h3>
               </div>

               <?php echo Form::open(array("id" => "login_form", "role" => "form", 'class' => 'form-horizontal', "route" => 'admin.login.post')); ?>

                   <div class="box-body">
                       <div class="form-group">
                           <label for="email" class="col-sm-2 control-label"><?php echo app('translator')->get('labels.email'); ?></label>

                           <div class="col-sm-10">
                               <?php echo Form::text('email', '', array("placeholder"=> trans('labels.email'), 'class' => 'form-control input-sm', 'type' => "email" )); ?>

                           </div>
                       </div>
                       <div class="form-group">
                           <label for="password" class="col-sm-2 control-label"><?php echo app('translator')->get('labels.password'); ?></label>

                           <div class="col-sm-10">
                               <?php echo Form::password('password', array("placeholder"=> trans('labels.password'), 'class' => 'form-control input-sm' )); ?>

                           </div>
                       </div>
                       <div class="form-group">
                           <div class="col-sm-offset-2 col-sm-10">
                               <label for="remember" class="checkbox-label">
                                    <input id="remember" name="remember" type="checkbox" class="square" value="1" />

                                    <span class="title"><?php echo app('translator')->get('labels.remember_me'); ?></span>
                               </label>
                           </div>
                       </div>
                   </div>
                   <div class="box-footer">
                       <?php echo Form::submit(trans('labels.login'), array('class' => 'btn btn-info btn-flat pull-right')); ?>

                   </div>
               <?php echo Form::close(); ?>

           </div>
       </div>
   </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.auth', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>