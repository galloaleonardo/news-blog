@if($errors->any())
    <div class="card bg-danger text-white shadow pt-3 mb-3">
        <div class="card-body ">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

