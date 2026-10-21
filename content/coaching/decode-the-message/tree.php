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
            'message' => "Read the problem statement above.\nMap a key letter when?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Its first appearance only', 'next' => 's2'],
                ['label' => 'Every appearance, later ones overwrite', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. Example 1 → whiu iu z urbtrw instead of this is a secret.\nStep back to when you let repeats overwrite.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Spaces in the key?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Give them a letter too', 'next' => 'wrong_b'],
                ['label' => 'Skip them', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Every later letter shifts by one; Example 1 → uijt jt a tfcsfu.\nStep back to when you mapped spaces.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Spaces in the message?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Keep them', 'next' => 'success'],
                ['label' => 'Drop them', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Example 1 → thisisasecret.\nStep back to when you dropped spaces.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(|key| + |message|). Examples → this is a secret; the five boxing wizards jump quickly.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
