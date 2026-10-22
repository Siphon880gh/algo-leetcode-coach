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
            'message' => "Read the problem statement above.\nCheck endings at r in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Shortest first', 'next' => 's2'],
                ['label' => 'Longest first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The first hit must have the largest start; word = abaababa, forbidden = [a, ba] → 2 instead of 1.\nStep back to when you checked longest first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "On a hit starting at s, set l to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r + 1', 'next' => 'wrong_b'],
                ['label' => 's + 1', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That throws away valid letters; example 1 → 3 instead of 4.\nStep back to when you jumped past r.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 100). Examples → 4, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
