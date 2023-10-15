<?php
use app\models\TomProject;

// Get all rows from the "tom_project" table and order them by "name"
$tomProjects = TomProject::find()->orderBy('name')->all();

// Execute your SQL query to get the project completion data
$projectCompletionData = Yii::$app->db->createCommand('
    SELECT
        p.id AS project_id,
        p.name AS project_name,
        COUNT(DISTINCT t.id) AS total_tasks,
        ((COALESCE(SUM(CASE WHEN r.percent_done = 100 THEN 1 ELSE 0 END), 0) * 100) / COUNT(DISTINCT t.id)) AS completed_percentage
    FROM tom_project p
    LEFT JOIN tom_task t ON p.id = t.project_id
    LEFT JOIN tom_report r ON t.id = r.task_id
    GROUP BY p.id, p.name
')->queryAll();

?>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tom Project</th>
                <th>Tom Reports</th>
                <th>Tom Tasks</th>
                <th>Project Completion</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $isFirstRow = true;
            foreach ($tomProjects as $project) {
                echo '<tr>';

                // Display Tom Project
                echo '<td>';
                echo $project->name;
                echo '</td>';

                // Find Tom Reports for this project
                $tomReports = Yii::$app->db->createCommand('
                    SELECT r.name
                    FROM tom_report r
                    INNER JOIN tom_task t ON r.task_id = t.id
                    WHERE t.project_id = :projectId
                    ORDER BY r.name
                ', [':projectId' => $project->id])->queryAll();

                // Display Tom Reports for this project
                echo '<td>';
                foreach ($tomReports as $report) {
                    echo $report['name'] . '<br>';
                }
                echo '</td>';

                // Find Tom Tasks for this project
                $tomTasks = Yii::$app->db->createCommand('
                    SELECT name
                    FROM tom_task
                    WHERE project_id = :projectId
                    ORDER BY name
                ', [':projectId' => $project->id])->queryAll();

                // Display Tom Tasks for this project
                echo '<td>';
                foreach ($tomTasks as $task) {
                    echo $task['name'] . '<br>';
                }
                echo '</td>';

                // Find the project completion percentage from the previous query
                $completedPercentage = null;
                foreach ($projectCompletionData as $data) {
                    if ($data['project_id'] == $project->id) {
                        $completedPercentage = $data['completed_percentage'];
                        break;
                    }
                }

                echo '<td class="text-center align-middle">';
if ($completedPercentage !== null) {
    $progressBarHtml = '<div class="progress">';
    $progressBarHtml .= '<div class="progress-bar" role="progressbar" style="width: ' . $completedPercentage . '%" aria-valuenow="' . $completedPercentage . '" aria-valuemin="0" aria-valuemax="100">' . number_format($completedPercentage, 2) . '%</div>';
    $progressBarHtml .= '</div>';
    echo $progressBarHtml;
}
echo '</td>';

                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</div>


