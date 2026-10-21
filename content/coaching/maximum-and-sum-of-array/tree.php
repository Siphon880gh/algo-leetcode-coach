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
            'message' => "Read the problem statement above.\nPlace each number where AND is best right now?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: search all placements with DP', 'next' => 's2'],
                ['label' => 'Yes, greedily', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → 6 greedily, but 9 is possible.\nStep back to when you placed greedily.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "State per slot?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'One bit: used or not', 'next' => 'wrong_b'],
                ['label' => 'A base-3 digit: 0, 1 or 2 used', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Each slot holds up to two numbers, and Example 1 needs 6 numbers in 3 slots.\nStep back to when you used one bit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "AND with what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The 1-based slot number', 'next' => 'success'],
                ['label' => 'The 0-based slot index', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Slot 1 would become 0 and add nothing.\nStep back to when you used 0-based numbers.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(3^k · k). Examples → 9, 24.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
