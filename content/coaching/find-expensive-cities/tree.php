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
            'message' => "Problem: A table lists property listings, each with a city and a price. Report the cities whose average listing price is higher than the average price over all listings. Table, column and output names, and the ordering, are in the official statement. (Restated from memory; table names and details may differ slightly.)\nUsing the column names the statement gives:\nFilter with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'HAVING AVG(price) > …', 'next' => 's2'],
                ['label' => 'WHERE AVG(price) > …', 'next' => 'wrong_a'],
            ],
        ],
        'wrong_a' => [
            'message' => "You are wrong. WHERE runs before grouping; SQLite reports a misuse of aggregate avg().\nStep back to when you used WHERE.",
            'outcome' => 'wrong',
            'rewind_to' => 'start',
            'choices' => [],
        ],
        's2' => [
            'message' => "Compare with?",
            'outcome' => 'continue',
            'choices' => [
                ['label' => 'The average of the city averages', 'next' => 'wrong_b'],
                ['label' => 'The average over all listings', 'next' => 'success'],
            ],
        ],
        'wrong_b' => [
            'message' => "You are wrong. The sample’s overall average is 132.5, but the average of averages is about 164.4, which drops D.\nStep back to when you averaged the averages.",
            'outcome' => 'wrong',
            'rewind_to' => 's2',
            'choices' => [],
        ],
        'success' => [
            'message' => "Correct. Sample → B, D.\nYou finished this step-by-step path. Restart anytime, or step back to revisit a decision.",
            'outcome' => 'success',
            'choices' => [],
        ],
    ],
];
