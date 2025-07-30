@extends('backend.layouts.master')

@section('title')
    @lang('translation.create_ticket')
@endsection

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            @lang('translation.tickets')
        @endslot
        @slot('title')
            @lang('translation.create_ticket')
        @endslot
    @endcomponent

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.ticket.store') }}">
                        @csrf
                        <div class="row">

                            <!-- Subject -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="subject" class="form-label">@lang('translation.subject')</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror"
                                        id="subject" name="subject" placeholder="@lang('translation.enter_subject')"
                                        value="{{ old('subject') }}" required>
                                    @error('subject')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Priority -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="priority" class="form-label">@lang('translation.priority')</label>
                                    <select class="form-select @error('priority') is-invalid @enderror" id="priority"
                                        name="priority" required>
                                        <option value="">@lang('translation.select_priority')</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>
                                            @lang('translation.low')</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>
                                            @lang('translation.medium')</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>
                                            @lang('translation.high')</option>
                                    </select>
                                    @error('priority')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label class="form-label">@lang('translation.status')</label>
                                    <select class="form-control @error('status') is-invalid @enderror" name="status">
                                            name="status">
                                            <option value="open" {{ old('status', 'open') == 'open' ? 'selected' : '' }}>
                                                @lang('translation.open')</option>
                                            <option value="in_progress"
                                                {{ old('status') == 'in_progress' ? 'selected' : '' }}>@lang('translation.in_progress')
                                            </option>
                                            <option value="closed" {{ old('status') == 'closed' ? 'selected' : '' }}>
                                                @lang('translation.closed')</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="description" class="form-label">@lang('translation.description')</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                        rows="5" placeholder="@lang('translation.enter_description')" required>{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="text-end pe-3 mb-3">
                            <a href="{{ route('admin.ticket.index') }}" class="btn btn-outline-danger custom-cancel-btn">
                                @lang('translation.cancel')
                            </a>
                            <button type="submit" class="btn btn-secondary w-md">
                                @lang('translation.submit')
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
