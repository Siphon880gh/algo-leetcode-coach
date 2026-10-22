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
            'message' => "Read the problem statement above.\nn = 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '0', 'next' => 's2'],
                ['label' => 'Treat it as odd: 1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. The whole circle is already one slice.\nStep back to when you cut once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Odd n > 1?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '(n + 1) / 2 cuts', 'next' => 'wrong_b'],
                ['label' => 'n cuts', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Diameters split slices in pairs, which odd n cannot use; Example 2 → 2 instead of 3.\nStep back to when you halved.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). Examples → 2, 3.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
