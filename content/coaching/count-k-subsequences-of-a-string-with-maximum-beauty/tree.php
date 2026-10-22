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
            'message' => "Read the problem statement above.\nk exceeds the number of distinct letters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Return 0', 'next' => 's2'],
                ['label' => 'Read the k-th frequency anyway', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. There is no k-th frequency; in code s = aab, k = 3 raised an IndexError.\nStep back to when you skipped the check.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Each chosen letter contributes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Nothing; count letter sets', 'next' => 'wrong_b'],
                ['label' => 'Its frequency f(c) as a factor', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each letter can come from any of its positions; example 1 → 2 instead of 4.\nStep back to when you counted sets.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
