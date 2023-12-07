

@extends('layouts.backendlayouts')

@section('backend')
<section id="profile">
    <div class="container mt-5 pt-3">
        <h2>All Post</h2>

        <table class="table">
            <tr>
                <th>#</th>
                <th>title</th>
                <th>content</th>
                <th>Image</th>
                <th>Popular</th>
                
            </tr>
            @forelse ($posts as $key=>$post)
            <tr>
                <td>{{++$key}}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->content }}</td>
                <td>{{ $post->featured_img }}</td>
                <td>
                            <span class="text-warning starSlect" statusID={{ $post->id}}><i class="fa-{{$post->is_popular == 1 ? "solid" : "regular"}} fa-star"></i></span>
                   
                </td>
                
            </tr>
            @empty
                
            @endforelse
            
        </table>

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


{{-- <script>
    $(document).ready(function(){
        $('select').niceSelect();
    });
</script> --}}

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

<script>

$('.starSlect').click(function(e){
  $.ajax({
    url : `{{ route('post.update') }}`,
    method : 'GET',
    data: { 
        postStatus : $(this).attr('statusID')
    },
    success : function(res){
        if(res == 'success'){
            e.currentTarget.html = '<i class="fa-solid fa-star"></i>';
        }else{
            e.currentTarget.html = '<i class="fa-regular fa-star"></i>',
        }
    }
  })
})



//    function changeStar(){
//      $.ajax({
//         url : `{{ route('post.update') }}`,
//         method : "GET",
//         data : "id":id,
//         success : function(res){
//             console.log('changed successfully')
//         }
//      })
//    }
//    $('.starSlect').click(changeStar)

</script>

    @endpush
</section>
@endsection

