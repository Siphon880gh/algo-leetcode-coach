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
            'message' => "Read the problem statement above.\nRefill early to save steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it is not allowed', 'next' => 's2'],
                ['label' => 'Yes, when the can is low', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. You may refill only when the next plant needs more than you have.\nStep back to when you refilled early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Extra steps for a refill before plant i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'i', 'next' => 'wrong_b'],
                ['label' => '2 · i', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. From plant i − 1 the river is i steps away and the way back is another i; Example 1 → 14, not 9.\nStep back to when you counted one way.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Refill when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When water < plants[i]', 'next' => 'success'],
                ['label' => 'Only when the can is empty', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A plant must be watered fully in one go.\nStep back to when you waited for empty.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 14, 30, 49.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
