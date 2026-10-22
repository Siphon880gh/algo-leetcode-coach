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
            'message' => "Read the problem statement above.\nPair which?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'a[i] with a[n − 1 − i]', 'next' => 's2'],
                ['label' => 'Neighbours after sorting', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 2.0 instead of 5.5.\nStep back to when you paired neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The largest average', 'next' => 'wrong_b'],
                ['label' => 'The smallest average', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 8.0 instead of 5.5.\nStep back to when you took the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 5.5, 5.5, 5.0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
