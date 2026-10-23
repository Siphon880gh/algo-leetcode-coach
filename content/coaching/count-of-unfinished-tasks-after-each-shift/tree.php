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
            'message' => "Read the problem statement above.\nEverything finished early?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Drop the rest of the shift', 'next' => 's2'],
                ['label' => 'Carry it into the next shift', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [0, 0, 0] instead of [0, 2, 0].\nStep back to when you carried the time.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Task in progress?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Not counted', 'next' => 'wrong_b'],
                ['label' => 'Still unfinished', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 3 → [1, 0, 1] instead of [2, 0, 2].\nStep back to when you skipped it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m + q log m). Examples → [0, 2, 1], [0, 2, 0], [2, 0, 2].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
