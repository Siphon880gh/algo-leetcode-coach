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
            'message' => "Read the problem statement above.\nCan you paste before your first copy?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: Copy All first, then paste', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The clipboard starts empty.\nStep back to when you pasted first.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "What do Copy All and k − 1 Pastes do?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Add k letters', 'next' => 'wrong_b'],
                ['label' => 'Multiply the length by k in k operations', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each paste adds the whole clipboard, so the length goes from m to m · k.\nStep back to when you added letters.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Which factorization of n is cheapest?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its prime factors, since a + b ≤ a · b for a, b ≥ 2', 'next' => 'success'],
                ['label' => 'n itself: one copy and n − 1 pastes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is optimal only when n is prime: 6 takes 5 steps (2 + 3), not 6.\nStep back to when you used n directly.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sum of the prime factors by trial division: O(√n). n = 3 → 3. n = 6 → 5. n = 1 → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
