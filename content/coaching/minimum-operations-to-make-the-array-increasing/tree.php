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
            'message' => "Read the problem statement above.\nNew value for x?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'max(prev + 1, x)', 'next' => 's2'],
                ['label' => 'prev + 1 always', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A large x needs no change and may not be lowered.\nStep back to when you always used prev + 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Cost of the step?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'new value − prev', 'next' => 'wrong_b'],
                ['label' => 'new value − x', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. We pay for increments to x itself.\nStep back to when you used prev.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Ever lower an element?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Never, only increments exist', 'next' => 'success'],
                ['label' => 'Lower big values to save later cost', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The only operation adds 1.\nStep back to when you lowered a value.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 14, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
