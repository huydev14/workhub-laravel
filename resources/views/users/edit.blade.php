<form id="form-edit-user" method="POST" action="{{ route('users.update', $user->id) }}"
    class="tw-flex tw-flex-col tw-flex-1 tw-min-h-0" novalidate>
    @csrf
    @method('PUT')
    @include('users._form')
</form>
