@extends('admin.layout')

@section('title', 'Edit homepage')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
    <style>
        .content-group { margin-bottom: 22px; padding: 24px; }
        .content-group h2 { margin-bottom: 7px; }
        .group-hint { margin: 0 0 22px; color: #68756c; font-size: 12px; line-height: 1.6; }
        .content-fields { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 19px; }
        .content-fields .form-field { margin: 0; }
        .content-fields .wide { grid-column: 1 / -1; }
        .rich-editor { display: none; min-height: 125px; background: white; font-size: 14px; line-height: 1.65; }
        .rich-editor.ql-container { border-color: #dbe1d7; border-radius: 0 0 9px 9px; }
        .rich-editor .ql-editor { min-height: 125px; }
        .rich-toolbar.ql-toolbar { border-color: #dbe1d7; border-radius: 9px 9px 0 0; background: #f8f9f4; }
        .rich-fallback { min-height: 115px; }
        .editor-note { margin: 7px 0 0; color: #829086; font-size: 10px; }
        .save-row { position: sticky; bottom: 12px; display: flex; justify-content: flex-end; margin-top: 26px; padding: 13px; border: 1px solid rgb(49 89 71 / 12%); border-radius: 13px; background: rgb(246 247 241 / 94%); backdrop-filter: blur(10px); }
        @media (max-width: 700px) { .content-fields { grid-template-columns: 1fr; } .content-fields .wide { grid-column: auto; } .content-group { padding: 19px; } }
    </style>
@endpush

@section('content')
    <div class="page-heading">
        <div>
            <p class="eyebrow">Website content</p>
            <h1>Edit homepage</h1>
            <p class="muted" style="margin: 9px 0 0; font-size: 13px;">Update the copy shown on the public homepage. Formatting is available for paragraph fields.</p>
        </div>
        <a class="button button-secondary" href="{{ route('home') }}" target="_blank" rel="noopener">Preview homepage ↗</a>
    </div>

    <form method="POST" action="{{ route('admin.home-page.update') }}" id="homepage-editor-form">
        @csrf
        @method('PUT')
        @php
            $groups = [
                'Hero' => ['hero_eyebrow', 'hero_title', 'hero_description'],
                'Our approach' => ['approach_eyebrow', 'approach_title', 'approach_description', 'value_1_title', 'value_1_description', 'value_2_title', 'value_2_description', 'value_3_title', 'value_3_description'],
                'About Bhavdarpan' => ['about_eyebrow', 'about_title', 'about_paragraph_one', 'about_paragraph_two'],
                'Counseling options' => ['support_eyebrow', 'support_title', 'support_description', 'in_person_title', 'in_person_description', 'virtual_title', 'virtual_description'],
                'Closing message' => ['closing_title', 'closing_description'],
            ];
        @endphp

        @foreach ($groups as $groupName => $keys)
            <section class="panel content-group" aria-labelledby="group-{{ $loop->index }}">
                <h2 id="group-{{ $loop->index }}">{{ $groupName }}</h2>
                <p class="group-hint">Text-only fields keep their plain text formatting. Paragraph fields support basic bold, italic, underline, and quote formatting.</p>
                <div class="content-fields">
                    @foreach ($keys as $key)
                        @php
                            $field = $fields[$key];
                            $fieldId = 'content-'.$key;
                            $value = old('content.'.$key, $content[$key]);
                        @endphp
                        <div class="form-field {{ $field['type'] === 'rich' ? 'wide' : '' }}">
                            <label for="{{ $fieldId }}">{{ $field['label'] }}</label>
                            @if ($field['type'] === 'rich')
                                <textarea class="rich-fallback" id="{{ $fieldId }}" name="content[{{ $key }}]" data-rich-fallback>{{ $value }}</textarea>
                                <div class="rich-editor" data-rich-editor="{{ $fieldId }}" aria-label="{{ $field['label'] }} rich text editor"></div>
                                <p class="editor-note">You can also edit this field as plain text if the formatting editor is unavailable.</p>
                            @else
                                <input id="{{ $fieldId }}" name="content[{{ $key }}]" type="text" value="{{ $value }}" maxlength="255" required>
                            @endif
                            @error('content.'.$key) <p class="field-error">{{ $message }}</p> @enderror
                        </div>
                    @endforeach
                </div>
            </section>
        @endforeach

        <div class="save-row">
            <button class="button" type="submit">Save homepage content</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof Quill === 'undefined') {
                return;
            }

            const editors = [];

            document.querySelectorAll('[data-rich-editor]').forEach((element) => {
                const fallback = document.getElementById(element.dataset.richEditor);
                const toolbar = document.createElement('div');
                toolbar.className = 'rich-toolbar';
                toolbar.innerHTML = '<span class="ql-formats"><button class="ql-bold" type="button" aria-label="Bold"></button><button class="ql-italic" type="button" aria-label="Italic"></button><button class="ql-underline" type="button" aria-label="Underline"></button><button class="ql-blockquote" type="button" aria-label="Quote"></button></span>';
                element.before(toolbar);

                const editor = new Quill(element, {
                    theme: 'snow',
                    formats: ['bold', 'italic', 'underline', 'blockquote'],
                    modules: { toolbar },
                });
                editor.root.innerHTML = fallback.value;
                fallback.hidden = true;
                element.style.display = 'block';
                editors.push({ editor, fallback });
            });

            document.getElementById('homepage-editor-form').addEventListener('submit', () => {
                editors.forEach(({ editor, fallback }) => {
                    fallback.value = editor.root.innerHTML;
                });
            });
        });
    </script>
@endpush
