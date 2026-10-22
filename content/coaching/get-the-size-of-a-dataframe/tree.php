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
            'message' => "Read the problem statement above.\nWhich attribute?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'shape', 'next' => 's2'],
                ['label' => 'size', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. size is rows × columns; the example → 50 instead of [10, 5].\nStep back to when you used size.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Return shape as?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The tuple itself', 'next' => 'wrong_b'],
                ['label' => 'A list', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. shape is a tuple, (10, 5); the answer wants a list.\nStep back to when you returned the tuple.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). The example → [10, 5].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
