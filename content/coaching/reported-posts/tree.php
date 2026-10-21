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
            'message' => "Problem: An actions table logs what users do to posts (views, likes, reports, and more) by date, and rows may repeat; for reports, an extra column holds the reason. For each report reason, count the distinct posts reported on one specific day, which the statement fixes as \"yesterday\" relative to a given today. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nWhich rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Report actions on that day', 'next' => 's2'],
                ['label' => 'All actions on that day', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The extra column means something else for other actions.\nStep back to when you kept every action.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Group by what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The post', 'next' => 'wrong_b'],
                ['label' => 'The report reason', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The count is per reason.\nStep back to when you grouped by post.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'COUNT(DISTINCT post_id)', 'next' => 'success'],
                ['label' => 'COUNT(*)', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Several reports can name the same post.\nStep back to when you used COUNT(*).",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. One row per reason with its count of distinct reported posts.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
