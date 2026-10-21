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
            'message' => "Problem: An events table records, per business and event type, how many times that event occurred. For each event type, take its average count across the businesses that have it. A business is active when more than one of its event types is above that type's average. Report the active businesses. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nAverage over which rows?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'All businesses with that event type', 'next' => 's2'],
                ['label' => 'All events of the business', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong here. The comparison is against the type's average.\nStep back to when you averaged per business.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "A row equals its type average. Count it?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'Yes', 'next' => 'wrong_b'],
                ['label' => 'No: it must be above', 'next' => 's3'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. Equal is not above.\nStep back to when you counted it.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        's3' => [
            'message' => "Final filter?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING COUNT(*) > 1 per business', 'next' => 'success'],
                ['label' => 'HAVING COUNT(*) ≥ 1', 'next' => 'wrong_c'],
            ],
        ],
        'wrong_c' => [
            'message' => "You are wrong. Active needs more than one event type.\nStep back to when you allowed one.",
            'outcome' => 'wrong',
            'rewind_to' => 's3',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. O(n) with hashing. Businesses with two or more above-average event types are returned.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
