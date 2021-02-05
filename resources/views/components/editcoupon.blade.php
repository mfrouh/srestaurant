<div id="editcoupon" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">تعديل الخصم</div>
            <div class="modal-body">
                 <form id="ecoupon">
                     <div class="row">
                        <div class="form-group col-6">
                            <label for="">كود الخصم</label>
                            <input type="text" name="code" class="form-control" id="ecode" placeholder="كود الخصم" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">نوع الخصم</label>
                            <select name="type" class="form-control">
                                <option value="fixed">ثابت</option>
                                <option value="variable">متغير</option>
                            </select>
                            <small class="text-muted"></small>
                        </div>
                        <div class="form-group col-12">
                            <label for="">الرسالة</label>
                            <textarea  name="message" class="form-control" id="emessage" placeholder="الرسالة">{{old('message')}}</textarea>
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">قيمة الخصم</label>
                            <input type="text" name="value" class="form-control" value="{{old('value')}}" placeholder="قيمة الخصم" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">عددالمرات</label>
                            <select name="times" class="form-control">
                               @for ($i = 1; $i < 10; $i++)
                                <option value="{{$i}}" {{old('times')==$i?'selected':''}}>{{$i}}</option>
                               @endfor
                            </select>
                            <small class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">بداية الخصم</label>
                            <input type="datetime-local" name="start" class="form-control " value="{{old('start')}}" placeholder="" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">نهاية الخصم</label>
                            <input type="datetime-local" name="end" class="form-control  " value="{{old('end')}}" placeholder="" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">الشرط</label>
                            <select name="cand" class="form-control  @error('cand') is-invalid @enderror">
                                <option value="">اختار نوع الشرط</option>
                                <option value="more" {{old('cand')=='more'?'selected':''}}>اكبر</option>
                                <option value="less" {{old('cand')=='less'?'selected':''}}>اقل</option>
                            </select>
                            <small class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">قيمة شرط الخصم</label>
                            <input type="text" name="cand_value" class="form-control" value="{{old('cand_value')}}" placeholder="قيمة شرط الخصم" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group text-center col-12">
                            <input type="submit" value="حفظ"  class="btn btn-primary">
                        </div>
                     </div>
                 </form>
            </div>
        </div>
    </div>
</div>
