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
            'message' => "Read the problem statement above.\nTake elements from?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The end', 'next' => 's2'],
                ['label' => 'The front', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The operation removes the last element; example 1 → 5 instead of 4.\nStep back to when you scanned from the front.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Which values count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every distinct value', 'next' => 'wrong_b'],
                ['label' => 'Only 1 … k, once each', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Larger values do not help; example 1 → 2 instead of 4.\nStep back to when you counted everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 5, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
