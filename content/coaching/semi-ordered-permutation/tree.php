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
            'message' => "Read the problem statement above.\nCount swaps how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'From the positions of 1 and n', 'next' => 's2'],
                ['label' => 'Count inversions of the whole array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The middle may stay unsorted; example 3 → 2 instead of 0.\nStep back to when you sorted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "1 starts to the right of n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just add both counts', 'next' => 'wrong_b'],
                ['label' => 'Subtract 1 for the shared swap', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. One swap moves both; example 2 → 4 instead of 3.\nStep back to when you added both counts.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
