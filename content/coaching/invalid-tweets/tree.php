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
            'message' => "Read the problem statement above.\nThreshold?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Strictly greater than 15', 'next' => 's2'],
                ['label' => 'At least 15', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Exactly 15 characters is valid.\nStep back to when you used ≥.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Length function?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'LENGTH (bytes)', 'next' => 'wrong_b'],
                ['label' => 'CHAR_LENGTH', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Bytes differ from characters for multi-byte text.\nStep back to when you used LENGTH.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any order', 'next' => 'success'],
                ['label' => 'Must sort by id', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The statement accepts any order.\nStep back to when you forced sorting.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
