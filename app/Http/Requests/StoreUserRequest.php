<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone'    => 'nullable|string|max:20',
            'birthday' => 'nullable|date',
            'address'  => 'nullable|string|max:255',
            'gender'   => 'required|in:0,1',
            'department_id' => 'required|exists:departments,id',
            'team_id' => 'nullable|exists:teams,id',
            'role_id' => 'nullable|exists:roles,id',
            'start_date' => 'nullable|date',
            'employment_type' => 'required|in:0,1',
        ];
    }
    public function messages()
    {
        return [
            'name.required'          => 'Vui lòng nhập họ và tên.',
            'email.required'         => 'Vui lòng nhập địa chỉ email.',
            'email.email'            => 'Định dạng email không hợp lệ.',
            'email.unique'           => 'Email này đã tồn tại trong hệ thống.',
            'password.required'      => 'Vui lòng tạo mật khẩu đăng nhập.',
            'password.min'           => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'gender.required'        => 'Vui lòng chọn giới tính.',
            'department_id.required' => 'Vui lòng chọn phòng ban.',
            'department_id.exists'   => 'Phòng ban không hợp lệ.',
            'team_id.exists'         => 'Đội nhóm không hợp lệ.',
            'role_id.exists'         => 'Loại tài khoản không hợp lệ.',
            'employment_type.required' => 'Vui lòng chọn hình thức làm việc.',
        ];
    }
}
