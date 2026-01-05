@extends ('layouts.app', ['title' => 'Article - Create'])

@section('content')


        <!-- Navbar -->
        @include('navbar.media')
        <!-- end Navbar -->

        <!--Graph Content -->
        <div id="main-content" class="w-full flex-1">

            <div class="flex flex-col w-full mx-auto rounded-lg shadow-xl mt-6">

                           
                <div class="w-full p-3">
                    <!--Table Card-->
                    <div class="bg-white border rounded shadow">
                        <div class="border-b p-3">
                        <h3 class="text-xl font-medium text-gray-900 dark:text-white">Create Article</h3>
                        </div>
                        <div class="p-5">
                        <form class="space-y-6 px-6 lg:px-8 pb-4 sm:pb-6 xl:pb-8" action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf                            
                            <div class="grid gap-1 grid-cols-3 grid-rows-1">
                               
                                <div class="mr-2">
                                    <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Article Title</label>
                                    <input type="text" name="title" id="title" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="Article Title" required="">
                                    @error('title')
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                </div>

                                <div class="mr-2">
                                    <label for="category" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Category</label>
                        
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" name="category_id">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>                           
                                </div>

                                <div class="mr-2">
                                    <label for="name" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Image</label>
                                    <input type="file" name="image" id="name" class="bg-gray-50 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required="">
                                    @error('image')
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                            </div>

                                <div>
                                    <label for="title" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Article Content</label>                                   
                                    <textarea id="content" name="content" class="content @error('content') is-invalid @enderror block p-8 w-full h-14 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-gray-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-gray-500 dark:focus:border-gray-500" placeholder="Make Article..."></textarea>
                                    @error('content')
                                  
                                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                                            <div class="px-4 py-2">
                                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                                            </div>
                                        </div>
                                    @enderror
                                </div>
                                
                                <div>
                                    <label for="tags" class="text-sm font-medium text-gray-900 block mb-2 dark:text-gray-300">Tags</label>                       
                                    <select class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" name="tags[]" multiple="multiple">                                   
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}">{{ $tag->name }} </option>
                                    @endforeach
                                    </select>                           
                                </div>
                            
                            <div class="grid gap-1 grid-cols-6 grid-rows-1">                               
                               <div class="mr-2">
                                <button type="resset" class="w-full text-white bg-gray-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <i class="fas fa-redo mr-2"></i>Resset</button>
                               </div>
                               <div class="mr-2">
                                <button type="submit" class="w-full text-white bg-yellow-600 hover:bg-yellow-500 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                    <i class="fas fa-save mr-2"></i>Save</button>
                               </div>
                            </div>
                        </form>                       

                        </div>
                    </div>
                    <!--/table Card-->
                </div>


           


            </div>

        </div>

    </div>


   
    <!-- End Modal -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.6.2/tinymce.min.js"></script>
    <script>
     var editor_config = {
     selector: "textarea.content",
     plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
      };

      tinymce.init(editor_config);
    </script>
    

@endsection