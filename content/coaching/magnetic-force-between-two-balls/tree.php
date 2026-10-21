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
            'message' => "Read the problem statement above.\nSort positions?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 's2'],
                ['label' => 'No', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Greedy placement needs order.\nStep back to when you skipped sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Greedy placement?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Spread evenly by index', 'next' => 'wrong_b'],
                ['label' => 'Leftmost first, then next ≥ last + d', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Positions are uneven.\nStep back to when you spread by index.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Mid when feasible moves lo up?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Upper mid', 'next' => 'success'],
                ['label' => 'Lower mid', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Lower mid can loop forever.\nStep back to when you used lower mid.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log range). [1,2,3,4,7], 3 → 3. Example 2 → 999999999.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
