<?php
// Database credentials
$servername = "127.0.0.1";
$username = "root";
$password = "root";
$dbname = "good_food";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->error);
}

echo "<h2>Database Connection Status</h2>";
echo "Connected successfully to MySQL server<br>";

// Check if database exists
$result = $conn->query("SHOW DATABASES LIKE '$dbname'");
if ($result->num_rows > 0) {
    echo "<br><h2>Database Status</h2>";
    echo "Database '$dbname' exists<br>";
    
    // Select the database
    $conn->select_db($dbname);
    
    // Get all tables
    $result = $conn->query("SHOW TABLES");
    if ($result->num_rows > 0) {
        echo "<br><h2>Tables in Database</h2>";
        while ($row = $result->fetch_array()) {
            $tableName = $row[0];
            echo "<h3>Table: $tableName</h3>";
            
            // Get table structure
            echo "<h4>Table Structure:</h4>";
            $structure = $conn->query("DESCRIBE $tableName");
            echo "<table border='1' cellpadding='5'>";
            echo "<tr><th>Field</th><th>Type</th><th>Null</th><th>Key</th><th>Default</th><th>Extra</th></tr>";
            while ($field = $structure->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $field['Field'] . "</td>";
                echo "<td>" . $field['Type'] . "</td>";
                echo "<td>" . $field['Null'] . "</td>";
                echo "<td>" . $field['Key'] . "</td>";
                echo "<td>" . $field['Default'] . "</td>";
                echo "<td>" . $field['Extra'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            
            // Get table data
            echo "<h4>Table Data:</h4>";
            $data = $conn->query("SELECT * FROM $tableName");
            if ($data->num_rows > 0) {
                echo "<table border='1' cellpadding='5'>";
                // Get column names
                $columns = $data->fetch_fields();
                echo "<tr>";
                foreach ($columns as $column) {
                    echo "<th>" . $column->name . "</th>";
                }
                echo "</tr>";
                
                // Reset data pointer
                $data->data_seek(0);
                
                // Get rows
                while ($row = $data->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>" . htmlspecialchars($value) . "</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No data found in table<br>";
            }
            echo "<hr>";
        }
    } else {
        echo "No tables found in database<br>";
    }
} else {
    echo "<br>Database '$dbname' does not exist<br>";
}

// Add some styling
echo "<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
        background-color: #f5f5f5;
    }
    h2 {
        color: #333;
        background-color: #fff;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    h3 {
        color: #444;
        margin-top: 20px;
    }
    h4 {
        color: #666;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        margin: 10px 0;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    th {
        background-color: #4CAF50;
        color: white;
        text-align: left;
        padding: 12px;
    }
    td {
        padding: 8px;
        border: 1px solid #ddd;
    }
    tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    tr:hover {
        background-color: #f5f5f5;
    }
    hr {
        border: none;
        border-top: 2px solid #ddd;
        margin: 20px 0;
    }
</style>";

$conn->close();
?> 