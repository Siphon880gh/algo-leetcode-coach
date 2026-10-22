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
            'message' => "Problem: Given two arrays of the same length, prices and profits, choose three indices i < j < k whose prices strictly increase. Return the largest total profit of the three items; what to return when no such triple exists, and the limits, are in the official statement. For instance, prices [10, 2, 3, 4] with profits [100, 2, 7, 10] → 19. (Restated from memory; limits and examples may differ slightly.)\nLeft partner?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Best profit with a smaller price', 'next' => 's2'],
                ['label' => 'Best profit anywhere on the left', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Prices must increase; prices [10, 2, 3, 4] with profits [100, 2, 7, 10] → 117 instead of 19.\nStep back to when you ignored the price.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Equal prices?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Allowed', 'next' => 'wrong_b'],
                ['label' => 'Not allowed', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Prices strictly increase; [2, 2, 3, 4] with profits [5, 9, 1, 2] → 16 instead of 12.\nStep back to when you allowed equal prices.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n²). The example → 19.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
