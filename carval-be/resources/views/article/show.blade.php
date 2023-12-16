@extends('layouts.app')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/css/editors/summernote.css?ver=3.0.3') }}">
@endpush

@push('js')
    <script src="{{ asset('assets/js/libs/editors/summernote.js?ver=3.0.3') }}"></script>
    <script src="{{ asset('assets/js/editors.js?ver=3.0.3') }}"></script>
    <script>
        $(document).ready(function() {
            var oldThumbnail = "{{ Storage::url($article->thumbnail) }}";
            $("#thumbnail-preview-old").attr("src", oldThumbnail);
            $("#thumbnail").change(function() {
                if (this.files && this.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $("#thumbnail-preview-old").css("display", "none"); // Hide old image
                        $("#thumbnail-preview-new").attr("src", e.target.result);
                        $("#thumbnail-preview-new").css("display", "block");
                    };
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            $('#title').on('input', function() {
                var title = $(this).val();
                var slug = title.toLowerCase().replace(/\s+/g, '-');
                $('#slug').val(slug);
            });
        });
    </script>
@endpush

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <span class="preview-title-lg overline-title">Detail Artikel</span>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4 d-flex align-items-center align-middle justify-content-center">
                                    <div class="row">
                                        <div class="col-sm-12 text-center">
                                            <img id="thumbnail-preview-old"
                                                class="img-fluid rounded-1 h-75 w-50 mt-2 shadow-sm"
                                                src="{{ Storage::url($article->thumbnail) }}" alt="Thumbnail Preview">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="title">Judul</label>
                                                <div class="form-control-wrap mb-3">
                                                    <input type="text" id="title"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        name="title" placeholder="Contoh: " value="{{ $article->title }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label" for="slug">Slug</label>
                                                <div class="form-control-wrap mb-3">
                                                    <input type="text" class="form-control" value="{{ $article->slug }}"
                                                        readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="news_writer">Penulis</label>
                                                    <div class="form-control-wrap mb-3">
                                                        <input type="text" id="news_writer"
                                                            class="form-control @error('news_writer') is-invalid @enderror"
                                                            name="news_writer" placeholder="Contoh: "
                                                            value="{{ $article->news_writer }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="form-label" for="source">Sumber</label>
                                                    <div class="form-control-wrap mb-3">
                                                        <input type="text" class="form-control"
                                                            value="{{ $article->source }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="source_date">Tanggal</label>
                                                        <div class="form-control-wrap mb-3">
                                                            <input type="date" id="source_date"
                                                                class="form-control @error('source_date') is-invalid @enderror"
                                                                name="source_date" placeholder="Contoh: "
                                                                value="{{ $article->source_date }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label" for="description">Deskripsi</label>
                                                        <div class="form-control-wrap">
                                                            <input type="text" class="form-control"
                                                                value="{{ $article->description }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mt-3">
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="preview-block">
                        <span class="preview-title-lg overline-title">Konten</span>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <div class="form-control-wrap">
                                    {!! $article->content !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
