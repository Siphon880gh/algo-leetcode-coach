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
            'message' => "Read the problem statement above.\nc bit 0, both a and b bits 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2 flips', 'next' => 's2'],
                ['label' => '1 flip', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Both bits must become 0.\nStep back to when you counted one.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "c bit 1, one of a or b is 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 flip', 'next' => 'wrong_b'],
                ['label' => '0 flips', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The OR is already 1.\nStep back to when you flipped.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Shortcut popcount((a | b) ^ c)?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Misses the double flip', 'next' => 'success'],
                ['label' => 'Is exact', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. It counts 1 where 2 flips are needed.\nStep back to when you trusted the shortcut.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(bits). (2, 6, 5) → 3. (4, 2, 7) → 1. (1, 2, 3) → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
