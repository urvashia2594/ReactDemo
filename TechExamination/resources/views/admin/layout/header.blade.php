<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">

        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{route('admin.dashboard')}}">Dashboard</a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript::void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            User Management
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.user.index')}}">User</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript::void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Subject Management
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.subject.index')}}">Subject</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript::void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Question Management
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.questions.index')}}">Question</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript::void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Answer Management
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.answer.index')}}">Answer</a></li>
          </ul>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="javascript::void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Exam Management
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.exam.index')}}">Exam</a></li>
          </ul>
        </li>

      </ul>
      <form class="d-flex" role="search" method="post" action="{{route('admin.logout')}}">
        @csrf
        <button class="btn btn-outline-success" type="submit">Logout</button>
      </form>
    </div>
  </div>
</nav>