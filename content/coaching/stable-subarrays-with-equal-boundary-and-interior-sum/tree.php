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
            'message' => "Read the problem statement above.\nWhen does l become usable?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At r = l + 2', 'next' => 's2'],
                ['label' => 'At r = l + 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Constructed check (run in code): [0, 0, 0] → 3 instead of 1.\nStep back to when you allowed length 2.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Key includes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the prefix condition for capacity[l]', 'next' => 'wrong_b'],
                ['label' => 'capacity[l] and its prefix (so capacity[r] must match too)', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 3 instead of 2.\nStep back to when you ignored capacity[r].",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 2, 0, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
