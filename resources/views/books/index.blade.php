@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>List Buku</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary">Add Book</a>
        <table class="table table-bordered table-hover table-striped mb-0 bg-white datatable" id="bookTable">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>
                            <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-delete" >Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

@push('scripts')
    <script type="module">
        $(document).ready(function() {
            $('#bookTable').DataTable();
        });
    </script>
@endpush

@push('scripts')
    <script type="module">
        // $(document).ready(function() {
        //     $("#bookTable").DataTable({
        //         serverSide: true,
        //         processing: true,
        //         ajax: "/getBooks",
        //         columns: [
        //             {
        //                 data: "DT_RowIndex",
        //                 name: "DT_RowIndex",
        //                 orderable: false,
        //                 searchable: false
        //             },
        //             {
        //                 data: "title",
        //                 name: "title"
        //             },
        //             {
        //                 data: "author",
        //                 name: "author"
        //             },
        //             {
        //                 data: "year",
        //                 name: "year"
        //             },
        //             {
        //                 data: "actions",
        //                 name: "actions",
        //                 orderable: false,
        //                 searchable: false
        //             },
        //         ],
        //         order: [
        //             [0, "desc"]
        //         ],
        //         lengthMenu: [
        //             [10, 25, 50, 100, -1],
        //             [10, 25, 50, 100, "All"],
        //         ],
        //     });
        // });

        $(".datatable").on("click", ".btn-delete", function (e) {
                e.preventDefault();

                var form = $(this).closest("form");
                var name = $(this).data("title");

                Swal.fire({
                    title: "Are you sure want to delete\n" + name + "?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonClass: "bg-primary",
                    confirmButtonText: "Yes, delete it!",
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

    </script>
@endpush
