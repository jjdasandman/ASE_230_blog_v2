<?php
$posts = json_decode(file_get_contents('posts.json'), true);
$file = fopen('visitors.csv', 'w');
foreach ($posts as $index => $post) {
    fputcsv($file, [$index, 0]); // Assuming index corresponds to post_id
}
fclose($file);
?>
