<?php
include "Aheader.php";
include "dbConnect.php";

// Handle status updates
if (isset($_POST['update_status'])) {
    $contact_id = $_POST['contact_id'];
    $new_status = $_POST['status'];
    
    $stmt = $conn->prepare("UPDATE contacts SET status = ? WHERE id = ?");
    $stmt->bind_param("si", $new_status, $contact_id);
    $stmt->execute();
    $stmt->close();
}

// Get all contacts
$query = "SELECT * FROM contacts ORDER BY created_at DESC";
$result = $conn->query($query);
?>

<style>
    .contact-management {
        padding: 20px;
    }
    .contact-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background: white;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .contact-table th,
    .contact-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    .contact-table th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .contact-table tr:hover {
        background-color: #f5f5f5;
    }
    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 12px;
        font-weight: 500;
    }
    .status-new {
        background-color: #e3f2fd;
        color: #1976d2;
    }
    .status-read {
        background-color: #e8f5e9;
        color: #2e7d32;
    }
    .status-replied {
        background-color: #fff3e0;
        color: #f57c00;
    }
    .action-form {
        display: inline;
    }
    .status-select {
        padding: 5px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .update-btn {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    .update-btn:hover {
        background-color: #45a049;
    }
    .message-content {
        max-width: 300px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .view-message {
        color: #2196F3;
        text-decoration: none;
    }
    .view-message:hover {
        text-decoration: underline;
    }
</style>

<div class="admin-content">
    <div class="container">
        <div class="admin-title" style="text-align:center;">
            Contact Messages
        </div>
    </div>
</div>

<div class="contact-management">
    <table class="contact-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Subject</th>
                <th>Message</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo htmlspecialchars($row['full_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                    <td><?php echo htmlspecialchars($row['phone']); ?></td>
                    <td><?php echo htmlspecialchars($row['subject']); ?></td>
                    <td class="message-content">
                        <?php echo htmlspecialchars($row['message']); ?>
                        <a href="#" class="view-message" onclick="showMessage(<?php echo $row['id']; ?>)">View</a>
                    </td>
                    <td>
                        <span class="status-badge status-<?php echo $row['status']; ?>">
                            <?php echo ucfirst($row['status']); ?>
                        </span>
                    </td>
                    <td><?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?></td>
                    <td>
                        <form class="action-form" method="POST">
                            <input type="hidden" name="contact_id" value="<?php echo $row['id']; ?>">
                            <select name="status" class="status-select">
                                <option value="new" <?php echo $row['status'] == 'new' ? 'selected' : ''; ?>>New</option>
                                <option value="read" <?php echo $row['status'] == 'read' ? 'selected' : ''; ?>>Read</option>
                                <option value="replied" <?php echo $row['status'] == 'replied' ? 'selected' : ''; ?>>Replied</option>
                            </select>
                            <button type="submit" name="update_status" class="update-btn">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function showMessage(id) {
    // You can implement a modal or expand the message content here
    alert('Message ID: ' + id);
}
</script>

<?php
$conn->close();
include "Afooter.php";
?>