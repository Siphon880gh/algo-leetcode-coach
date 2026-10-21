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
            'message' => "Read the problem statement above.\nLoop from low to high?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: O(1) formula', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. high can be 10^9.\nStep back to when you looped.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "(high − low) / 2?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always right', 'next' => 'wrong_b'],
                ['label' => 'Off by one when both ends are odd', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. low 3, high 7 → 3, not 2.\nStep back to when you trusted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Odds below low?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'low // 2', 'next' => 'success'],
                ['label' => '(low + 1) // 2', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That would count low itself.\nStep back to when you used (low + 1) // 2.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). (3, 7) → 3. (8, 10) → 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
