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
            'message' => "Read the problem statement above.\nWho is the partner of x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'x ^ 1', 'next' => 's2'],
                ['label' => 'x + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. For odd x the partner is x − 1; XOR with 1 handles both.\nStep back to when you used x + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "The second seat is not the partner. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search for the best swap among all seats', 'next' => 'wrong_b'],
                ['label' => 'Swap the partner into it, using a position map', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Seating the partner directly is optimal and each swap fixes a couple for good.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Why is greedy optimal?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Seat pairs linked by couples form cycles; a cycle of k pairs needs exactly k − 1 swaps', 'next' => 'success'],
                ['label' => 'It is only a heuristic', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is couples − cycles, and greedy reaches it.\nStep back to when you doubted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). [0,2,1,3] → 1. [3,2,0,1] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
