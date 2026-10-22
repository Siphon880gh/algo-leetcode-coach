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
            'message' => "Read the problem statement above.\nMedian index?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌊n / 2⌋', 'next' => 's2'],
                ['label' => '⌊(n − 1) / 2⌋', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Even n takes the larger middle: example 3 → 1 instead of 0.\nStep back to when you took the lower middle.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Change?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The median element only', 'next' => 'wrong_b'],
                ['label' => 'Every element on the wrong side of k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1, but then the other 5 is the median; the answer is 2.\nStep back to when you changed one element.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 2, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
