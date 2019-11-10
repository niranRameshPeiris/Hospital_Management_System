@extends('layouts.home')

@section('workload')
<form action="/report" method="POST" enctype="multipart/form-data"  onsubmit="return submitForm(this);">
@csrf
<div class="form-group row">
    <label  class="col-sm-2 col-form-label">Patient</label>
    <div class="col-sm-4 ">
        <input list="patients" class="form-control" name="report_id" id="report_id" required>
        <datalist id="patients">
            @foreach($patients as $patient)
                <option value="{{$patient->id}}">{{$patient->name}}</option>
            @endforeach
        </datalist>
    </div>
  </div>

  <!-- <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Report Title</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="title" name="title"  required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Report Date</label>
    <div class="col-sm-4">
      <input type="date" class="form-control" id="date" name="date"  required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Result Value</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="value" name="value"  required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Threshold Value</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="threshold" name="threshold"  required>
    </div>
  </div> -->

  <!-- <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Report Status</label>
    <div class="col-sm-4">
        <select class="form-control" id="report_status" name="report_status" required>
            <option value="">...</option>
            <option value="positive">Positive</option>
            <option value="negative">Negative</option>
        </select>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Result Measurement Type</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="type" name="type"  required>
    </div>
  </div> -->

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">File</label>
    <div class="col-sm-4">
        <input type="file" class="form-control-file" id="pdf" name="pdf" required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Reason for the report</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
    </div>
  </div>

  <!-- <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Description</label>
    <div class="col-sm-8">
        <textarea class="form-control" id="description" name="description" rows="3" ></textarea>
    </div>
  </div> -->

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Physical location</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" id="location" name="location"  required>
    </div>
  </div>

  <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Adherent ( Doctor )</label>
    <div class="col-sm-4">
      <input type="email" class="form-control" id="doc_email" name="doc_email"  >
    </div>
  </div>

  @if($log != null)
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
  @endif
</form>
<script>
function submitForm()
{
    return confirm('Do you want add this record ??');
}
</script>
@endsection
