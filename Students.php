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

    <!-- usage of PICO CSS -->
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.5.6/css/pico.min.css">

    <style>
        /* Center the main title */
        h1 {
            text-align: center;
        }

        /* Make table headers bold */
        th {
            font-weight: bold;
        }

        /* Prevent text from wrapping to a new line in table cells */
        td, th {
            white-space: nowrap;
        }

        /* Alternate row color for even rows */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <main class="container">
        <h1 style="text-align: center;">Student Nationality Statistics</h1>
        
        <!-- beginning of table -->
        <table>
            <!-- table header fields -->
            <thead style="text-align: center;">
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>Colleges</th>
                    <th>Number of Students</th>
                </tr>
            </thead>

            <!-- table values -->
            <tbody>

                <!-- ensuring data and values of table are not null -->
                <?php if ($data && isset($data['results'])): ?>

                    <!-- foreach loop to loop through table values and print them if exist -->
                    <?php foreach ($data['results'] as $result): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($result['year'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($result['semester'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($result['the_programs'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($result['nationality'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($result['colleges'] ?? 'N/A'); ?></td>
                        <td><?php echo htmlspecialchars($result['number_of_students'] ?? 'N/A'); ?></td>
                    </tr>
                    <?php endforeach; ?> <!-- end of foreach loop -->
                <?php else: ?> <!-- condition in case data is not found -->
                    <tr>
                        <!-- message to be printed in case data is not found -->
                        <td colspan="6">No data found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>