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
            'message' => "Read the problem statement above.\nDo you add separators between letter codes?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No: codes are concatenated directly', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The problem joins codes with no separator, which is why words can collide.\nStep back to when you added separators.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Can two different words produce the same code?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No', 'next' => 'wrong_b'],
                ['label' => 'Yes, like "gin" and "zen"', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Without separators, different letter splits can match.\nStep back to when you ruled it out.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What do you return?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The number of distinct transformations', 'next' => 'success'],
                ['label' => 'The number of words', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Collisions reduce the count.\nStep back to when you counted words.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(Σ|word|). [\"gin\",\"zen\",\"gig\",\"msg\"] → 2.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
