<?php
include '../config.php';

session_start();

$search_query = "";

// Check if there's a search term
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['search'])) {
    $search_query = htmlspecialchars($_GET['search']);

    // Prepare the SQL statement with the search term
    $sql = $connection->prepare("SELECT * FROM user_profile_registration WHERE FIRSTNAME LIKE ? OR LASTNAME LIKE ? OR EMAIL LIKE ? OR NATIONALITY LIKE ? OR COUNTRY LIKE ?");
    $like_query = "%" . $search_query . "%";
    $sql->bind_param("sssss", $like_query, $like_query, $like_query, $like_query, $like_query);
} else {
    // Prepare SQL to fetch all users if no search term is provided
    $sql = $connection->prepare("SELECT * FROM user_profile_registration");
}

$sql->execute();
$result = $sql->get_result();
$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CAMBa Admin</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f8fc;
        }

        .sidebar {
            height: 100vh;
            background-color: #0055ff;
            color: #fff;
            padding: 20px;
        }

        .sidebar .nav-link {
            color: #fff;
            font-weight: bold;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: #003fbd;
        }

        .status-badge {
            padding: 0.5rem;
            font-size: 0.8rem;
            border-radius: 5px;
        }

        .status-dispatch {
            background-color: #28a745;
            color: #fff;
        }

        .status-pending {
            background-color: #ffc107;
            color: #fff;
        }

        .status-completed {
            background-color: #007bff;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block sidebar">
                <div class="d-flex flex-column">
                    <h1 class="mb-4">CAMBa</h1>

                    <a href="adminPage.php" class="nav-link">Users</a>
                    <a href="products.html" class="nav-link">Artworks</a>
                    <a href="#" class="nav-link">Subscription</a>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Users</h2>
                    <form class="mb-3" method="GET" action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search users..."
                                value="<?php echo htmlspecialchars($search_query); ?>">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                </div>

                <!-- Order Table -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Nationality</th>
                                <th scope="col">Country</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody id="orderTable">
                            <?php
                            echo "<tr>";
                            $number = 1;
                            
                            foreach ($users as $user) {
                               
                                echo "<td>" . $number . "</td>";
                                echo "<td>" . $user['FIRSTNAME'] . " " . $user['LASTNAME'] . "</td>";
                                echo "<td>" . $user['EMAIL'] . "</td>";
                                echo "<td>" . $user['COUNTRY'] . "</td>";
                                echo "<td>" . $user['NATIONALITY'] . "</td>";
                                echo "<td>" . $user['USER_TYPE'] . "</td>";
                                echo "<td><button class='btn btn-danger btn-sm delete-btn'>Delete</button></td>";
                                echo "</tr>";
                                $number++; 
                            }
                            ?>

                        </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Event listener to delete a row
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', event => {
                const row = event.target.closest('tr');
                row.remove();
            });
        });
    </script>
</body>

</html>