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
            'message' => "Read the problem statement above.\nAfter visit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Forward history is cleared (end = cur)', 'next' => 's2'],
                ['label' => 'Keep forward pages', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The statement clears forward history.\nStep back to when you kept it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "back(steps) beyond the start?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Error', 'next' => 'wrong_b'],
                ['label' => 'Clamp at 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Move back as far as possible.\nStep back to when you errored.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "forward limit?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'end, not the array length', 'next' => 'success'],
                ['label' => 'Array length', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Stale entries may linger past end.\nStep back to when you used the length.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1) per call. The statement example → facebook, google, facebook, then linkedin clears forward history.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
