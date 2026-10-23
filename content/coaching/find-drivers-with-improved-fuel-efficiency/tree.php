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
            'message' => "Read the problem statement above.\nAverage of what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Each trip’s distance / fuel', 'next' => 's2'],
                ['label' => 'Total distance / total fuel', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Bob Smith gets 2.04 instead of 2.10.\nStep back to when you pooled the totals.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Round when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The averages, then subtract', 'next' => 'wrong_b'],
                ['label' => 'Only the final values', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bob Smith gets 2.09 instead of 2.10.\nStep back to when you rounded early.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example (run in SQLite) → Bob Smith 2.10, Alice Johnson 2.05.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
