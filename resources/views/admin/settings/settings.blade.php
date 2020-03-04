@extends('layouts.app')

@section('content')
    @include('admin.includes.errors')
    <div class="panel panel-default">
        <div class="panel-heading text-center">
           Edit Settings
        </div>
        <div class="panel-body">
            <form action=" {{ route('settings.update') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="site_name" >Site_Name</label>
                    <input type="text" name="site_name" class="form-control" value="{{ $settings->site_name  }}">
                </div>
                <div class="form-group">
                    <label for="contact_number" >contact_number</label>
                    <input type="text" name="contact_number" class="form-control" value="{{ $settings->contact_number  }}">
                </div>
                <div class="form-group">
                    <label for="contact_email" >contact_email</label>
                    <input type="text" name="contact_email" class="form-control" value="{{ $settings->contact_email  }}">
                </div>
                <div class="form-group">
                    <label for="address" >address</label>
                    <input type="text" name="address" class="form-control" value="{{ $settings->address  }}">
                </div>


                <div class="form-group">
                    <div class="text-center">
                        <button class="btn btn-success" type="submit">
                            Update Settings
                        </button>
                    </div>
                </div>
            </form>




        </div>
    </div>

@endsection
