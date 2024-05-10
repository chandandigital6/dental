<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
    <a href="index.html" class="navbar-brand p-0">
        <h1 class="m-0 text-primary"><i class="fa fa-tooth me-2"></i>DentCare</h1>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0">
            <a href="{{route('home')}}" class="nav-item nav-link active">Home</a>
            <a href="{{route('about')}}" class="nav-item nav-link">About</a>
            <a href="{{route('services')}}" class="nav-item nav-link">Service</a>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu m-0">
                    <a href="{{route('price')}}" class="dropdown-item">Pricing Plan</a>
                    <a href="{{route('team')}}" class="dropdown-item">Our Dentist</a>
                    <a href="{{route('testimonial')}}" class="dropdown-item">Testimonial</a>
                    <a href="{{route('appointment')}}" class="dropdown-item">Appointment</a>
                </div>
            </div>
            <a href="{{route('contact')}}" class="nav-item nav-link">Contact</a>
        </div>
        <button type="button" class="btn text-dark" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fa fa-search"></i></button>
        <a href="{{route('appointment')}}" class="btn btn-primary py-2 px-4 ms-3">Appointment</a>
    </div>
</nav>
