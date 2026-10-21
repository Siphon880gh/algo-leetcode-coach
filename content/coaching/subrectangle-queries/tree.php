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
            'message' => "Read the problem statement above.\nLog scan order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Newest first', 'next' => 's2'],
                ['label' => 'Oldest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The latest covering update wins.\nStep back to when you scanned oldest first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No covering update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 'wrong_b'],
                ['label' => 'Original value', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The original grid still stands.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Cell outside the update rectangle?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Unchanged', 'next' => 'success'],
                ['label' => 'Takes the new value', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only cells from (row1, col1) to (row2, col2) change.\nStep back to when you updated it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example 1 → [null,1,null,5,5,null,10,5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
