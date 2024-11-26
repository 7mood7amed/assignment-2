<?php
// API URL to fetch data
$url = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?"
     . "where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch data from the API
$json = file_get_contents($url);
$data = json_decode($json, true);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Nationality Statistics</title>
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.5.6/css/pico.min.css">
</head>
<body>
    <main class="container">
        <h1 style="text-align: center;">Student Nationality Statistics</h1>
        <table>
            <thead style="text-align: center;">
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($data && isset($data['results'])): ?>
                    <?php foreach ($data['results'] as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['year']); ?></td>
                        <td><?php echo htmlspecialchars($result['semester']); ?></td>
                        <td><?php echo htmlspecialchars($result['the_programs']); ?></td>
                        <td><?php echo htmlspecialchars($result['nationality']); ?></td>
                        <td><?php echo htmlspecialchars($result['number_of_students']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>