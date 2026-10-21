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
            'message' => "Problem: Alice and Bob take turns, Alice first. On a turn a player removes any positive number of stones from a single non-empty pile; a player who cannot move loses. Given the pile sizes and assuming optimal play, return true if Alice wins. For instance, [1] → true, [1,1] → false, and [1,2,3] → false. (Restated from memory; limits and examples may differ slightly.)\nCombine piles with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR', 'next' => 's2'],
                ['label' => 'Sum', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. [1, 1] sums to 2 yet the first player loses.\nStep back to when you summed.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Alice wins when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'XOR = 0', 'next' => 'wrong_b'],
                ['label' => 'XOR ≠ 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Zero nim-sum is a loss for the player to move.\nStep back to when you flipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Search the game tree?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not needed', 'next' => 'success'],
                ['label' => 'Required', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The XOR rule decides it directly.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Constructed check → true, false, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
