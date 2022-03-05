<?php include("components/header.php"); ?>

<body class="sb-nav-fixed">

<?php include("components/topnav.php") ?>

<div id="layoutSidenav">

    <?php include("components/sidenav.php") ?>

    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid">
                <h1 class="mt-4">Dolgozók adatai</h1>
                <!--<ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>-->
                <!--<div class="card mb-4">
                    <div class="card-body">
                        DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                        <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                        .
                    </div>
                </div>-->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table mr-1"></i>
                        Dolgozók adatai
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example" width="100%" cellspacing="0">
                                <thead>
                                <tr>

                                    <th>Azonosító</th>
                                    <th>Születés</th>
                                    <th>Keresztnév</th>
                                    <th>Vezetéknév</th>
                                    <th>Neme</th>
                                    <th>Felvétel</th>
                                    <th>Aktuális osztály</th>
                                    <th>Aktuális fizetés</th>
                                    <th>Aktuális beosztás</th>
                                    <th>Műveletek</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Azonosító</th>
                                    <th>Születés</th>
                                    <th>Keresztnév</th>
                                    <th>Vezetéknév</th>
                                    <th>Neme</th>
                                    <th>Felvétel</th>
                                    <th>Aktuális osztály</th>
                                    <th>Aktuális fizetés</th>
                                    <th>Aktuális beosztás</th>
                                    <th>Műveletek</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include("components/footer_html.php") ?>

    </div>
</div>

<?php include("components/footer.php") ?>

</body>
</html>
