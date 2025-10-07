<?php
    $_SESSION['currentPage'] = "Admin Page";
?>

<x-app-layout>
    <div class="mt-10">
        <div class="w-75 mx-auto">
            <h2>filter</h2>
        </div>
        <hr>
        <div class="w-75 mx-auto mt-10">
            <form action="#" method="post">
                @csrf
                <fieldset class="mb-3 border border-dark p-4 d-flex flex-column">
                    <legend class="col-form-label pt-0 fs-1 fw-bold">User Update Role</legend>
                    @foreach ($all_user as $user)
                        <div class="card my-3 d-flex flex-row ">
                            <div class="p-3 align-content-center">
                                <p class="fs-5">{{ $user->id }}</p>
                            </div>
                            <div class="p-3 ms-5 align-content-center">
                                <p class="fs-5">{{ $user->name }}</p>
                            </div>
                            <div class="p-3 ms-5 align-content-center">
                                <p class="fs-5">{{ $user->email }}</p>
                            </div>
                            <div class="ms-auto p-3 align-content-center">
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle fs-5" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-lg-end">
                                        <li><button class="dropdown-item fs-5" type="button" value="edit">Edit</button></li>
                                        <li><button class="btn btn-danger dropdown-item fs-5" type="button" value="delete">Delete</button></li>
                                        <li><a href="#" class="dropdown-item fs-5">test edit</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>                
                    @endforeach
                </fieldset>
            </form>
        </div>
    </div>
</x-app-layout>

<?php
    $_SESSION['currentPage'] = null;
?>
