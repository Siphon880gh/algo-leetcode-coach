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
            'message' => "Read the problem statement above.\nWhich first digits are allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '1 to 9', 'next' => 's2'],
                ['label' => '0 to 9', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Leading zeros are not allowed.\nStep back to when you started at 0.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Last digit d. Next digit options?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Any digit within k', 'next' => 'wrong_b'],
                ['label' => 'd − k and d + k, if in 0 to 9', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The difference must be exactly k.\nStep back to when you allowed any digit.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "k = 0. What goes wrong?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'd − k and d + k are the same digit; add it once', 'next' => 'success'],
                ['label' => 'Nothing', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. You would add each number twice.\nStep back to when you ignored duplicates.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(9 · 2ⁿ⁻¹). n = 3, k = 7 → [181,292,707,818,929]. n = 2, k = 1 → [10,12,21,23,32,34,43,45,54,56,65,67,76,78,87,89,98].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
