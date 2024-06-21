<?php
// This will contain all the helpers function we are going to use all through the project
/**
 * Get the base path
 * 
 * @param string $path
 * @return  string
 */
function basePath($path = '')
{
    // __DIR__ iS used to get the absolute path 
    return __DIR__ . '/' . $path;
}

/**
 * 
 * Load a view
 * 
 * @param string $name
 * @param array $data
 * @return  void
 * 
 */
function loadView($name, $data = [])
{
    $viewPath = basePath("App/views/{$name}.view.php");
    if (file_exists($viewPath)) {
        extract($data); // this will import variables into the current symbol form the table 
        require $viewPath;
    } else {
        echo "View '{$name} not found!'";
    }
}
/**
 * 
 * Load a partial
 * 
 * @param string $name
 * @return  void
 * 
 */
function loadPartial($name,  $data = [])
{
    $partialPath =  basePath("App/views/partials/{$name}.php");
    if (file_exists($partialPath)) {
        extract($data); // this will import variables into the current symbol form the table 

        require $partialPath;
    } else {
        echo "View '{$name} not found!'";
    }
}

/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return  void
 */

function inspect($value)
{
    echo '<pre>';
    var_dump($value);
    echo '</pre>';
}
/**
 * Inspect a value(s)
 * 
 * @param mixed $value
 * @return  void
 */

function inspectAndDie($value)
{
    echo '<pre>';
    die(var_dump($value));
    echo '</pre>';
}


/**
 * Redirect to a given url
 * @param string $url
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}

/**
 * Undocumented function
 *
 * @param array $submissions
 * @param array $assignments
 * @return array
 */
// Function to get grades for each assignment
function getGradesForAssignments(array $submissions, array $assignments)
{
    $results = [];
    foreach ($assignments as $assignment) {
        // Initialize grade 
        $grade = '';

        foreach ($submissions as $submission) {

            if ($submission->assignment_id === $assignment->id && $submission->user_id === $_SESSION['user']['id']) {
                $grade = $submission->grade;  // Get the actual grade if found
                break;
            }
        }
        $results[] = [
            'course' => $assignment->course,
            'title' => $assignment->title,
            'question' => $assignment->question,
            'mark_obtainable' => $assignment->mark_obtainable,
            'due_date' => $assignment->due_date,
            'grade' => $grade,
            'id' => $assignment->id
        ];
    }
    return $results;
}

function getGradeStatus($grade)
{
    if ($grade === null) {
        return 'Not graded';
    } elseif ($grade === '') {
        return 'Not submitted';
    } else {
        return 'Graded: ' . $grade;
    }
}
// check if date is the past

function checkDateStatus($inputDate)
{
    $now = new DateTime();
    $now->setTime(0, 0, 0); // set time to 00:00:00
    if ($inputDate > $now) {
        return "future";
    } elseif ($inputDate < $now) {
        return "past";
    } else {
        return "present";
    }
}
