@extends('app')

@section('title', 'Category')

@section('content')
    <div class="card">
        <!--begin::Card header-->
        <div class="card-header border-0 pt-6">
            <!--begin::Card title-->
            <div class="card-title">
                <div class="d-flex align-items-center position-relative my-1">
                    {{-- <i class="ki-outline ki-magnifier fs-3 position-absolute ms-5"></i> --}}
                    <input type="text" data-kt-datatable-filter="search"
                           class="form-control form-control-solid w-250px ps-13" placeholder="Search Category"/>
                </div>
            </div>
            <!--begin::Card title-->

            <!--begin::Card toolbar-->
            <div class="card-toolbar">
                <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                    <button type="button" class="btn btn-primary" onclick="firemodal('#kt_modal_add')"
                           > Add Category
                    </button>
                </div>
            </div>
        </div>
        <!--end::Card header-->

        <!--begin::Card body-->
        <div class="card-body py-4">
            <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_datatable">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    <th class="w-10px pe-2">
                        <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                            <input class="form-check-input" hidden type="checkbox" data-kt-check="true"
                                   data-kt-check-target="#kt_datatable .form-check-input" value="0"/>
                        </div>
                    </th>
                    <th class="min-w-125px">Name</th>
                    <th class="min-w-125px">Status</th>
                    <th class="min-w-125px">Data Created</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold render" id="kt_datatable_body">

                @foreach($categories as $category)
                    <tr id="row-{{ $category->id }}">
                        <td></td>
                        <td class="name" data-field="name">
                            {{$category?->name}}
                        </td>
                        <td class="status" data-field="status">
                            @php $status = \App\Enums\CategoryStatus::getStatus($category->status) @endphp
                            <span class="badge badge-{{ $status == "active" ? 'success': 'danger'}}">
                                {{ ucfirst($status) }}
                            </span>
                        </td>
                        <td>
                            {{$category?->created_at?->diffForHumans()}}
                        </td>
                        <td class="text-end">
                            <button id="edit-button-{{ $category->id }}" class="btn btn-icon edit-record btn-active-light-primary w-30px h-30px me-3"
                                    data-route="{{route('admin.categories.edit',$category->id)}}"
                                    data-id="{{$category->id}}"
                                    title="Edit">
                                    <img src="{{asset('icons/write.png')}}" class="action_icon" alt="">
                            </button>
                            <button class="btn btn-icon  delete-button btn-active-light-primary w-30px h-30px"
                                    data-route="{{route('admin.categories.destroy',$category->id)}}"
                                    data-id="{{$category->id}}" data-kt-users-table-filter="delete_row"
                                    title="Delete">
                                    <img src="{{asset('icons/trash.png')}}" class="action_icon" alt="">
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="edit-modal" tabindex="-1" aria-modal="true" role="dialog">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="edit-modal_header">
                    <h2 class="fw-bold">Edit Category</h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-modal-action="close">
                        <i class="ki-outline ki-cross fs-1"></i>
                    </div>
                </div>
                <!--begin::Modal body-->
                <div class="modal-body edit-body scroll-y mx-5 mx-xl-15 my-7">

                </div>
            </div>
        </div>
    </div>
    @include('dashboard.pages.categories.create')
@endsection

@push('js')
<!-- jQuery library -->

    <script src="{{asset('assets/js/crud/table.js')}}"></script>
    <script src="{{asset('assets/js/crud/add.js')}}"></script>
    <script src="{{asset('assets/js/crud/edit.js')}}"></script>
    <script src="{{asset('assets/js/crud/delete.js')}}"></script>
@endpush


