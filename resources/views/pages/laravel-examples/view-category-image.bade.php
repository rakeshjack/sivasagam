<x-layout bodyClass="g-sidenav-show  bg-gray-200">

    <!-- <x-navbars.sidebar activePage="user-management"></x-navbars.sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
         Navbar -->
        <x-navbars.navs.auth titlePage="User Management"></x-navbars.navs.auth>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card my-4">
                        <div class=" me-3 my-3 text-end">
                            <a class="btn bg-gradient-dark mb-0" href="{{ route('add-category') }}"><i
                                    class="material-icons text-sm">add</i>&nbsp;&nbsp;Add New
                                User</a>
                        </div>
                        <div class="card-body px-0 pb-2" style="margin:2%">
                            <form method='POST' action="{{ route('save-temple') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Name</label>
                                        <input type="text" name="name" class="form-control border border-2 p-2" value='{{ old('name', auth()->user()->name) }}'>
                                        @error('name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                    </div>
                                
                                    <div class="mb-3 col-md-6">
                                        <label class="form-label">Image</label>
                                        <input type="file" name="images[]" class="form-control border border-2 p-2" multiple required>
                                    </div>
                                    
                                </div>
                                <button type="submit" class="btn bg-gradient-dark">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <x-footers.auth></x-footers.auth>
        </div>
    </main>

<!-- </x-layout> -->