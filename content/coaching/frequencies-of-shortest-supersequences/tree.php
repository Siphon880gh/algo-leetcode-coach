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
            'message' => "Read the problem statement above.\nDouble which letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any subset whose single letters are acyclic', 'next' => 's2'],
                ['label' => 'Only letters from words like aa', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → a single array, but ab does not contain ba.\nStep back to when you ignored cycles.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keep which subsets?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every valid subset', 'next' => 'wrong_b'],
                ['label' => 'The smallest valid size only', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 arrays instead of 2.\nStep back to when you kept them all.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^16 · (16 + words)). Examples → 2 arrays, 1, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
