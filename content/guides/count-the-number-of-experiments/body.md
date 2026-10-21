An experiments table records each experiment's platform and name, drawn from fixed lists given in the statement (for example Android, IOS, Web and Reading, Sports, Programming). Report the number of experiments for every platform–name combination, including combinations with zero, using the column names the statement gives. For instance, with experiments IOS-Programming, IOS-Sports, Android-Reading, Web-Reading twice and Web-Programming, Web-Reading has 2, four other combinations have 1, and the remaining four have 0. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## All combinations first

Using the column names the statement gives:

1. `p` = the platforms as a derived table (`SELECT … UNION ALL …`), `n` = the experiment names.
2. `p CROSS JOIN n LEFT JOIN experiments ON both match`.
3. `GROUP BY` platform, name; `COUNT(experiment id)`.

Constructed check (run in SQLite, the example above): Web-Reading 2; Android-Reading, IOS-Programming, IOS-Sports, Web-Programming 1; the other four 0.

Count a column from the experiments side; `COUNT(*)` would turn empty combinations into 1.

Time: O(E)  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
