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
                ['label' => 'How many learn on each day', 'next' => 's2'],
                ['label' => 'Each person separately', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. With delay = 1 and a long forget the count doubles daily, near 2^999 people by day 1000.\nStep back to when you tracked people.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Who shares on day d?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Learned on days d − forget … d − delay', 'next' => 'wrong_b'],
                ['label' => 'Learned on days d − forget + 1 … d − delay', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. People forget on day j + forget and do not share then; Example 1 → 6 instead of 5.\nStep back to when you widened the window.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Answer sums?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last forget days', 'next' => 'success'],
                ['label' => 'Every day', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. That counts people who already forgot; Example 1 → 6 instead of 5.\nStep back to when you summed every day.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 5, 6.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
