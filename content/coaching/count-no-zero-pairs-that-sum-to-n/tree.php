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
            'message' => "Read the problem statement above.\nPairs counted?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ordered: (a, b) and (b, a) both count', 'next' => 's2'],
                ['label' => 'Unordered', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 3 → 4 instead of 8.\nStep back to when you merged them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the last digit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep any carry', 'next' => 'wrong_b'],
                ['label' => 'Keep only ways with carry 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 80 instead of 8.\nStep back to when you ignored the carry.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(L³ · 81). Examples → 1, 2, 8.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
