@extends('admin.layout.master')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">{{ __('dashboard.dashboard') }} /</span>
        <a href="{{ route('admin.fatwas.index') }}">{{ __('dashboard.total_fatwas') }}</a> / إضافة جديدة
    </h4>

    <div class="row">
        <div class="col-xl">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">إضافة فتوى جديدة</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.fatwas.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="type">النوع</label>
                            <select class="form-select" id="type" name="type" onchange="updateFormLabels()" required>
                                <option value="qa">سؤال وجواب</option>
                                <option value="video">فيديو</option>
                                <option value="ruling">فتوى شرعية</option>
                                <option value="article">مقال</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="title" id="title-label">العنوان</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="أدخل عنوان الفتوى" required />
                        </div>

                        <div class="mb-3" id="video-url-container" style="display: none;">
                            <label class="form-label" for="video_url" id="video-url-label">رابط الفيديو</label>
                            <input type="url" class="form-control" id="video_url" name="video_url" placeholder="https://youtube.com/..." />
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="content" id="content-label">المحتوى</label>
                            <textarea id="content" name="content" class="form-control" placeholder="اكتب محتوى الفتوى هنا..." rows="10"></textarea>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_published" name="is_published" checked value="1">
                                <label class="form-check-label" for="is_published">نشر الفتوى فوراً</label>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">حفظ الفتوى</button>
                            <a href="{{ route('admin.fatwas.index') }}" class="btn btn-outline-secondary">إلغاء</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function updateFormLabels() {
        const type = document.getElementById('type').value;
        const titleLabel = document.getElementById('title-label');
        const titleInput = document.getElementById('title');
        const contentLabel = document.getElementById('content-label');
        const contentInput = document.getElementById('content');
        const videoUrlContainer = document.getElementById('video-url-container');
        const videoUrlInput = document.getElementById('video_url');

        const configs = {
            video: {
                titleLabel: "عنوان الفيديو",
                titlePlaceholder: "أدخل عنوان الفيديو",
                contentLabel: "وصف الفيديو",
                contentPlaceholder: "اكتب وصفاً مختصراً للفيديو",
                showVideo: true
            },
            qa: {
                titleLabel: "السؤال",
                titlePlaceholder: "اكتب السؤال هنا",
                contentLabel: "الإجابة",
                contentPlaceholder: "اكتب الإجابة الشرعية هنا",
                showVideo: false
            },
            ruling: {
                titleLabel: "عنوان الحكم الشرعي",
                titlePlaceholder: "مثلاً: حكم الصلاة في السفر",
                contentLabel: "الحكم الشرعي",
                contentPlaceholder: "اكتب تفاصيل الحكم الشرعي هنا",
                showVideo: false
            },
            article: {
                titleLabel: "عنوان المقال",
                titlePlaceholder: "أدخل عنوان المقال",
                contentLabel: "المقال",
                contentPlaceholder: "اكتب محتوى المقال هنا",
                showVideo: false
            }
        };

        const config = configs[type];

        titleLabel.innerText = config.titleLabel;
        titleInput.placeholder = config.titlePlaceholder;
        contentLabel.innerText = config.contentLabel;
        contentInput.placeholder = config.contentPlaceholder;
        
        if (config.showVideo) {
            videoUrlContainer.style.display = 'block';
            videoUrlInput.required = true;
        } else {
            videoUrlContainer.style.display = 'none';
            videoUrlInput.required = false;
            videoUrlInput.value = '';
        }
    }

    // Run on load to set initial state
    document.addEventListener('DOMContentLoaded', updateFormLabels);
</script>
@endsection
