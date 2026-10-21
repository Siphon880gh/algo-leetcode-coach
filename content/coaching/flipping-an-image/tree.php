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
            'message' => "Read the problem statement above.\nReverse then invert, or invert then reverse?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Either: the two operations commute', 'next' => 's2'],
                ['label' => 'Reverse must come first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Inverting acts on each cell regardless of its position, so the order does not matter.\nStep back to when you insisted on an order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pointers i and j at both ends of a row, with row[i] != row[j]. What changes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Swap them', 'next' => 'wrong_b'],
                ['label' => 'Nothing: swapping then inverting gives back the same pair', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With a ≠ b, swapping gives (b, a) and inverting gives (1 − b, 1 − a) = (a, b).\nStep back to when you swapped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "The row has odd length. What about the middle cell?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Invert it', 'next' => 'success'],
                ['label' => 'Leave it alone', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Reversing keeps it in place, but it is still inverted.\nStep back to when you skipped the middle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²) in place. [[1,1,0],[1,0,1],[0,0,0]] → [[1,0,0],[0,1,0],[1,1,1]].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
