@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Cán bộ'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('users.store') : route('users.update', $model->id);
@endphp

<form action="{{ $url }}" method="post" class="box">
    @if($config['method'] == 'update')
        @method('PUT')
    @endif

    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Thông tin chung</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Tài khoản <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="account"
                                        value="{{ old('account', ($model->account) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Email</label>
                                    <input 
                                        type="text"
                                        name="email"
                                        value="{{ old('email', ($model->email) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Họ Tên <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="name"
                                        value="{{ old('name', ($model->name) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Số hiệu CBCC <span class="text-danger">(*)</span></label>
                                    <input 
                                        type="text"
                                        name="cid"
                                        value="{{ old('cid', ($model->cid) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Chức vụ <span class="text-danger">(*)</span></label>
                                    <select name="user_catalogue_id" class="form-control setupSelect2">
                                        <option value="0">Chọn chức vụ</option>
                                        @if(isset($user_catalogues))
                                            @foreach($user_catalogues as $key => $val)
                                                <option {{ 
                                                    $val->id == old('user_catalogue_id', (isset($model->user_catalogues->id)) ? $model->user_catalogues->id : '') ? 'selected' : '' 
                                                    }}  value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ngày vào</label>
                                    <input 
                                        type="date"
                                        name="hide_date"
                                        value="{{ old('hide_date', (isset($model->hide_date)) ? date('Y-m-d', strtotime($model->hide_date)) : '') }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        @if($config['method'] == 'create')
                            <div class="row mb15">
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Mật khẩu <span class="text-danger">(*)</span></label>
                                        <input 
                                            type="password"
                                            name="password"
                                            value=""
                                            class="form-control"
                                            placeholder=""
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-row">
                                        <label for="" class="control-label text-left">Nhập lại mật khẩu <span class="text-danger">(*)</span></label>
                                        <input 
                                            type="password"
                                            name="re_password"
                                            value=""
                                            class="form-control"
                                            placeholder=""
                                            autocomplete="off"
                                        >
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ngày sinh</label>
                                    <input 
                                        type="date"
                                        name="birthday"
                                        value="{{ old('birthday', (isset($model->birthday)) ? date('Y-m-d', strtotime($model->birthday)) : '') }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ảnh đại diện </label>
                                    <input 
                                        type="text"
                                        name="image"
                                        value="{{ old('image', ($model->image) ?? '') }}"
                                        class="form-control upload-image"
                                        placeholder=""
                                        autocomplete="off"
                                        data-upload="Images"
                                    >
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Chọn đội <span class="text-danger">(*)</span></label>
                                    <select name="team_id" class="form-control setupSelect2">
                                        <option value="">Chọn chức vụ</option>
                                        @if(isset($teams))
                                            @foreach($teams as $key => $val)
                                                <option {{ 
                                                    $val->id == old('team_id', (isset($model->teams->id)) ? $model->teams->id : '') ? 'selected' : '' 
                                                    }}  value="{{ $val->id }}">{{ $val->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="row">
                    <div class="ibox-title">
                        <h5>Thông tin liên hệ</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Thành Phố</label>
                                    <select name="province_id" class="form-control setupSelect2 province location" data-target="districts">
                                        <option value="0">[Chọn Thành Phố]</option>
                                        @if(isset($provinces))
                                            @foreach($provinces as $province)
                                                <option @if(old('province_id') == $province->code) selected @endif value="{{ $province->code }}">{{ $province->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Quận/Huyện </label>
                                    <select name="district_id" class="form-control districts setupSelect2 location" data-target="wards">
                                        <option value="0">[Chọn Quận/Huyện]</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Phường/Xã </label>
                                    <select name="ward_id" class="form-control setupSelect2 wards">
                                        <option value="0">[Chọn Phường/Xã]</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Địa chỉ </label>
                                    <input 
                                        type="text"
                                        name="address"
                                        value="{{ old('address', ($model->address) ?? '') }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Số điện thoại</label>
                                    <input 
                                        type="text"
                                        name="phone"
                                        value="{{ old('phone', ($model->phone) ?? '') }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Ghi chú</label>
                                    <input 
                                        type="text"
                                        name="description"
                                        value="{{ old('description', ($model->description) ?? '') }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="table table-striped table-bordered custom">
                            <thead>
                                <th>
                                    <input type="checkbox" value="" id="checkAllPermission" class="input-checkbox">
                                </th>
                            </thead>
                            @foreach($permissions as $permission)
                                @if($permission->module == 'user_catalogues' || $permission->module == 'users' || $permission->module == 'permissions' || $permission->module == 'teams') 
                                    @continue; 
                                @endif
                                <tr>
                                    <td class="lft">
                                        <a href="" class="uk-flex uk-flex-middle uk-flex-space-between">{{ $permission->title }} <span style="color:red;">({{ $permission->name }})</span> </a>
                                    </td>
                                    <td class="check">
                                        <input 
                                            type="checkbox" 
                                            name="permission_modules[]" 
                                            value="{{ $permission->id }}" class="form-control checkBoxPermissionItem"
                                            {{ (isset($model) && collect($model->permission_modules)->contains('id', $permission->id)) || in_array($permission->id, old('permission_modules', [])) ? 'checked' : '' }}
                                        >
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mb15">
            <button class="btn btn-primary" type="submit" name="send" value="send">Lưu lại</button>
        </div>
    </div>
</form>
@endsection
<script>
    var province_id = '{{ (isset($model->province_id)) ? $model->province_id : old('province_id') }}'
    var district_id = '{{ (isset($model->district_id)) ? $model->district_id : old('district_id') }}'
    var ward_id = '{{ (isset($model->ward_id)) ? $model->ward_id : old('ward_id') }}'
</script>