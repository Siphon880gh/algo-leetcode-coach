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
            'message' => "Read the problem statement above.\nWhat to track per rod?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Which colours it has', 'next' => 's2'],
                ['label' => 'How many rings it has', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In Example 1, rod 6 has three rings but only two colours.\nStep back to when you counted rings.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How is each pair read?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rod first, then colour', 'next' => 'wrong_b'],
                ['label' => 'Colour first, then rod digit', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. B0 means a blue ring on rod 0.\nStep back to when you swapped them.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Rods with all three colours', 'next' => 'success'],
                ['label' => 'Distinct colours overall', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer is a number of rods.\nStep back to when you counted colours.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 1, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
