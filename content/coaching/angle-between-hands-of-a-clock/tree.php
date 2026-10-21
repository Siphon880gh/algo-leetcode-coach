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
            'message' => "Read the problem statement above.\nHour hand position?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '30 · (h mod 12) + 0.5 · m', 'next' => 's2'],
                ['label' => '30 · h', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The hour hand moves with the minutes.\nStep back to when you fixed it on the hour.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Hour 12?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use 360°', 'next' => 'wrong_b'],
                ['label' => 'Treat as 0', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. 12 o'clock is the top, 0°.\nStep back to when you used 360.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Gap over 180°?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Use 360 − gap', 'next' => 'success'],
                ['label' => 'Keep it', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The smaller angle is wanted.\nStep back to when you kept the reflex angle.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(1). 12:30 → 165. 3:30 → 75. 3:15 → 7.5.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
