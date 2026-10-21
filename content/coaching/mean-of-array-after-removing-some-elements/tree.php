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
            'message' => "Read the problem statement above.\nHow many to drop each side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n / 20', 'next' => 's2'],
                ['label' => 'n / 10', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 5% from each end is n / 20.\nStep back to when you used n / 10.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Drop by value or by position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove all copies of min and max', 'next' => 'wrong_b'],
                ['label' => 'By position after sorting', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Duplicates of the extremes may stay.\nStep back to when you removed values.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Divisor?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n − 2 · (n / 20)', 'next' => 'success'],
                ['label' => 'n', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the kept elements count.\nStep back to when you divided by n.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2.00000, 4.00000, 4.77778.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
