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
            'message' => "Read the problem statement above.\nBefore simulating?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Sort buses and passengers', 'next' => 's2'],
                ['label' => 'Use them as given', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 10 instead of 20.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "First candidate time?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always the last bus’s time', 'next' => 'wrong_b'],
                ['label' => 'Last bus time if it has room, else the last boarded passenger’s time', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A full bus leaves you behind; Example 1 → 20 instead of 16.\nStep back to when you always used the bus time.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Candidate taken by a passenger?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Step back one minute at a time', 'next' => 'success'],
                ['label' => 'Return it anyway', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You cannot arrive with another passenger; Example 1 → 18 instead of 16.\nStep back to when you returned a taken time.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n + m log m). Examples → 16, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
