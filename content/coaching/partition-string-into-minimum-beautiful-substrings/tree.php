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
            'message' => "Read the problem statement above.\nA piece is allowed when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It is exactly one of the listed binary strings', 'next' => 's2'],
                ['label' => 'Its value is a power of 5', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. That lets leading zeros in; 0101 → 1 instead of −1.\nStep back to when you compared values.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Choose pieces by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Taking the longest piece that fits', 'next' => 'wrong_b'],
                ['label' => 'dp over every listed piece ending at i', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Greedy can strand the rest; 110011100011 → −1 instead of 3.\nStep back to when you went greedy.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · 7). Examples → 2, 3, −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
