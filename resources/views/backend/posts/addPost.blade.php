
@extends('layouts.backendlayouts')

@section('backend')
<section id="profile">
    <div class="container mt-5 pt-3">
        <div class="card">
            <div class="card-header">
                <h2>Add Post</h2>
            </div>
            <div class="card-cody mx-3">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input type="text" name="title" class="form-control my-3" placeholder="Enter title">
                        @error('title')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <h6>Image</h6>
                        <input type="file" name="featured_img" class="form-control my-3">
                        @error('featured_img')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row my-3">
                        <div class="col-lg-2">
                            <select class="select CategorySelect" name="category">
                                <option selected disabled>Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}" class="option">{{$category->title}}</option>
                                @endforeach
                               
                            </select>
                        </div><div class="col-lg-2">
                            <select name="subcategory" class="select subCategorySelect">
                                <option selected disabled>Select Sub Category</option>
                                
                            </select>
                        </div>
                    </div>
                    <div>
                        <textarea name="content" class="my-3" id="editor" placeholder="Enter content"></textarea>
                        @error('content')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="btn btn-primary my-3">Add Post</button>
                </form>
            </div>
        </div>

    </div>













    @push('customJS')
           <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

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

            <script>
                ClassicEditor
                   .create( document.querySelector( '#editor' ) )
                   .catch( error => {
                       console.error( error );
                   } );
            </script>


<script>
    $(document).ready(function(){
        $('select').niceSelect();
    });
</script>

<script>
    function getSubCategory(){
         $.ajax({
            url : `{{ route('subcategory.get')}}`,
            method : 'GET',
            data : {
                categoryId: $(this).val()
            },
            success : function(response){
                
                // *RES DATA ARRAY
                let options = []
                if(response.length > 0){
                    response.forEach(subcategory =>{
                    let optionTag = `<option value="${subcategory.id}">${subcategory.title}</option>`
                    // console.log(optionTag);
                    options.push(optionTag)
                })
                $('.subCategorySelect').html(options)
                // console.log(options);
                }else{
                    let optionTag = `<option disabled selected>No Sub Category Has been found</option>`
                    $('.subCategorySelect').html(optionTag)
                }
                return false;
                
            }
         })
    }

    $('.CategorySelect').change(getSubCategory)


</script>

    @endpush
</section>
@endsection

