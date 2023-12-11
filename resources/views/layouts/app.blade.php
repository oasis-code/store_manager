<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>NASECO Seeds</title>

  @include('layouts.head')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <?php include 'partials/navbar.php'; ?>
  <?php include 'fuel_sidebar.php'; ?>
   
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper mi-bg">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          <div class="col-sm-6">
              <a href="fuel_in.php" class="btn float-left bg-success"><i class="fa fa-plus"></i> Fuel In
              </a>
            </div>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">          
            <div class="col-sm-6">
            <div class="col-sm-6">
              <a href="fuel_out.php" class="btn float-right bg-success"><i class=""></i>  FuelOut
              </a>
            </div>
          </div><!-- /.col -->
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
   
   <center> <p id="currentTime"></p></center>

    <script>
        function updateDateTime() {
            // Get the current date and time
            var now = new Date();

            // Convert to East Africa Time (EAT) which is UTC+3
            var eatTimeZone = 'Africa/Nairobi';
            var formatter = new Intl.DateTimeFormat('en-US', {
                timeZone: eatTimeZone,
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: false
            });

            var formattedDateTime = formatter.format(now);

            // Update the HTML element with the formatted date and time
            document.getElementById('currentTime').textContent = formattedDateTime;
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);

        // Initial update
        updateDateTime();
    </script>

   <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <div class="row">
                        <!-- filter -->
                        <div class="col-sm-12">
                            <div class="card card-outline card-success">

                                <!-- /.card-header -->
                                <div class="card-body pb-1 pt-1">
                                <div class="card-header">
                                    <h4 class="card-title text-success"><b>Fuel Report today</b></h4>
                                    <div class="card-tools">
                                        <p class="text-right">Total: <span class="text-success">2000 </span><b>Litres</b></p>
                                    </div>
                                </div>
                                </div>
                                <!-- /.card-body -->
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0">
                                    <table id="example1" class="table table-bordered table-hover table-head-fixed table-sm">
                                        <thead>
                                            <tr class="text-nowrap">
                                              
                                                <th>  Date </th>
                                                
                                                <th>Qty In (Litres)</th>
                                                <th>Qty Out (Litres)</th>
                                                <th>Total (litres)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="text-nowrap">
                                                
                                                <td class="text-nowrap">2023-06-23</td>
                                                
                                                <td class="text-primary"><b>817,650</b></td>
                                                <td class="text-primary"><b>817,650</b></td>
                                                
                                                <td class="text-primary"><b>817,650</b></td>
                                            </tr>
                                            <tr>
                                                
                                                <td class="text-nowrap">2023-06-23</td>
                                                <td class="text-primary"><b>230,000	</b></td>
                                                <td class="text-primary"><b>230,000	</b></td>
                                                
                                                <td class="text-primary"><b>1,047,650</b></td>
                                            </tr>
                                            <tr>
                                               
                                                <td class="text-nowrap">2023-06-23</td>
                                                <td class="text-primary"><b>230,000	</b></td>
                                                <td class="text-primary"><b>310,000	</b></td>
                                               
                                                <td class="text-primary"><b>1,357,650</b></td>
                                            </tr>
                                            <tr>
                                               
                                                <td class="text-nowrap">2023-06-23</td>
                                                <td class="text-primary"><b>230,000	</b></td>
                                                <td class="text-primary"><b>402,500</b></td>
                                               
                                                <td class="text-primary"><b>1,760,150</b></td>
                                            </tr>
                                            <tr>
                                                
                                                <td class="text-nowrap">2023-06-23</td>
                                                <td class="text-primary"><b>230,000	</b></td>
                                                <td class="text-primary"><b>47,500</b></td>
                                               
                                                <td class="text-primary"><b>1,807,650</b></td>
                                            </tr>
                                            
                                        </tfoot>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                </div>
        </div><!-- /.main-row -->

      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'partials/footer.php'; ?>
</div>
<!-- ./wrapper -->
<?php include 'partials/foot.php'; ?>

