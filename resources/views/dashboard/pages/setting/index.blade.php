@extends('app')
@section('title', 'Settings')
@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h4>Emails Template</h4>
            </div>
            <!--begin::Card title-->
            <!--begin::Card toolbar-->
        </div>
        <!--end::Card header-->
        <!--begin::Card body-->
        <div class="card-body py-4">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                @foreach ($all as $temp)
                    <li class="nav-item" role="presentation">
                        <button class="nav-link {{ $loop->first ? 'active' : '' }}" id="{{ $temp->slug }}-tab"
                            data-bs-toggle="tab" data-bs-target="#{{ $temp->slug }}" type="button" role="tab"
                            aria-controls="{{ $temp->slug }}" aria-selected="true">{{ $temp->title }}</button>
                    </li>
                @endforeach
            </ul>

            <form action="{{ url('setting') }}" class="mail-temp" method="post">
                @csrf
                <div class="tab-content mt-5" id="myTabContent">

                    @foreach ($all as $temp)
                        <div class="tab-pane fade  {{ $loop->first ? 'active show' : '' }}" id="{{ $temp->slug }}"
                            role="tabpanel" aria-labelledby="{{ $temp->slug }}-tab">
                            <div>
                                {!! $temp->desc_type !!}
                            </div>
                            <div class="form-group">
                                <label>
                                    <textarea class="form-control tinymce" name="slug[{{ $temp->slug }}]">{{ $temp->desc }}</textarea>
                                </label>
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-5 text-end">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-8">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <h4>Main Setting</h4>
            </div>
        </div>

        <div class="card-body py-4">
            <form action="{{ url('setting') }}" class="mail-temp" method="post">
                @csrf
                @foreach ($setting as $temp)
                    <div class="form-group mb-4">
                        <label>{{ $temp->title }}</label>
                        <input class="form-control" name="slug[{{ $temp->slug }}]" value="{{ $temp->desc }}" />
                    </div>
                @endforeach

                <div class="mt-5 text-end">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.tiny.cloud/1/eo34dnm013o96dkbqcg43abfc7vnk6o03ip76kcl7it5z6ba/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        });


        $(document).on('submit', 'form.mail-temp', function(e) {
            e.preventDefault();
            //Get list of all selected ids
            let formData = new FormData($(this)[0]);
            let url = $(this).attr('action');


            //Start Ajax
            $.ajax({
                    type: "post",
                    url: url,
                    processData: false, // tell jQuery not to process the data
                    contentType: false, // tell jQuery not to set contentType
                    async: false,
                    cache: false,
                    enctype: 'multipart/form-data',
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                })
                .done(function(data) {
                    alert(data.msg);
                })
                .fail(function() {

                });
        });
    </script>
@endpush
