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
            'message' => "Problem: A submissions table holds posts (no parent) and comments (pointing to a post). Rows may repeat. Report every post with its number of distinct comments, 0 if none, ordered by post id. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nStart from which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct posts (no parent)', 'next' => 's2'],
                ['label' => 'Comments', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Posts without comments must still appear.\nStep back to when you started from comments.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Count with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(*)', 'next' => 'wrong_b'],
                ['label' => 'COUNT(DISTINCT comment id)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Duplicates and the NULL row would be counted.\nStep back to when you counted rows.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Comment pointing to a missing post?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'success'],
                ['label' => 'Show it as a post', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only real posts are reported.\nStep back to when you showed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). One row per post, ordered by id.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
