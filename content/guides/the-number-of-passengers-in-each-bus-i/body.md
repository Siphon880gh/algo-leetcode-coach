A buses table lists each bus id and its arrival time, and a passengers table lists each passenger id and arrival time. A passenger boards the first bus that arrives at or after the passenger's arrival, as the statement defines. Report how many passengers board each bus. For instance, buses 1, 2, 3 arriving at 2, 4, 7 and passengers arriving at 1, 5, 6, 7 → bus 1 carries 1, bus 2 carries 0, bus 3 carries 3. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Earliest bus per passenger

Using the column names the statement gives: take the boarding rule and output order from it too.

1. `t = (SELECT MIN(arrival_time) FROM Buses WHERE arrival_time ≥ p.arrival_time)` for each passenger `p`.
2. `Buses LEFT JOIN` those rows on `t = bus arrival_time`, `GROUP BY bus_id`, `COUNT(passenger_id)`.

Constructed check (run in SQLite, the example above): (1, 1), (2, 0), (3, 3).

`COUNT(passenger_id)` rather than `COUNT(*)` gives 0 for empty buses. Passengers with no later bus get `t` NULL and drop out.

Time: O(n · m) as written; O((n + m) log) with sorting  
Space: O(n)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
