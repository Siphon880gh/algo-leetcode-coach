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
            'message' => "Read the problem statement above.\nTrack what?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The up and down lengths of the current run', 'next' => 's2'],
                ['label' => 'Only increasing runs', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. A mountain needs both a rise and a fall.\nStep back to when you tracked only rises.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When do you reset both counters?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only on equal neighbors', 'next' => 'wrong_b'],
                ['label' => 'When a rise starts after a fall, or on equal neighbors', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. After going down, a new rise starts a new mountain.\nStep back to when you kept counting.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "When does a run count as a mountain?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'up > 0 and down > 0: length up + down + 1', 'next' => 'success'],
                ['label' => 'up > 0', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A slope that only rises is not a mountain.\nStep back to when you required only a rise.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n), O(1) space. [2,1,4,7,3,2,5] → 5. [2,2,2] → 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
