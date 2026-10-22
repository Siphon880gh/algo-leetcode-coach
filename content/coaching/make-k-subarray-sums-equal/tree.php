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
            'message' => "Read the problem statement above.\nWhich indices must be equal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Same index mod gcd(n, k)', 'next' => 's2'],
                ['label' => 'Same index mod k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The circle wraps steps of k around; arr = [7,5,5,7], k = 3 → 0 instead of 4.\nStep back to when you used k alone.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Target value for a group?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its rounded mean', 'next' => 'wrong_b'],
                ['label' => 'Its median', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The median minimises total distance; arr = [3,4,7], k = 2 → 5 instead of 4.\nStep back to when you used the mean.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 1, 5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
