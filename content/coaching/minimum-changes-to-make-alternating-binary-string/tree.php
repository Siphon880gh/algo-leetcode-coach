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
            'message' => "Read the problem statement above.\nHow many patterns?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Two: starting with 0 or with 1', 'next' => 's2'],
                ['label' => 'One', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. '1010' is alternating too.\nStep back to when you used one pattern.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Second count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Count again', 'next' => 'wrong_b'],
                ['label' => 'n − a', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each position mismatches exactly one pattern.\nStep back to when you counted twice.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Greedy fix of adjacent equal pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, compare with patterns', 'next' => 'success'],
                ['label' => 'Yes, flip the second of each pair', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Left-to-right flipping can cost more than the better pattern.\nStep back to when you flipped greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 0, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
