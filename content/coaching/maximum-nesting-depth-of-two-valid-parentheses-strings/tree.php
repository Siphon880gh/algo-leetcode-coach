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
            'message' => "Read the problem statement above.\nLabel by index parity?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: by depth parity', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A pair's two halves could get different labels.\nStep back to when you used the index.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Reading \"(\". Order of steps?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Label, then increase depth', 'next' => 'wrong_b'],
                ['label' => 'Increase depth, then label depth % 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Its partner \")\" is labeled before the decrease, so they would differ.\nStep back to when you labeled first.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What depth does each string reach?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'About half the original, rounded up', 'next' => 'success'],
                ['label' => 'The original depth', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Alternating levels splits the depth.\nStep back to when you kept the full depth.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"(()())\" → [1,0,0,0,0,1] (any valid labeling is accepted). \"()(())()\" → [1,1,1,0,0,1,1,1].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
