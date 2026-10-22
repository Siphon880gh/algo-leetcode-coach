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
            'message' => "Read the problem statement above.\nCombine with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR', 'next' => 's2'],
                ['label' => 'Sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [1, 1] with k = 2 → 2 instead of −1.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "k = 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Answer 0', 'next' => 'wrong_b'],
                ['label' => 'Answer 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The subarray must be non-empty: example 3 → 0 instead of 1.\nStep back to when you returned 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 1, 3, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
