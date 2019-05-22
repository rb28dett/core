@extends('rb28dett::layouts.master')
@section('icon', 'ion-alert-circled')
@section('title', trans('rb28dett::general.confirmation_page'))
@section('subtitle', trans('rb28dett::general.perform_action'))
@section('breadcrumb')
    <ul class="uk-breadcrumb">
        <li><a href="{{ route('rb28dett::index') }}">@lang('rb28dett::general.home')</a></li>
        <li><span href="">@lang('rb28dett::general.confirmation_page')</span></li>
    </ul>
@endsection
@section('content')
    <div class="uk-container uk-container-large">
        <div uk-grid>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
            <div class="uk-width-1-1@s uk-width-3-5@l uk-width-1-3@xl">
                <div class="uk-card uk-card-default">
                    <div class="uk-card-header">
                        @lang('rb28dett::general.confirmation_page')
                    </div>
                    <div class="uk-card-body">

                            <h4 class="uk-text-break">@if(isset($message)) {{ $message }} @else @lang('rb28dett::general.confirmation_proceed') @endif</h4>
                            <p class="uk-text-break">@if(isset($description)) {{ $description }} @else @lang('rb28dett::general.confirmation_info') @endif</p>
                            <br>
                        <form class="uk-form-stacked"  @if(isset($action)) action="{{ $action }}" @endif method="POST">
                            {{ csrf_field() }}
                            @if(isset($method)) {{ method_field($method) }} @endif
                                <div class="uk-margin">
                                    <a href="{{ URL::previous() }}" class="uk-button uk-button-default">@lang('rb28dett::general.take_me_back')</a>
                                    <button type="submit" class="uk-button uk-button-primary uk-align-right">
                                        <span class="ion-forward"></span>&nbsp; @if(isset($button)) {{ $button }} @else @lang('rb28dett::general.proceed') @endif
                                    </button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-1@s uk-width-1-5@l uk-width-1-3@xl"></div>
        </div>
    </div>
@endsection
