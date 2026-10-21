<?php
declare(strict_types=1);

/**
 * Step-by-step tree contract:
 * - start: node id
 * - nodes[id]: message, outcome (continue|wrong|success), choices[{label, next}], optional rewind_to on wrong
 */
return [
    'start' => 'start',
    'nodes' => [
        'start' => [
            'message' => "Problem: Design a platform holding videos as strings of digits. upload(video) gives the video the smallest unused non-negative id (ids of removed videos become reusable) and returns it. remove(id) deletes a video if it exists. watch(id, start, end) adds one view and returns the substring from start to min(end, length − 1). like(id) and dislike(id) add a like or dislike. getLikesAndDislikes(id) returns [likes, dislikes] and getViews(id) returns the view count. Calls on a missing id return −1 (or the string -1 for watch, and [−1] for the pair), and like/dislike do nothing. (Restated from memory; limits and examples may differ slightly.)\nId for a new upload?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest freed id, else the next new one', 'next' => 's2'],
                ['label' => 'Always the next new id', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. After removing 0, upload 789 → 2 instead of 0 in the constructed calls.\nStep back to when you never reused ids.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Watch range?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'start up to end, exclusive', 'next' => 'wrong_b'],
                ['label' => 'start … min(end, length − 1), inclusive', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. watch(1, 0, 1) → 4 instead of 45.\nStep back to when you excluded end.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Watch a missing id?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return -1', 'next' => 'success'],
                ['label' => 'Return an empty string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. watch(3, 0, 1) must give -1.\nStep back to when you returned an empty string.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n) for upload and remove, O(1) otherwise. Constructed calls match.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
