<!DOCTYPE html>
<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <table id="datatable-buttons" class="table table-striped table-bordered">
                      <thead>
  
          
   </li>
      </ul>
      <form class="d-flex">
       </form>
    </div>
  </div>
</nav>  
<h1 class="h1">Selamat Datang <?php echo session()->get('username') ?></h1>
<iframe width="560" height="315" src="https://www.youtube.com/embed/wzhycEialTE" frameborder="0" allowfullscreen></iframe>
<div class="col-xl-3 col-md-6 mb-4">
  <div class="card h-100">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col mr-2">
          <div class="text-xs font-weight-bold text-uppercase mb-1">Number of Petugas</div> 
          <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $teacherCount; ?></div>
          <div class="mt-2 mb-0 text-muted text-xs">
            <!-- Add any additional information you want to display here -->
          </div>
        </div>
        <!-- Rest of your existing code -->
      </div>
    </div>
  </div>
</div>

</html>