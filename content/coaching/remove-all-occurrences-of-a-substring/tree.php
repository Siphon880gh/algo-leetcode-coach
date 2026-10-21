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
            'message' => "Read the problem statement above.\nOne pass of replace-all?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'No, removals can create new matches', 'next' => 's2'],
                ['label' => 'Yes', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. 'daabcbaabcbc' needs several rounds.\nStep back to when you replaced once.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "When to check?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Only at the end', 'next' => 'wrong_b'],
                ['label' => 'After every push', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. New occurrences form as you go.\nStep back to when you waited.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "What to compare?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The last len(part) characters', 'next' => 'success'],
                ['label' => 'The whole stack', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Only the suffix can newly match.\nStep back to when you compared everything.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Examples → \"dab\", \"ab\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
