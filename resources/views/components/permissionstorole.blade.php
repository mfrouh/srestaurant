<div id="permissionstorole" class="modal fade">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">تعديل وظيفة</div>
            <div class="modal-body">
                 <form id="permissionrole">
                    <div class="form-group">
                        <label for="">اسم الوظيفة</label>
                        <input type="text" class="form-control" readonly id="rolename">
                        <input type="hidden" class="form-control" name="role_id" id="roleid" readonly>
                    </div>
                    <div class="form-group">
                        <label for="">الصلاحيات</label>
                        <div class="perm"></div>
                    </div>
                    <div class="form-group text-center">
                        <input type="submit" class="btn btn-primary" value="حفظ">
                    </div>
                 </form>
            </div>
        </div>
    </div>
</div>
