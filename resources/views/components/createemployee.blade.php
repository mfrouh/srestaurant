<div id="createemployee" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">انشاء موظف</div>
            <div class="modal-body">
                 <form id="cemployee">
                     <div class="form-group">
                       <label for="">اسم الموظف</label>
                       <input type="text" name="name"  class="form-control" placeholder="اسم الموظف">
                       <small id="name" class="text-muted"></small>
                     </div>
                     <div class="form-group">
                        <label for="">البريد الالكتروني</label>
                        <input type="email" name="email"  class="form-control" placeholder="البريد الالكتروني">
                        <small id="email" class="text-muted"></small>
                     </div>
                     <div class="form-group">
                        <label for="">كلمة المرور</label>
                        <input type="password" name="password"  class="form-control" placeholder="كلمة المرور">
                        <small id="password" class="text-muted"></small>
                     </div>
                     <div class="form-group">
                        <label for="">تاكيد كلمة المرور </label>
                        <input type="password" name="password_confirmation"  class="form-control" placeholder="تاكيد كلمة المرور">
                        <small id="password_confirmation" class="text-muted"></small>
                     </div>
                     <h5>اسم الوظيفة</h5>
                     <div class="roles"></div>
                     <div class="form-group text-center">
                         <input type="submit" class="btn btn-primary" value="حفظ">
                     </div>
                 </form>
            </div>
        </div>
    </div>
</div>
