@extends('admin-panel.layouts.master')

@section('content')
<div class="container-fluid px-3 py-4">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 16px; background: #f5f7fa;">
                <div class="card-body">
                    <h4 class="mb-4" style="color: #1976d2; font-weight: bold;">
                        <i class="zmdi zmdi-accounts-alt align-middle"></i> لیست شهروندان
                    </h4>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" style="background: #fff; border-radius: 8px;">
                            <thead style="background: #bbdefb; color: #1976d2;">
                                <tr>
                                    <th>نام</th>
                                    <th>ایمیل</th>
                                    <th>کد ملی</th>
                                    <th>شماره تلفن</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->national_code }}</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">شهروندی وجود ندارد.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 