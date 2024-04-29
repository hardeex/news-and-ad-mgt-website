
<?php
// app/Helpers.php to cal the minutes to read eeach news article


if (!function_exists('calculateReadTime')) {
    function calculateReadTime($content) {
        // Calculate read time based on content length or complexity
        // For simplicity, let's assume 200 words per minute
        $wordCount = str_word_count(strip_tags($content));
        return ceil($wordCount / 200);
    }
}
