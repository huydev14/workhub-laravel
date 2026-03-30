<form id="form-create-user" method="POST" action="{{ route('users.store') }}"
    class="tw-flex tw-flex-col tw-flex-1 tw-min-h-0" novalidate>
    @csrf
    @include('users._form')
</form>
