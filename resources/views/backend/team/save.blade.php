@extends('backend.dashboard.layout')

@section('content')
    
<x-breadcrumb :title="'Đội'" />
<x-errors :errors="$errors" />

@php
    $url = ($config['method'] == 'create') ? route('teams.store') : route('teams.update', $model->id);
@endphp

<form action="{{ $url }}" method="post" class="box">
    @if($config['method'] == 'update')
        @method('PUT')
    @endif

    @csrf
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Nhập thông tin chung của đội</p>
                        <p>Lưu ý: Những trường đánh dấu <span class="text-danger">(*)</span> là bắt buộc</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Đội <span class="text-danger">(*)</span></label>
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
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Mô tả</label>
                                    <input 
                                        type="text"
                                        name="description"
                                        value="{{ old('description', ($model->description) ?? '' ) }}"
                                        class="form-control"
                                        placeholder=""
                                        autocomplete="off"
                                    >
                                </div>
                            </div>
                        </div>
                        @php
                            $team_vices = isset($model) &&  $model->team_vices->isNotEmpty() ? $model->team_vices->pluck('id')->toArray() : [];
                        @endphp
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-left">Chọn người quản lý<span class="text-danger">(*)</span></label>
                                    <select name="manager_id" class="form-control setupSelect2">
                                        <option value="0">Chọn người quản lý</option>
                                        @if(isset($users))
                                            @foreach($users as $k => $val)
                                                <option {{ 
                                                    $val->id == old('manager_id', (isset($model->manager_id)) ? $model->manager_id : '') ? 'selected' : '' 
                                                    }}  value="{{ $val->id }}">{{ $val->name }} - {{ $val->user_catalogues->name }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label class="control-label">Chọn đội phó</label>
                                    <select multiple name="team_vices[]" class="form-control setupSelect2" id="">
                                        @if($users->isNotEmpty())
                                            @foreach($users as $user)
                                                <option 
                                                    value="{{ $user->id }}"
                                                    {{ in_array($user->id, old('team_vices', $team_vices)) ? 'selected' : '' }}
                                                >{{ $user->name }}</option>
                                            @endforeach
                                        @else
                                            <option disabled>Không có người dùng nào</option>
                                        @endif
                                    </select>
                                </div>  
                            </div>
                        </div>
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