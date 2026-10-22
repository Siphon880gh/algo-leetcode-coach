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
            'message' => "Read the problem statement above.\nNew block when the next start a satisfies?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a > end', 'next' => 's2'],
                ['label' => 'a ≥ end', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Sharing one integer is an overlap; ranges = [[1,3],[3,5]] → 4 instead of 2.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Answer from b blocks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 · b', 'next' => 'wrong_b'],
                ['label' => '2^b', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each block chooses independently; ranges = [[1,1],[3,3],[5,5]] → 6 instead of 8.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
