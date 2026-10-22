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
            'message' => "Read the problem statement above.\nCommon when its count reaches?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '2', 'next' => 's2'],
                ['label' => '1', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. One sighting means it is in only one prefix; Example 1 → [2,2,3,4] instead of [0,2,3,4].\nStep back to when you used 1.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Output at step i?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the values that became common at i', 'next' => 'wrong_b'],
                ['label' => 'The running total', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. C counts everything common so far; Example 1 → [0,2,1,1] instead of [0,2,3,4].\nStep back to when you reset the count.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → [0,2,3,4], [0,1,3].\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
