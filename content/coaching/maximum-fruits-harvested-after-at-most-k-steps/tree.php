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
            'message' => "Read the problem statement above.\nShape of the harvested set?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'An interval containing startPos', 'next' => 's2'],
                ['label' => 'Any set of positions within k', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Walking between two positions harvests everything in between.\nStep back to when you picked arbitrary positions.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Steps for going L left and R right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'L + R', 'next' => 'wrong_b'],
                ['label' => 'min(2L + R, L + 2R)', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. You must come back past the start; in Example 1, L + R would allow positions 2 to 6 for 11 fruits, but the answer is 9.\nStep back to when you used L + R.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "As the right end moves right?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The left end only moves right', 'next' => 'success'],
                ['label' => 'Restart the left end each time', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That is O(n²); the smallest feasible left end never moves back.\nStep back to when you restarted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 9, 14, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
