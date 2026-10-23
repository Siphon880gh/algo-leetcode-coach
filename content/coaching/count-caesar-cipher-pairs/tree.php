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
            'message' => "Read the problem statement above.\nKey?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Gaps from the first letter, mod 26', 'next' => 's2'],
                ['label' => 'Gaps without the mod', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 1 instead of 2.\nStep back to when you dropped the wrap.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Pairs from a key seen c times?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 if c ≥ 2', 'next' => 'wrong_b'],
                ['label' => 'c · (c − 1) / 2', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Constructed check (run in code): words = [\"aa\", \"bb\", \"cc\"] → 1 instead of 3.\nStep back to when you counted keys.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n · m). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
