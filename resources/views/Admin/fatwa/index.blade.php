@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('dashboard.dashboard') }} /</span> {{ __('dashboard.total_fatwas') }}
    </h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- قسم الفلترة --}}
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.fatwas.index') }}" method="GET" class="row g-3">
                <div class="col-12 col-md-4">
                    <label class="form-label">بحث بالعنوان</label>
                    <input type="text" name="search" class="form-control" placeholder="اكتب للبحث..." value="{{ request('search') }}">
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">النوع</label>
                    <select name="type" class="form-select">
                        <option value="">الكل</option>
                        <option value="qa" {{ request('type') == 'qa' ? 'selected' : '' }}>سؤال وجواب</option>
                        <option value="video" {{ request('type') == 'video' ? 'selected' : '' }}>فيديو</option>
                        <option value="ruling" {{ request('type') == 'ruling' ? 'selected' : '' }}>فتوى شرعية</option>
                        <option value="article" {{ request('type') == 'article' ? 'selected' : '' }}>مقال</option>
                    </select>
                </div>
                <div class="col-6 col-md-3">
                    <label class="form-label">الحالة</label>
                    <select name="status" class="form-select">
                        <option value="">الكل</option>
                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>منشور</option>
                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>غير منشور</option>
                    </select>
                </div>
                <div class="col-12 col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="bx bx-filter-alt me-1"></i> فلترة
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('dashboard.total_fatwas') }}</h5>
            <a href="{{ route('admin.fatwas.create') }}" class="btn btn-primary">
                <i class="bx bx-plus me-1"></i> إضافة فتوى جديدة
            </a>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>العنوان</th>
                        <th>النوع</th>
                        <th>تاريخ النشر</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse($fatwas as $fatwa)
                    <tr>
                        <td>{{ $loop->iteration + ($fatwas->currentPage() - 1) * $fatwas->perPage() }}</td>
                        <td><strong>{{ Str::limit($fatwa->title, 40) }}</strong></td>
                        <td>
                            @php
                                $typeLabels = [
                                    'qa' => ['label' => 'سؤال وجواب', 'class' => 'bg-label-info'],
                                    'video' => ['label' => 'فيديو', 'class' => 'bg-label-primary'],
                                    'ruling' => ['label' => 'فتوى شرعية', 'class' => 'bg-label-warning'],
                                    'article' => ['label' => 'مقال', 'class' => 'bg-label-secondary'],
                                ];
                                $type = $typeLabels[$fatwa->type] ?? ['label' => $fatwa->type, 'class' => 'bg-label-dark'];
                            @endphp
                            <span class="badge {{ $type['class'] }} me-1">{{ $type['label'] }}</span>
                        </td>
                        <td>{{ $fatwa->created_at->format('Y-m-d') }}</td>
                        <td>
                            @if($fatwa->is_published)
                                <span class="badge bg-label-success me-1">منشور</span>
                            @else
                                <span class="badge bg-label-danger me-1">غير منشور</span>
                            @endif
                        </td>
                        <td>
                            <div class="dropdown">
                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('admin.fatwas.edit', $fatwa->id) }}">
                                        <i class="bx bx-edit-alt me-1"></i> تعديل
                                    </a>
                                    <form action="{{ route('admin.fatwas.destroy', $fatwa->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من حذف هذه الفتوى؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bx bx-trash me-1"></i> حذف
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">لا توجد فتاوى مطابقة للبحث</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            {{ $fatwas->appends(request()->query())->links() }}
        </div>
    </div>
</div>
@endsection
