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
            'message' => "Read the problem statement above.\nCompare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each pair separately', 'next' => 's2'],
                ['label' => 'All four letters', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Letters cannot cross pairs; example 2 → true instead of false.\nStep back to when you pooled them.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The pairs are?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Positions (0, 1) and (2, 3)', 'next' => 'wrong_b'],
                ['label' => 'Positions (0, 2) and (1, 3)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Swaps are two apart; example 1 → false instead of true.\nStep back to when you paired neighbours.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → true, false.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
