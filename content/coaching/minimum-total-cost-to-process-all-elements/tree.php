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
            'message' => "Read the problem statement above.\nRefill cost order?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The i-th refill overall costs i', 'next' => 's2'],
                ['label' => 'Restart at 1 for each element', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 2 → 9 instead of 15.\nStep back to when you restarted the count.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "How many refills?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => '⌈sum / k⌉', 'next' => 'wrong_b'],
                ['label' => '⌈sum / k⌉ − 1, at least 0', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Example 1 → 6 instead of 3.\nStep back to when you forgot the starting k.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 3, 15, 0.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
