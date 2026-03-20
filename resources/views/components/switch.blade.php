@props(['name', 'value', 'checked' => false])

<label class="toggle-box">
    <input type="checkbox" name="{{ $name }}" value="{{ $value }}" @checked($checked)>
    <span class="toggle-slider"></span>
</label>
