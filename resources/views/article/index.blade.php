@extends('layouts.app')

@push('js')
    <script src="{{ asset('assets/js/libs/datatable-btns.js?ver=3.0.3') }}"></script>
    <script src="{{ asset('assets/js/example-toastr.js?ver=3.0.3') }}"></script>
    @if (session()->has('success'))
        <script>
            let message = @json(session('success'));
            NioApp.Toast(`<h5>Berhasil</h5><p>${message}</p>`, 'success', {
                position: 'top-right',
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            const datatableWrap = $(".datatable-wrap");
            const wrappingDiv = $("<div>").addClass("w-100").css("overflow-x", "scroll");
            datatableWrap.children().appendTo(wrappingDiv);
            datatableWrap.append(wrappingDiv);
        });
        $(document).on('show.bs.modal', '#deleteArticleModal', function(event) {
            const button = $(event.relatedTarget);
            const slug = button.data('slug');
            const title = button.data('title');
            const modal = $(this);
            const deleteForm = $('#deleteArticleForm');
            const deleteMessage = $('#deleteMessage');

            deleteMessage.html(`Are you sure you want to delete the article <strong>${title}</strong>?`);
            deleteForm.attr('action', `{{ route('article.delete', '') }}/${slug}`);
        });
    </script>
@endpush

@section('content')
    <div class="components-preview wide-xl mx-auto">
        <div class="nk-block nk-block-lg">
            <div class="nk-block-head">
                <div class="nk-block-head-content">
                    <h4 class="nk-block-title">Artikel</h4>
                </div>
            </div>
            <div class="card card-bordered card-preview">
                <div class="card-inner">
                    <div class="d-flex">
                        <a href="{{ route('article.create') }}" class="btn btn-primary mb-2 me-2">
                            <em class="icon ni ni-plus me-1"></em> Tambah Artikel</span>
                        </a>

                    </div>
                    <table
                        class="datatable-init-export nk-tb-list nk-tb-ulist table table-hover table-bordered table-responsive-md"
                        data-auto-responsive="false" data-export-title="Export">
                        <thead>
                            <tr class="table-light nk-tb-item nk-tb-head">
                                <th class="text-nowrap text-center align-middle">No</th>
                                <th class="text-nowrap text-center align-middle">Judul</th>
                                <th class="text-nowrap text-center align-middle">Deskripsi
                                </th>
                                <th class="text-nowrap text-center align-middle">Thumbnail
                                </th>
                                <th class="text-nowrap text-center no-export align-middle">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $index => $article)
                                <tr class="text-center align-middle">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $article->title }}</td>
                                    <td>{{ $article->description }}</td>
                                    <td>
                                        <img src="{{ Storage::url($article->thumbnail) }}" class="img-fluid rounded"
                                            style="width: 150px">
                                    </td>

                                    <td class="text-nowrap justify-content-center align-items-center text-center">
                                        <a href="{{ route('article.show', $article->slug) }}"
                                            class="btn btn-primary btn-xs rounded-pill">
                                            <em class="ni ni-eye"></em>
                                        </a>
                                        <a href="{{ route('article.edit', $article->slug) }}"
                                            class="btn btn-warning btn-xs rounded-pill">
                                            <em class="ni ni-edit"></em>
                                        </a>
                                        <button class="btn btn-danger btn-xs rounded-pill" data-bs-toggle="modal"
                                            data-bs-target="#deleteArticleModal" data-slug="{{ $article->slug }}"
                                            data-title="{{ $article->title }}">
                                            <em class="ni ni-trash"></em>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal fade" id="deleteArticleModal">
        <div class="modal-dialog" role="dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Article</h5>
                    <a href="#" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <em class="icon ni ni-cross"></em>
                    </a>
                </div>
                <div class="modal-body">
                    <form method="POST" class="form-validate is-alter" id="deleteArticleForm">
                        @csrf
                        @method('delete')
                        <div class="mb-3" id="deleteMessage"></div>
                        <div class="form-group text-end">
                            <button type="submit" class="btn btn-lg btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
