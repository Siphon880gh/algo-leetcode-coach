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
            'message' => "Read the problem statement above.\nWhich pairs can collide?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A right-mover followed by a left-mover', 'next' => 's2'],
                ['label' => 'Any two adjacent asteroids with different signs', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A left-mover followed by a right-mover moves apart.\nStep back to when you counted any sign change.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A negative asteroid beats the top. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Pop once and push it', 'next' => 'wrong_b'],
                ['label' => 'Pop and keep comparing with the new top', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. It may destroy several smaller right-movers in a row.\nStep back to when you stopped after one pop.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Equal sizes collide. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Both explode: pop the top and drop the newcomer', 'next' => 'success'],
                ['label' => 'The newcomer survives', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Equal asteroids destroy each other.\nStep back to when the newcomer survived.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with a stack. [5,10,-5] → [5,10]. [8,-8] → []. [10,2,-5] → [10].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
