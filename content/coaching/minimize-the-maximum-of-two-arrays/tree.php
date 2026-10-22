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
            'message' => "Read the problem statement above.\nConditions for a cap x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each array’s own count, plus x − x / lcm ≥ c1 + c2', 'next' => 's2'],
                ['label' => 'Only each array’s own count', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The two arrays cannot share numbers; Example 1 → 3 instead of 4.\nStep back to when you dropped the shared condition.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Numbers neither array can use are multiples of?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd1 · d2', 'next' => 'wrong_b'],
                ['label' => 'lcm(d1, d2)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. With d1 = d2 = 2 and c1 = c2 = 1, every even number is blocked, not just multiples of 4; → 2 instead of 3.\nStep back to when you multiplied.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(log(c1 + c2)). Examples → 4, 3, 15.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
