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
            'message' => "Read the problem statement above.\nValid picks?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly 010 and 101', 'next' => 's2'],
                ['label' => 'Any three not all the same type', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 001 has two neighbouring offices; Example 1 → 18 instead of 6.\nStep back to when you allowed those.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every triple', 'next' => 'wrong_b'],
                ['label' => 'Opposite type left × opposite type right, per middle', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. n reaches 10^5, so about 1.7 · 10^14 triples.\nStep back to when you tried every triple.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Count width?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '64-bit', 'next' => 'success'],
                ['label' => '32-bit', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Counts reach about 4 · 10^13.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 6, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
