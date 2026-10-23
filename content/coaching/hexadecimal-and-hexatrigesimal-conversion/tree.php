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
            'message' => "Read the problem statement above.\nWhich power in which base?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'n² in 16, n³ in 36', 'next' => 's2'],
                ['label' => 'n² in 36, n³ in 16', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 4P895 instead of A91P1.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Digits above 9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Lowercase letters', 'next' => 'wrong_b'],
                ['label' => 'Uppercase letters', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → a91p1 instead of A91P1.\nStep back to when you used lowercase.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log n). Examples → A91P1, 5101000.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
