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
            'message' => "Read the problem statement above.\nSort key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'minimum − actual', 'next' => 's2'],
                ['label' => 'minimum only', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Slack decides the order by an exchange argument.\nStep back to when you sorted by minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Build direction?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Forward from zero', 'next' => 'wrong_b'],
                ['label' => 'From the last task done (smallest slack) back', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The needed energy accumulates from the end.\nStep back to when you went forward.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Update?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'e = max(minimum, e + actual)', 'next' => 'success'],
                ['label' => 'e += minimum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only actual is spent; minimum is a threshold.\nStep back to when you added minimum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n log n). Examples → 8, 32, 27.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
