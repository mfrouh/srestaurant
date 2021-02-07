<div id="editproduct" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">انشاء منتج</div>
            <div class="modal-body">
                 <form id="eproduct">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="">اسم المنتج</label>
                            <input type="text" name="name" id="ename" class="form-control"  placeholder="اسم المنتج" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">القسم</label>
                            <select name="category_id" id="ecategory_id" class="form-control">
                                @foreach ($categories as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            <small class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">القائمة</label>
                            <select name="menu_id"  id="emenu_id" class="form-control">
                                @foreach ($menus as $menu)
                                   <option value="{{$menu->id}}">{{$menu->name}}</option>
                                @endforeach
                            </select>
                            <small class="text-muted"></small>
                        </div>
                        <div class="form-group col-12">
                            <label for="">وصف المنتج</label>
                            <textarea  name="description" class="form-control" id="edescription" placeholder="وصف المنتج"></textarea>
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">سعر المنتج</label>
                            <input type="text" name="price" class="form-control" id="eprice"  placeholder="سعر المنتج" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-6">
                            <label for="">كمية المنتج</label>
                            <input type="text" name="quantity" class="form-control" id="equantity"  placeholder="كمية المنتج" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-12">
                            <label for="">صورة المنتج</label>
                            <input type="file" name="image" class="form-control"  placeholder="صورة المنتج" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group col-12">
                            <label for="">فيديو المنتج</label>
                            <input type="text" name="video_url" class="form-control" id="evideo_url"  placeholder="فيديو المنتج" >
                            <small  class="text-muted"></small>
                        </div>
                        <div class="form-group text-center col-12">
                            <input type="hidden" id="eid" name="id">
                            <input type="submit" value="حفظ"  class="btn btn-primary">
                        </div>
                     </div>
                  </form>
            </div>
        </div>
    </div>
</div>

