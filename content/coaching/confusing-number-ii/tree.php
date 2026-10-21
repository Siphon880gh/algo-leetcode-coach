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
            'message' => "Problem: Rotating by 180° turns 0, 1, 6, 8, 9 into 0, 1, 9, 8, 6; other digits become invalid. A confusing number rotates into a different valid number. Return how many confusing numbers lie in [1, n], with n up to 10⁹. n = 20 → 6. n = 100 → 19. (Restated from memory; limits and examples may differ slightly.)\nCheck every number from 1 to n?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: generate only rotatable numbers', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. That is 10⁹ checks.\nStep back to when you checked every number.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Append digit d to x. New rotation?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'old rotation · 10 + rot[d]', 'next' => 'wrong_b'],
                ['label' => 'rot[d] · place + old rotation', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The new digit becomes the leading digit after rotation.\nStep back to when you appended it on the right.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "May a number start with 0?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Leading zeros would double count.\nStep back to when you started with 0.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(5^digits). n = 20 → 6. n = 100 → 19.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
