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
            'message' => "Read the problem statement above.\nStrategy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'DP over reachable sums', 'next' => 's2'],
                ['label' => 'Greedily take each value that fits', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 7 instead of 11.\nStep back to when you chose greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sum x can add v when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x ≤ v', 'next' => 'wrong_b'],
                ['label' => 'x < v', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The value must be greater: example 1 → 6 instead of 4.\nStep back to when you used ≤.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · M). Examples → 4, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
