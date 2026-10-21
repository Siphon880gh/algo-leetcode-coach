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
            'message' => "Read the problem statement above.\nPrice lookup?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Hash map', 'next' => 's2'],
                ['label' => 'Scan the product list', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is slow per item.\nStep back to when you scanned.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Discount when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'count == n only', 'next' => 'wrong_b'],
                ['label' => 'count mod n == 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every n-th customer gets it, repeatedly.\nStep back to when you applied it once.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Discounted bill?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'bill · (100 − discount) / 100', 'next' => 'success'],
                ['label' => 'bill − discount', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The discount is a percentage.\nStep back to when you subtracted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Example → [500, 4000, 800, 4000, 4000, 7350, 2500].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
