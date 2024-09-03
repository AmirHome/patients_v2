<div class="modal fade" id="create-faq-questions" tabindex="-1" role="dialog"  aria-hidden="true" >
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" style="margin-top:10vh;">
        <form method="POST" action="{{ route("admin.faq-questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="card-header">{{ trans('cruds.Other.create_faq_questions') }}</div>
            <div class="row">
            <div class="col-md-12">
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.category_helper') }}</span>
            </div>
            </div>
            </div>
            <div class="row">
            <div class="col-md-6">
            <div class="form-group mt-3">
                <label class="required mt-2" for="question">{{ trans('cruds.faqQuestion.fields.question') }}</label>
                <textarea class="form-control mt-2 {{ $errors->has('question') ? 'is-invalid' : '' }}"  name="question" id="question" required>{{ old('question') }}</textarea>
                @if($errors->has('question'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_helper') }}</span>
            </div>
            </div>
        
            <div class="col-md-6">
            <div class="form-group mt-2">
                <label for="answer">{{ trans('cruds.faqQuestion.fields.answer') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('answer') ? 'is-invalid' : '' }}"  name="answer" id="answer">{!! old('answer') !!}</textarea>
                @if($errors->has('answer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_helper') }}</span>
            </div>
            </div>
            </div>

            <div class="row justify-content-end">
                    <div class="form-group">
                        <button type="button" class="btn btn-outline-primary" data-dismiss="modal" aria-label="Close">
                            {{ trans('global.cancel') }}
                        </button>
                    </div>
                    <div class="form-group ">
                        <button class="btn btn-danger" type="submit">{{ trans('global.save') }}</button>
                    </div>
                </div>
        </form>
    </div>
</div>
</div>