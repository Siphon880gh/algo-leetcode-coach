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
            'message' => "Problem: You are given the power of each of a small number of monsters. You start with no mana, and each day your mana grows by your current gain, which starts at 1. When your mana is at least a monster’s power you can defeat it; that resets your mana to 0 and raises your gain by 1. Return the fewest days needed to defeat every monster; the exact rules are in the official statement. For instance, [3,1,4] → 4 and [1,2,4,9] → 6. (Restated from memory; limits and examples may differ slightly.)\nOrder of fights?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Try every order with a bitmask DP', 'next' => 's2'],
                ['label' => 'Weakest monster first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [3,1,4] → 5 instead of 4.\nStep back to when you fought greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Days for power p with gain g?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'floor(p / g)', 'next' => 'wrong_b'],
                ['label' => 'ceil(p / g)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Mana must reach p; [3,1,4] → 3 instead of 4.\nStep back to when you rounded down.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Visit masks in which order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Increasing', 'next' => 'success'],
                ['label' => 'Decreasing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A mask is reached only from smaller masks, so the full set is never filled.\nStep back to when you went downward.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(2^n · n). Constructed checks → 4, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
