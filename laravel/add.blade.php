@extends('layout')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Edit Area</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item">Add Area</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Area</h5>

              <form action="{{route('area.save')}}" method="post">
                  @csrf
                  <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Area Name</label>
                      <div class="col-sm-10">
                        <input type="text" name="area" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                      <label for="inputText" class="col-sm-2 col-form-label">Area Name: Arabic</label>
                      <div class="col-sm-10">
                        <input type="text" name="arabic" class="form-control">
                      </div>
                  </div>
                  <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Governorate</label>
                  <div class="col-sm-10">
                    <select class="form-select" name="governorate_id" aria-label="Default select example">
                      <option selected disabled>Governorate</option>
                      @foreach($governorate as $sizes)
                      <option value="{{$sizes->id}}">{{$sizes->governorate}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                  <div class="row mb-3">
                      <label class="col-sm-2 col-form-label">Save</label>
                      <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Submit</button>
                      </div>
                  </div>
              </form>

            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

@endsection
