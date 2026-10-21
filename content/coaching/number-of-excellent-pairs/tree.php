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
            'message' => "Read the problem statement above.\nApproach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bits(a OR b) + bits(a AND b) = bits(a) + bits(b)', 'next' => 's2'],
                ['label' => 'Check every pair', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With n = 10^5 that is 10^10 pairs.\nStep back to when you checked every pair.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Duplicates?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them', 'next' => 'wrong_b'],
                ['label' => 'Remove them first', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Pairs count distinct values; Example 1 → 7 instead of 5.\nStep back to when you kept duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Pairs to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ordered, including (x, x)', 'next' => 'success'],
                ['label' => 'Unordered, two different values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 2 instead of 5.\nStep back to when you counted unordered pairs.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n + 31²). Examples → 5, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
