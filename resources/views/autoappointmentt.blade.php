@extends('layouts.home')

@section('workload')

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Disease</label>
    <div class="col-sm-4 ">
        <select class="form-control" id="disease_temp" name="disease_temp" required>
            <option value="1">Cardiologist</option>
            <option value="2">Immunologist</option>
            <option value="3">sick3</option>
            <option value="4">sick4</option>
        </select>
    </div>
  </div>

  <div class="form-group row">
    <div class="col-sm-1"></div>
    <div class="col-sm-2">

    </div>
    <div class="col-sm-2">
    <button class="btn btn-primary btn-block" onclick="searchDoc()">Search</button>
    </div>
    <div class="col-sm-1"></div>
  </div>


<form action="/appointment" method="POST" onsubmit="return submitForm(this);">
@csrf
<input  type="hidden" name="search_doc" id="search_doc" required>
<input  type="hidden" name="disease" id="disease" required>
<input  type="hidden" name="add_meth" id="add_meth" value="2">

<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Doctor</label>
    <div class="col-sm-4 ">
    <label  class="col-form-label" >
    <div id="doc_temp" name="doc_temp"></div>
    </label>
    </div>
</div>
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Patient</label>
    <div class="col-sm-4 ">
        <input list="patients" class="form-control" name="search_patient" id="search_patient" required>
        <datalist id="patients">
            @foreach($patients as $patient)
                <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>
  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="date" name="date" required>
    </div>
  </div>



  <div class="form-group row">
    <div class="col-sm-1"></div>
    <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-block">Set</button>
    </div>
    <div class="col-sm-2">
        <button type="reset" class="btn btn-primary btn-block">Reset</button>
    </div>
    <div class="col-sm-1"></div>
  </div>
</form>
<script>
function submitForm()
{
    return confirm('Do you want to add this record ??');
}
function searchDoc()
{
    var sick = document.getElementById("disease_temp").value;
    $.ajax({
				url: '/getdoc?id=' + sick
			}).done(function(data){
                $val = data.split("#");

                document.getElementById("disease").value = sick;
                document.getElementById("search_doc").value = $val[0];
				document.getElementById("doc_temp").innerHTML = $val[1];
			});
}
</script>
@endsection
