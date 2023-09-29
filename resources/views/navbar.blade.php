<nav class="navbar navbar-expand bg-body-tertiary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link" href="{{ url('profile') }}">Profile</a>
        <a class="nav-link" href="{{ url('authors') }}">Authors</a>
        <a class="nav-link" href="{{ url('add-book') }}">+ Add Book</a>
      </div>
    </div>
  </div>
  <button class="btn btn-sm btn-info float-end me-4 logout-button">Logout</button>
</nav>