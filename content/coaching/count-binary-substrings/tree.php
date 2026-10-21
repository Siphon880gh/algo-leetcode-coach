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
            'message' => "Read the problem statement above.\nCheck every substring?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: every valid one sits on a border between two runs', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is at least O(n²).\nStep back to when you checked substrings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Runs of lengths a and b meet. How many valid substrings straddle the border?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a + b', 'next' => 'wrong_b'],
                ['label' => 'min(a, b)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each needs equal counts on both sides, so lengths 2 … 2 · min(a, b).\nStep back to when you added the lengths.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Do you need the whole list of runs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: prev and cur are enough', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Each border uses only the two runs beside it.\nStep back to when you stored every run.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. One pass with two counters: O(n) time, O(1) space. \"00110011\" → 6. \"10101\" → 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
