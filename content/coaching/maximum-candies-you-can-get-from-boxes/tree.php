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
            'message' => "Read the problem statement above.\nOpen a box when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'You hold it and it is open or you have its key', 'next' => 's2'],
                ['label' => 'You have its key', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A key is useless without the box.\nStep back to when you opened an unheld box.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A key arrives for a held locked box?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Ignore it', 'next' => 'wrong_b'],
                ['label' => 'Open it now', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That box is now openable.\nStep back to when you ignored it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Open the same box twice?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: mark opened', 'next' => 'success'],
                ['label' => 'Yes', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Candies would be counted twice.\nStep back to when you reopened it.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(boxes + keys + contained). First example → 16. Second → 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
