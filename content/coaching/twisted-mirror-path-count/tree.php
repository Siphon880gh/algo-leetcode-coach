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
            'message' => "Read the problem statement above.\nMirror cells?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pass the count on, turned', 'next' => 's2'],
                ['label' => 'Block them like walls', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 1 instead of 5.\nStep back to when you blocked mirrors.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Does a mirror turn the robot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, it goes straight through', 'next' => 'wrong_b'],
                ['label' => 'Yes: right becomes down, down becomes right', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 6 instead of 5.\nStep back to when you ignored the turn.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n). Examples → 5, 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
