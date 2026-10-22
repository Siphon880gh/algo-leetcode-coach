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
            'message' => "Read the problem statement above.\nWhen to take the modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at the end', 'next' => 's2'],
                ['label' => 'During the simulation', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. [118820, 625641], k = 4, multiplier = 950610 → [951479416, 167914347] instead of [841312365, 262451657].\nStep back to when you reduced early.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "multiplier = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Run the heap loop', 'next' => 'wrong_b'],
                ['label' => 'Return nums', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The loop then runs k times, up to 10^9.\nStep back to when you ran the loop.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · log max + n log k). Examples → [8, 4, 6, 5, 6], [999999307, 999999993].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
