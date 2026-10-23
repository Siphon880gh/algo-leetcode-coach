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
            'message' => "Read the problem statement above.\nPer node and edge count, keep?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every reachable sum below t', 'next' => 's2'],
                ['label' => 'Only the largest', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n = 4, edges [[0, 2, 7], [1, 2, 10], [2, 3, 3]], k = 2, t = 12 → −1 instead of 10.\nStep back to when you kept only the largest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Allowed sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to and including t', 'next' => 'wrong_b'],
                ['label' => 'Strictly below t', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 2 → 3 instead of 2.\nStep back to when you allowed t itself.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · E · t). Examples → 3, 2, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
