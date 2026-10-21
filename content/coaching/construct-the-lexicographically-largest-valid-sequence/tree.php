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
            'message' => "Read the problem statement above.\nSequence length?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2n − 1', 'next' => 's2'],
                ['label' => '2n', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 1 appears once, every other number twice.\nStep back to when you used 2n.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Try order at each slot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest first', 'next' => 'wrong_b'],
                ['label' => 'Largest unused number first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Large-first makes the first complete fill the largest.\nStep back to when you went small first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Placing i ≥ 2 at slot p?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Needs p + i in range and empty', 'next' => 'success'],
                ['label' => 'Only slot p must be empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The second copy goes exactly i slots later.\nStep back to when you checked only p.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Backtracking (fast for n ≤ 20). Examples → [3,1,2,3,2], [5,3,1,4,3,5,2,4,2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
