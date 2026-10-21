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
            'message' => "Problem: You are given an integer array candies, where candies[i] is the flavor of the i-th candy, and an integer k. You must give k consecutive candies to your sister and keep the rest. Return the maximum number of unique flavors you can keep. For instance, [1,2,2,3,4,3] with k = 3 → 3; [2,2,2,2,3,3] with k = 2 → 2; [2,4,5] with k = 0 → 3. (Restated from memory; limits and examples may differ slightly.)\nWhich candies can you give?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any k consecutive candies', 'next' => 's2'],
                ['label' => 'Any k candies', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The k candies must be consecutive, so only n − k + 1 choices exist.\nStep back to when you picked freely.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Distinct flavors inside the window', 'next' => 'wrong_b'],
                ['label' => 'Distinct flavors outside the window', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You keep the candies outside the window.\nStep back to when you counted the gift.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "A flavor whose count outside drops to 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Remove its key', 'next' => 'success'],
                ['label' => 'Leave the key', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The number of keys would still count a flavor you no longer have.\nStep back to when you left it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed checks → 3, 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
