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
            'message' => "Read the problem statement above.\nLength rule?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pair prefixes with equal index mod k', 'next' => 's2'],
                ['label' => 'Plain Kadane', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → −1 instead of −10.\nStep back to when you ignored the length.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Update minPre[j mod k]?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Before using it', 'next' => 'wrong_b'],
                ['label' => 'After using it', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That allows an empty subarray: example 2 → 0 instead of −10.\nStep back to when you updated first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + k). Examples → 3, −10, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
