<?php
function loadFooterText($filename) {
    if (!file_exists($filename)) {
        return "Text file file not found.";
    }
    return file_get_contents($filename);
}

function loadPostsFromJSON($filename) {
    $json_data = file_get_contents($filename);
    return json_decode($json_data, true);
}

function getPost($posts, $post_id) {
    return isset($posts[$post_id]) ? $posts[$post_id] : null;
}

function getVisitorCount($filename, $post_id) {
    if (!file_exists($filename)) {
        return 0; // Return 0 if the file doesn't exist
    }

    $rows = array_map('str_getcsv', file($filename));
    
    foreach ($rows as $row) {
        if ($row[0] === (string)$post_id) {
            return (int)$row[1]; // Return the visitor count for the post_id
        }
    }
    
    return 0; // Return 0 if post_id not found
}

function updateVisitorCount($filename, $post_id) {
    $rows = [];
    if (file_exists($filename)) {
        $rows = array_map('str_getcsv', file($filename));
    }
    $found = false;
	
    // Check if the post_id exists and update the count
    foreach ($rows as &$row) {
        if ($row[0] === (string)$post_id) {
            $row[1] = (int)$row[1] + 1; 
            $found = true; 
            break; 
        }
    }

    // If post_id not found, add it to the array
    if (!$found) {
        $rows[] = [(string)$post_id, 1]; // Add new post_id with initial count of 1
    } 
	
    // Write back to the CSV file
    $file = fopen($filename, 'w');
    
	foreach ($rows as &$row) {
        fputcsv($file, $row);
    }

    fclose($file);
}
?>
