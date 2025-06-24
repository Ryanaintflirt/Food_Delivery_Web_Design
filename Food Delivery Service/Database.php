<?php
include 'Aheader.php';
?>
<div class="admin-content">
    <div class="container">
        <div class="admin-title" style="text-align:center; font-size: 28px; font-weight: bold; margin-top: 20px;">
            Database Overview
        </div>
    </div>
</div>
<?php
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "good_food";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("<div class='error-box'>Connection failed: " . $conn->error . "</div>");
}

echo "<div class='status-box'><h2>Database Connection Status</h2>Connected successfully to MySQL server</div>";

// Check if database exists
$result = $conn->query("SHOW DATABASES LIKE '$dbname'");
if ($result->num_rows > 0) {
    echo "<div class='status-box'><h2>Database Status</h2>Database '$dbname' exists</div>";
    
    $conn->select_db($dbname);
    
    $result = $conn->query("SHOW TABLES");
    if ($result->num_rows > 0) {
        echo "<div class='section-title'>Tables in Database</div>";
        while ($row = $result->fetch_array()) {
            $tableName = $row[0];
            echo "<div class='card'>";
            echo "<h3>Table: $tableName</h3>";
            
            // Structure
            echo "<h4>Table Structure:</h4>";
            $structure = $conn->query("DESCRIBE $tableName");
            echo "<table>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
            while ($field = $structure->fetch_assoc()) {
                echo "<tr>
                        <td>{$field['Field']}</td>
                        <td>{$field['Type']}</td>
                        <td>{$field['Null']}</td>
                        <td>{$field['Key']}</td>
                        <td>{$field['Default']}</td>
                        <td>{$field['Extra']}</td>
                      </tr>";
            }
            echo "</table>";

            // Data
            echo "<h4>Table Data:</h4>";
            $data = $conn->query("SELECT * FROM $tableName");
            if ($data->num_rows > 0) {
                echo "<table>";
                $columns = $data->fetch_fields();
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<th>" . htmlspecialchars($column->name) . "</th>";
                }
                echo "</tr>";
                $data->data_seek(0);
                while ($row = $data->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p class='no-data'>No data found in table.</p>";
            }
            echo "</div>";
        }
    } else {
        echo "<div class='warning-box'>No tables found in database.</div>";
    }
} else {
    echo "<div class='error-box'>Database '$dbname' does not exist.</div>";
}

// Add enhanced styling
echo "<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 20px;
        background-color: #f2f4f8;
    }
    .admin-title {
        color: #2c3e50;
    }
    .status-box, .warning-box, .error-box {
        background-color: #e8f0fe;
        border-left: 6px solid #4285f4;
        padding: 15px;
        margin: 15px 0;
        border-radius: 5px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .warning-box {
        border-left-color: #f39c12;
        background-color: #fff9e6;
    }
    .error-box {
        border-left-color: #e74c3c;
        background-color: #fdecea;
    }
    .section-title {
        font-size: 24px;
        margin-top: 30px;
        margin-bottom: 15px;
        color: #34495e;
        text-align: center;
    }
    .card {
        background-color: #ffffff;
        margin-bottom: 30px;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
    h2, h3, h4 {
        margin-bottom: 10px;
    }
    h3 {
        color: #2c3e50;
    }
    h4 {
        color: #7f8c8d;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 10px;
        margin-bottom: 20px;
        background-color: #fafafa;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #3498db;
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    tr:hover {
        background-color: #eaf2ff;
    }
    .no-data {
        color: #888;
        font-style: italic;
    }
</style>";

$conn->close();
include 'Afooter.php';
?>
