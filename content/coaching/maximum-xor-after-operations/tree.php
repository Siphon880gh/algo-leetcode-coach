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
            'message' => "Read the problem statement above.\nCan the operation add bits?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it only clears them', 'next' => 's2'],
                ['label' => 'Yes, any value is reachable', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The AND with nums[i] keeps only its own bits; Example 2 cannot reach 15, since no number has the 4 bit.\nStep back to when you allowed new bits.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A bit set in several numbers?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'It cancels and is lost', 'next' => 'wrong_b'],
                ['label' => 'Keep it in one, clear it in the rest', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 1 instead of 7.\nStep back to when you dropped shared bits.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'OR of all numbers', 'next' => 'success'],
                ['label' => 'XOR of the numbers as given', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 3 instead of 7.\nStep back to when you XORed them unchanged.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 7, 11.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
