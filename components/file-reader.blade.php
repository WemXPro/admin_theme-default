@props(['filePath', 'class' => 'btn btn-primary', 'name' => null])

@php
    $fileExists = \Illuminate\Support\Facades\File::exists(base_path($filePath));
    $fileName = $name ?? basename($filePath);
    $fileId = md5($filePath);
@endphp

@if($fileExists)
    @php
        $content = \Illuminate\Support\Facades\File::get(base_path($filePath));
    @endphp

    <div>
        <!-- Trigger Button -->
        <button
            type="button"
            class="{{ $class }}"
            data-toggle="modal"
            data-target="#modal-{{ $fileId }}">
            {{ $fileName }}
        </button>

        <!-- Modal Structure -->
        <div
            class="modal fade"
            id="modal-{{ $fileId }}"
            tabindex="-1"
            aria-labelledby="modalLabel-{{ $fileId }}"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" style="min-width: 80%">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel-{{ $fileId }}">{{ $fileName }}</h5>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                        @if ($content)
                            <pre class="p-3 rounded text-primary" style="white-space: pre-wrap; word-wrap: break-word;">{{ $content }}</pre>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{!! __('admin.close') !!}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
