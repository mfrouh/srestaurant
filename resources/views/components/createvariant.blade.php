<div id="createvariant" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-header">انشاء نوع</div>
            <div class="modal-body">
                 <form id="cvariant">
                     <div class="form-group">
                       <label for="">سعر النوع</label>
                       <input type="text" name="price"  class="form-control" placeholder="سعر النوع" required>
                       <input type="hidden" name="product_id" id="vproduct_id">
                       <small id="vaprice" class="text-muted"></small>
                     </div>
                     <div class="form-group">
                        <label for="">كمية النوع</label>
                        <input type="text" name="quantity"  class="form-control" placeholder="كمية النوع" required>
                        <small id="vaquantity" class="text-muted"></small>
                     </div>
                     @foreach ($attribute as $oneattribute)
                     <div class="form-group">
                        <label for="">{{$oneattribute->name}}</label>
                        <select name="{{$oneattribute->id}}" class="form-control" required>
                            @foreach ($oneattribute->values as $value)
                              <option value="{{$value->id}}">{{$value->value}}</option>
                            @endforeach
                        </select>
                        <small id="vaquantity" class="text-muted"></small>
                     </div>
                     @endforeach
                     <div class="form-group text-center">
                         <input type="submit" class="btn btn-primary" value="حفظ">
                     </div>
                 </form>
            </div>
        </div>
    </div>
</div>
