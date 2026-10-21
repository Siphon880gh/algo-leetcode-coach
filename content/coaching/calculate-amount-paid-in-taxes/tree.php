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
            'message' => "Read the problem statement above.\nDollars taxed in a bracket?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'min(income, upper) − previous upper', 'next' => 's2'],
                ['label' => 'min(income, upper)', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Lower dollars get taxed again at every rate; Example 1 → 4.7 instead of 2.65.\nStep back to when you taxed from 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "After the bracket that contains income?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep going', 'next' => 'wrong_b'],
                ['label' => 'Stop', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The next slice is negative; Example 2 → −0.75 instead of 0.25.\nStep back to when you kept going.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Divide by 100 how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Exactly, keeping fractions', 'next' => 'success'],
                ['label' => 'With integer division per bracket', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → 1 instead of 2.65.\nStep back to when you used integer division.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(brackets). Examples → 2.65, 0.25, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
