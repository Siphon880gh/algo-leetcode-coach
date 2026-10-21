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
            'message' => "Read the problem statement above.\nCompare every pair?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: count canonical keys', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is O(n²) for 4·10⁴ dominoes.\nStep back to when you compared pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Key for [2,1]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(2, 1)', 'next' => 'wrong_b'],
                ['label' => '(1, 2)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A flipped domino must share the key.\nStep back to when you kept the order.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Add before or after incrementing the count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before', 'next' => 'success'],
                ['label' => 'After', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A domino would pair with itself.\nStep back to when you incremented first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [[1,2],[2,1],[3,4],[5,6]] → 1. [[1,2],[1,2],[1,1],[1,2],[2,2]] → 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
