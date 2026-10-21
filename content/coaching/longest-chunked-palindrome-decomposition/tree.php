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
            'message' => "Read the problem statement above.\nLook for the longest matching ends?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: the shortest', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A longer match could have been split into more chunks.\nStep back to when you chose the longest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Ends match with length L. Count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1', 'next' => 'wrong_b'],
                ['label' => '2, then continue on the middle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A prefix chunk and a suffix chunk are two chunks.\nStep back to when you counted 1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "No match in the remaining middle. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count it as 1 chunk and stop', 'next' => 'success'],
                ['label' => 'Return the count without it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The middle is still a chunk.\nStep back to when you dropped the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) directly. \"ghiabcdefhelloadamhelloabcdefghi\" → 7. \"merchant\" → 1. \"antaprezatepzapreanta\" → 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
