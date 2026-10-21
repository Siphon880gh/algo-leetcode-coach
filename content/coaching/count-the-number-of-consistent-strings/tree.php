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
            'message' => "Read the problem statement above.\nCondition?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Every letter of the word is allowed', 'next' => 's2'],
                ['label' => 'Every allowed letter is in the word', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The containment goes the other way.\nStep back to when you reversed it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Fast membership?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Search the allowed string each time', 'next' => 'wrong_b'],
                ['label' => 'Set or 26-bit mask', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. That adds a factor of 26.\nStep back to when you searched.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Repeated letters in a word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Fine', 'next' => 'success'],
                ['label' => 'Make it inconsistent', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only membership matters.\nStep back to when you rejected repeats.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(total length). Examples → 2, 7, 4.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
