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
            'message' => "Read the problem statement above.\nMark visited by cell only?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: by (row, col, key mask)', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. After picking up a key you may need to walk back through cells you have seen.\nStep back to when you marked cells only.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "You reach a lock \"B\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Always pass', 'next' => 'wrong_b'],
                ['label' => 'Pass only if bit 1 (key b) is in the mask', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. A lock blocks you until you hold its key.\nStep back to when you walked through.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When do you stop?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'When the mask has every key', 'next' => 'success'],
                ['label' => 'When you reach the far corner', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The goal is to collect all keys, not to reach a place.\nStep back to when you aimed for a corner.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(m · n · 2^K). [\"@.a..\",\"###.#\",\"b.A.B\"] → 8. [\"@..aA\",\"..B#.\",\"....b\"] → 6. [\"@Aa\"] → −1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
