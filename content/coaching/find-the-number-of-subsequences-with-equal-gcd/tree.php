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
            'message' => "Read the problem statement above.\nElement choices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'seq1, seq2, or neither', 'next' => 's2'],
                ['label' => 'seq1 or seq2', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Every element would be used: example 1 → 6 instead of 10.\nStep back to when you dropped neither.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Indices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'May overlap', 'next' => 'wrong_b'],
                ['label' => 'Disjoint', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → 225 instead of 50.\nStep back to when you allowed overlap.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · M² · log M). Examples → 10, 2, 50.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
