<div class="d-flex justify-content-center mb-3">
    <a href="{{ route("login.provider", ["provider" => "github"]) }}" type="button" class="btn btn-light mr-3">
        <logo-github w="28" h="28" class="align-middle"></logo-github>
    </a>
    <a href="{{ route("login.provider", ["provider" => "google"]) }}" type="button" class="btn btn-light">
        <logo-google w="28" h="28" class="align-middle"></logo-google>
    </a>
</div>
