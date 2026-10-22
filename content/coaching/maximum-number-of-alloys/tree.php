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
            'message' => "Read the problem statement above.\nCoins for metal j?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(0, need − stock) · cost', 'next' => 's2'],
                ['label' => '(need − stock) · cost', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Spare stock earns money back; example 2 → 52 instead of 5.\nStep back to when you dropped the max.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Search alloys up to?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'budget', 'next' => 'wrong_b'],
                ['label' => 'budget + max(stock)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Stock alone can build more; comp [1], stock [10], budget 0 → 0 instead of 10.\nStep back to when you capped at budget.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(k · n · log(budget + stock)). Examples → 2, 5, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
