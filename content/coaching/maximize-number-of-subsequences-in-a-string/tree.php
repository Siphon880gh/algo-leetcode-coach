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
            'message' => "Read the problem statement above.\nWhere to insert?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Front or end only', 'next' => 's2'],
                ['label' => 'Try every position and recount', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. n reaches 10^5, so n recounts of O(n) each is about 10^10 steps.\nStep back to when you tried every position.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Where does pattern[0] go?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At the end', 'next' => 'wrong_b'],
                ['label' => 'At the front', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. At the end it pairs with nothing; Example 1 → 2 instead of 4.\nStep back to when you put it at the end.",
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
            'message' => "You are wrong. Pairs can reach about 5 · 10^9.\nStep back to when you chose 32-bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
