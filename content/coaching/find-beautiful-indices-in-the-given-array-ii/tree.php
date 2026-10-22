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
            'message' => "Read the problem statement above.\nFind matches with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'KMP or Z', 'next' => 's2'],
                ['label' => 'Checking every start directly', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That is up to about 6.25 · 10^10 comparisons.\nStep back to when you checked each start.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pair a-starts with b-starts?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every pair', 'next' => 'wrong_b'],
                ['label' => 'Two pointers or binary search', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. s, a and b all of one letter give about 2.5 · 10^11 pairs.\nStep back to when you tried all pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [16, 33], [0].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
