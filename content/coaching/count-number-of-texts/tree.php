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
            'message' => "Read the problem statement above.\nLook back over?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Presses of the same key', 'next' => 's2'],
                ['label' => 'Any previous presses', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. 2 and 3 never form one letter; Example 1 → 13 instead of 8.\nStep back to when you ignored the key.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Keys 7 and 9?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Up to 3 like the others', 'next' => 'wrong_b'],
                ['label' => 'Up to 4 presses', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. They have four letters; 77777 → 13 instead of 15.\nStep back to when you capped them at 3.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When to take the modulo?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'At every step', 'next' => 'success'],
                ['label' => 'Only at the end', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A run of 73 presses of 2 already passes 2^63.\nStep back to when you waited for the end.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 8, 82876089.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
