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
            'message' => "Read the problem statement above.\nWhat does a round add to the score?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest of the removed numbers', 'next' => 's2'],
                ['label' => 'Every removed number', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Only the largest counts; example 1 → 42 instead of 15.\nStep back to when you added every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After sorting each row, round j scores?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Column j of the first row', 'next' => 'wrong_b'],
                ['label' => 'The maximum of column j', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Another row can hold the larger value; example 1 → 10 instead of 15.\nStep back to when you read one row.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n log n). Examples → 15, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
