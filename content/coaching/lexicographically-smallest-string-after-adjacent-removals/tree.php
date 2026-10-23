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
            'message' => "Read the problem statement above.\nRemove pairs how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Interval DP over every order', 'next' => 's2'],
                ['label' => 'Greedily with a stack', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → c instead of a.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "At position i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always skip a vanishing block when there is one', 'next' => 'wrong_b'],
                ['label' => 'The smaller of keeping s[i] and skipping a vanishing block', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → ze instead of zdce.\nStep back to when you always removed.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n³). Examples → a, \"\", zdce.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
