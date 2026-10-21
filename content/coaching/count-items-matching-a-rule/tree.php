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
            'message' => "Read the problem statement above.\nCheck which fields?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only the one named by ruleKey', 'next' => 's2'],
                ['label' => 'All three', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. In example 2 an item named phone is not of type phone.\nStep back to when you checked all fields.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Mapping?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Alphabetical index', 'next' => 'wrong_b'],
                ['label' => 'type → 0, color → 1, name → 2', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The item layout is type, color, name.\nStep back to when you sorted the keys.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Extra space?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'None', 'next' => 'success'],
                ['label' => 'A map of all values', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. A single counter suffices.\nStep back to when you built a map.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). Examples → 1, 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
