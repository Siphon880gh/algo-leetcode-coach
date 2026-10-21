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
            'message' => "Read the problem statement above.\nRepresent a word how?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'A 26-bit mask: letters are distinct and order can change', 'next' => 's2'],
                ['label' => 'The sorted string with its original order', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Rearranging is allowed, so order carries no information.\nStep back to when you kept order.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "May a target equal a start word?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No, exactly one letter must be added', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. In Example 1, act is not counted though act is a start word.\nStep back to when you allowed equality.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you count?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Targets that work, once each', 'next' => 'success'],
                ['label' => 'Every (start, target) match', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. The answer counts target words; Example 1 → 2.\nStep back to when you counted matches.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(26 · (S + T)). Examples → 2, 1.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
