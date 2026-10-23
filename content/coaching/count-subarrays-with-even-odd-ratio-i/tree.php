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
            'message' => "Read the problem statement above.\nCompare x / y ≤ a / b as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x · b ≤ y · a', 'next' => 's2'],
                ['label' => 'x · a ≤ y · b', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 3 instead of 7.\nStep back to when you crossed the wrong way.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "No odd elements?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid, the ratio is 0', 'next' => 'wrong_b'],
                ['label' => 'Not valid', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 6 instead of 0.\nStep back to when you counted y = 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). Examples → 7, 3, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
