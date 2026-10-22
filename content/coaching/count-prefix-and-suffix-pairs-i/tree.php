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
            'message' => "Read the problem statement above.\nPairs to test?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only i < j', 'next' => 's2'],
                ['label' => 'Both orders', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 1 instead of 0.\nStep back to when you tested both orders.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Condition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Prefix only', 'next' => 'wrong_b'],
                ['label' => 'Prefix and suffix', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. ['a', 'ab'] → 1 instead of 0.\nStep back to when you checked only the prefix.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n² L). Examples → 4, 2, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
