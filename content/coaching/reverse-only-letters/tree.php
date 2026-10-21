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
            'message' => "Read the problem statement above.\ns[i] is a \"-\". Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move i forward without swapping', 'next' => 's2'],
                ['label' => 'Swap it with s[j]', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. Non-letters must stay at their positions.\nStep back to when you swapped it.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Both s[i] and s[j] are letters. Then?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Move only i', 'next' => 'wrong_b'],
                ['label' => 'Swap and move both inward', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Both positions are done once swapped.\nStep back to when you moved one pointer.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "How do you test for a letter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'isalpha', 'next' => 'success'],
                ['label' => 'isalnum', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Digits are not letters and must stay put.\nStep back to when you used isalnum.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n). \"ab-cd\" → \"dc-ba\". \"a-bC-dEf-ghIj\" → \"j-Ih-gfE-dCba\". \"Test1ng-Leet=code-Q!\" → \"Qedo1ct-eeLg=ntse-T!\".\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
