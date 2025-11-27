<?php
require 'db.php';

// Handle form submit (add expense)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title    = $_POST['title'] ?? '';
    $amount   = $_POST['amount'] ?? '';
    $category = $_POST['category'] ?? '';
    $spent_on = $_POST['spent_on'] ?? '';

    if ($title && $amount && $category && $spent_on) {
        $stmt = $conn->prepare(
            'INSERT INTO expenses (title, amount, category, spent_on) VALUES (?, ?, ?, ?)'
        );
        $stmt->bind_param('sdss', $title, $amount, $category, $spent_on);
        $stmt->execute();
        $stmt->close();
    }
    header('Location: index.php');
    exit;
}

// Handle delete
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];
    $stmt = $conn->prepare('DELETE FROM expenses WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $stmt->close();
    header('Location: index.php');
    exit;
}

// Fetch all expenses
$result = $conn->query('SELECT * FROM expenses ORDER BY spent_on DESC, created_at DESC');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Expense Tracker</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; }
        h1 { margin-bottom: 10px; }
        form { margin-bottom: 20px; }
        label { display: block; margin-top: 8px; }
        input, select { padding: 6px; width: 250px; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f5f5f5; }
        a.btn-delete { color: red; text-decoration: none; }
    </style>
</head>
<body>
    <h1>Expense Tracker</h1>

    <form method="post">
        <label>Title:
            <input type="text" name="title" required>
        </label>
        <label>Amount:
            <input type="number" step="0.01" name="amount" required>
        </label>
        <label>Category:
            <input type="text" name="category" required>
        </label>
        <label>Date:
            <input type="date" name="spent_on" required>
        </label>
        <br><br>
        <button type="submit">Add Expense</button>
    </form>

    <h2>All Expenses</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Amount</th>
            <th>Category</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['title']); ?></td>
                    <td><?php echo htmlspecialchars($row['amount']); ?></td>
                    <td><?php echo htmlspecialchars($row['category']); ?></td>
                    <td><?php echo htmlspecialchars($row['spent_on']); ?></td>
                    <td>
                        <a class="btn-delete" href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this expense?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="6">No expenses yet.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>
