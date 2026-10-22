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
            'message' => "Read the problem statement above.\nMake a window equal to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its median', 'next' => 's2'],
                ['label' => 'Its largest value', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. You may move values both ways; example 1 → 2 instead of 3.\nStep back to when you raised everything to the max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Shrink while?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cost ≥ k', 'next' => 'wrong_b'],
                ['label' => 'cost > k', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Cost k is affordable; example 2 with k = 0 → 0 instead of 3.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 3, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
