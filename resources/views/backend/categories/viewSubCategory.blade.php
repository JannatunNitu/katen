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
                            <th>Sub Category</th>
                            
                        </tr>
                        
                        @foreach($subCategories as $key=>$subCategory)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $subCategory->category->title }}</td>
                            <td> {{ $subCategory->title }} </td>
                        </tr>
                        @endforeach
                        
                        
                    </table>
                    
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Sub category</h3>
                        <div class="card-body">
                            <form action="{{ route('subcategory.store') }}" method="post">
                               @csrf
                               @method('get')
                                
                                <input value="" name="title" class="form-control my-2" placeholder="Category" type="text">
                                @error('category')
                                <span class="text-danger">{{$message}}</span>
                                 @enderror
                                <select name="category_id" class="form-control my-3 ">

                                    @forelse ($categories as $category)
                                    <option value="{{ $category->id }}"> {{$category->title }} </option>
                                    @empty
                                        <option disabled selected>No category found😥</option>
                                    @endforelse
                                    
                                    
                                </select>
                                
                                <button class="btn btn-primary" type="submit">Store sub category</button>
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