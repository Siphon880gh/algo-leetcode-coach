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
            'message' => "Read the problem statement above.\nCode characters allowed?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Letters, digits and underscores', 'next' => 's2'],
                ['label' => 'Letters and digits only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → [] instead of [ELECTRONICS_50].\nStep back to when you rejected _.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Empty code?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Valid', 'next' => 'wrong_b'],
                ['label' => 'Invalid', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → [\"\", PHARMA5, SAVE20] instead of [PHARMA5, SAVE20].\nStep back to when you allowed it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n · L). Examples → [PHARMA5, SAVE20], [ELECTRONICS_50].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
