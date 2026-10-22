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
            'message' => "Read the problem statement above.\nCount greater elements with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fenwick trees over value ranks', 'next' => 's2'],
                ['label' => 'A scan of each array', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is quadratic: about 5 · 10^9 comparisons at n = 10^5.\nStep back to when you scanned the arrays.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal counts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always arr1', 'next' => 'wrong_b'],
                ['label' => 'Shorter array, then arr1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. [1, 1, 3, 4] → [1, 3, 4, 1] instead of [1, 3, 1, 4].\nStep back to when you always chose arr1.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → [2, 3, 1, 3], [5, 3, 1, 2, 14], [3, 3, 3, 3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
