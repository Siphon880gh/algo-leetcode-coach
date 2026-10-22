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
            'message' => "Read the problem statement above.\nWhich letter does a star remove?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The smallest one to its left', 'next' => 's2'],
                ['label' => 'The nearest one to its left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. ab* → a instead of b.\nStep back to when you took the nearest.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Among equal smallest letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The leftmost', 'next' => 'wrong_b'],
                ['label' => 'The rightmost', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → aba instead of aab.\nStep back to when you took the leftmost.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 n). Examples → aab, abc.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
