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
            'message' => "Read the problem statement above.\nUse the original order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, sort first', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Close values may be far apart in the input; [9,4,1,7], k = 2 needs 9 and 7.\nStep back to when you kept the input order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which k scores after sorting?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The k largest', 'next' => 'wrong_b'],
                ['label' => 'The consecutive window with the smallest spread', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. For [1,2,10,20], k = 2 the largest pair spreads 10 but 1 and 2 spread 1.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 0', 'next' => 'success'],
                ['label' => 'Answer is the maximum score', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. One score has highest = lowest.\nStep back to when you returned the maximum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
