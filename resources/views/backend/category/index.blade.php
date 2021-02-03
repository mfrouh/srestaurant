<form action="{{route('category.store')}}" method="POST">
    @csrf
    <div class="form-group">
      <label for=""></label>
      <input type="text" name="name" id="" class="form-control" placeholder="">
      <small id="helpId" class="text-muted">Help text</small>
    </div>
    @error('name')
       <small id="helpId" class="text-muted">{{$message}}</small>
    @enderror
    <input type="submit" class="btn btn-info">

</form>
<form action="{{route('category.update',2)}}" method="POST">
    @csrf
    @method('put')
    <div class="form-group">
      <label for=""></label>
      <input type="text" name="name" id="" class="form-control" placeholder="">
    </div>
    @error('name')
      <small id="helpId" class="text-muted">{{$message}}</small>
    @enderror
    <input type="submit" class="btn btn-info">
</form>
