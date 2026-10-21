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
            'message' => "Read the problem statement above.\nWhat do the pay rules imply?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Everyone is paid quality × the group\'s largest wage/quality ratio', 'next' => 's2'],
                ['label' => 'Each worker gets their minimum wage', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Pay must be proportional to quality, so the highest ratio sets the rate.\nStep back to when you paid minimums.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Sort the workers by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Wage, ascending', 'next' => 'wrong_b'],
                ['label' => 'wage / quality, ascending', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Walking ratios upward makes the current worker the rate setter.\nStep back to when you sorted by wage.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "With the current worker setting the rate, pick the others by?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Smallest qualities: a max-heap of size k', 'next' => 'success'],
                ['label' => 'Smallest wages', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Cost = rate × total quality.\nStep back to when you picked by wage.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). quality = [10,20,5], wage = [70,50,30], k = 2 → 105.0. quality = [3,1,10,10,1], wage = [4,8,2,2,7], k = 3 → 30.66667.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
