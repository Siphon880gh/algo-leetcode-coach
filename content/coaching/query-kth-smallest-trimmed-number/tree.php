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
            'message' => "Read the problem statement above.\nTrim keeps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last trim digits', 'next' => 's2'],
                ['label' => 'The first trim digits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1’s first query → 0 instead of 2.\nStep back to when you kept the front.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare trimmed numbers how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Convert to 64-bit integers', 'next' => 'wrong_b'],
                ['label' => 'As equal-length strings', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Strings have up to 100 digits, far past 64 bits.\nStep back to when you converted to integers.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal trimmed values?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smaller index first', 'next' => 'success'],
                ['label' => 'Larger index first', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 2’s first query → 0 instead of 3.\nStep back to when you put the larger index first.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(q · n log n · len). Examples → [2,2,1,0], [3,0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
