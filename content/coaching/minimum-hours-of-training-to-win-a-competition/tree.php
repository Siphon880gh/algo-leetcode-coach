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
            'message' => "Read the problem statement above.\nEnergy needed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Σ energy + 1', 'next' => 's2'],
                ['label' => 'Σ energy', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Energy must stay strictly greater; Example 1 → 7 instead of 8.\nStep back to when you dropped the + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Top up experience when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When it is < the opponent’s', 'next' => 'wrong_b'],
                ['label' => 'When it is ≤ the opponent’s', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal experience loses; Example 1 → 7 instead of 8.\nStep back to when you allowed ties.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How much experience training?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Just enough at each shortfall, as you go', 'next' => 'success'],
                ['label' => 'Enough to beat the strongest opponent upfront', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Wins add experience; Example 1 → 10 instead of 8.\nStep back to when you trained upfront.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 8, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
