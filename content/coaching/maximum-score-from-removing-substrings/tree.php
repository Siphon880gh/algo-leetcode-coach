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
            'message' => "Read the problem statement above.\nWhich pair first?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The one worth more', 'next' => 's2'],
                ['label' => 'Whichever appears first', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Each removal of the cheaper pair can block a more valuable one.\nStep back to when you took the first one seen.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How to remove repeatedly?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Repeated string replace', 'next' => 'wrong_b'],
                ['label' => 'A stack: pop when top + current forms the pair', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Repeated replace can be O(n²).\nStep back to when you used replace.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Second pass input?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The stack left by the first pass', 'next' => 'success'],
                ['label' => 'The original string', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The first pass already consumed some letters.\nStep back to when you restarted from s.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 19, 20.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
