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
            'message' => "Read the problem statement above.\nSmallest sum of a side?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'sum + number of zeros', 'next' => 's2'],
                ['label' => 'sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. A zero must become at least 1; example 1 → 11 instead of 12.\nStep back to when you used the plain sum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Smaller side has no zeros?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return the larger sum', 'next' => 'wrong_b'],
                ['label' => 'Return −1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It cannot grow; example 2 → 6 instead of −1.\nStep back to when you returned the larger sum.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + m). Examples → 12, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
