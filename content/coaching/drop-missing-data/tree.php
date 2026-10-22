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
            'message' => "Read the problem statement above.\nCall?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'dropna(subset=[name])', 'next' => 's2'],
                ['label' => 'dropna()', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That also drops rows missing other columns; a row with a name but no age disappears.\nStep back to when you dropped on every column.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Detect missing with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'name == the string None', 'next' => 'wrong_b'],
                ['label' => 'pandas missing values (dropna / isna)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Missing names are not the text None; that test matched 0 rows.\nStep back to when you compared strings.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). The example keeps 32, 779, 849.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
