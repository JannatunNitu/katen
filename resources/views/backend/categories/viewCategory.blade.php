@extends('layouts.backendlayouts')

@section('backend')
<section id="profile">
    <div class="container mt-5 pt-3">
        <div class="row">
            <div class="col-lg-8">
                    <table class="table">
                        <tr>
                            <th>#</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($categories as $key=>$category)
                        <tr>
                            <td>{{ $categories->firstItem() +$key}}</td>
                            <td>{{ $category->title }}</td>
                            <td>
                                <a href="{{ route('category.edit',$category->slug) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm deleteBtn">Delete</a>
                                <form action="{{route('category.Delete',$category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center">No Data Found😥</td>
                        </tr>
                        @endforelse
                        
                    </table>
                    <div>
                        {{ $categories->links() }}
                    </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3> {{$editCategory ? "Edit" : "Add"}} category</h3>
                        <div class="card-body">
                            <form action="{{ $editCategory ? route('category.Update',$editCategory->slug) : route('category.store') }}" method="post">
                                @csrf
                                @if ($editCategory)
                                @method('PUT ')
                                @endif
                                
                                <input value="{{ $editCategory ? $editCategory->title : "" }}" name="title" class="form-control my-2" placeholder="Category" type="text">
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                 @enderror
                                
                                
                                <button class="btn btn-primary" type="submit">{{$editCategory ? "Update" : "Add"}} category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('customJS')
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                $('.deleteBtn').click(function(){
                    Swal.fire({
                      title: "Are you sure?",
                      text: "You won't be able to revert this!",
                      icon: "warning",
                      showCancelButton: true,
                      confirmButtonColor: "#3085d6",
                      cancelButtonColor: "#d33",
                      confirmButtonText: "Yes, delete it!"
                    }).then((result) => {
                      if (result.isConfirmed) {
                        $(this).next('form').submit()
                      }
                    });
                })
                
            </script>

    @endpush
</section>
@endsection