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
            'message' => "Read the problem statement above.\nCount down from n checking each number?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: fix the digits directly', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. n is up to 10⁹; the gap to the answer can be huge.\nStep back to when you counted down.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The first descent is at d[i] > d[i + 1], with equal digits before i. Decrement which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd[i] itself', 'next' => 'wrong_b'],
                ['label' => 'The leftmost of the equal run', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 332: decrementing the second 3 gives 32x, still a descent; the first 3 must drop.\nStep back to when you decremented d[i].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "After decrementing, the digits to the right become?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All 9s', 'next' => 'success'],
                ['label' => 'Unchanged', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. 9s make the number as large as possible while staying monotone.\nStep back to when you left them.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(digits). 10 → 9. 1234 → 1234. 332 → 299.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
