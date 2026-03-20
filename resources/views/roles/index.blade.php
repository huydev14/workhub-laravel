@extends('layouts.main')

@section('page-header')
    <x-page-header title="Roles & Permissions" description="Review your members roles and allocate permissions">
        <x-slot:action>
            <a href="{{ route('roles.create') }}" class="action-button tw-text-white tw-text-sm tw-font-medium tw-px-4 tw-py-2">
                New Role
            </a>
        </x-slot:action>
    </x-page-header>
@endsection

@section('content')
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-2 lg:tw-grid-cols-3 tw-gap-6">

        @foreach ($roles as $role)
            <x-role-card title="{{ $role->name }}" description="{{ $role->description }}"
                userCount="{{ $role->users_count }}" />
        @endforeach

    </div>
@endsection
