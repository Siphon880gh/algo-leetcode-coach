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
            'message' => "Read the problem statement above.\nAdding x to the window adds how many pairs?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'cnt[x] before the increment', 'next' => 's2'],
                ['label' => '1 if x is already there', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. x pairs with every earlier copy; Example 1 → 0 instead of 1.\nStep back to when you added 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After shrinking, add?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'r − l + 1', 'next' => 'wrong_b'],
                ['label' => 'l', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Those are the starts that are not good; Example 2 → 24 instead of 4.\nStep back to when you added the window length.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
