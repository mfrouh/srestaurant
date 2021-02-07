<div id="createoffer" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">تعديل العرض</div>
            <div class="modal-body">
                 <form id="coffer">
                     <div class="row">
                        <div class="form-group col-12">
                            <label for="">نوع العرض</label>
                            <select name="type" class="form-control" id="etype">
                                <option value="fixed">ثابت</option>
                                <option value="variable">متغير</option>
                            </select>
                            <small class="text-muted"></small>
                        </div>
                        <div class="form-group col-12">
                            <label for="">الرسالة</label>
                            <textarea  name="message" class="form-control" id="emessage" placeholder="الرسالة"></textarea>
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-12">
                            <label for="">قيمة العرض</label>
                            <input type="text" name="value" class="form-control" id="evalue"  placeholder="قيمة العرض" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">بداية العرض</label>
                            <input type="datetime-local" name="start_offer" id="estart_offer" class="form-control"  >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">نهاية العرض</label>
                            <input type="datetime-local" name="end_offer" id="eend_offer" class="form-control"  >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group text-center col-12">
                            <input type="hidden" id="eproduct_id" name="product_id">
                            <input type="hidden" id="eid" name="id">
                            <input type="submit" value="حفظ"  class="btn btn-primary">
                        </div>
                     </div>
                 </form>
            </div>
        </div>
    </div>
</div>

