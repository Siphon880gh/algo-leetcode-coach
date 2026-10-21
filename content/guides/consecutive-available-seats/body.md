A cinema table lists seats by consecutive id, with a flag saying whether each seat is free. Return every free seat that is next to another free seat, ordered by seat id. For instance, if seats 1, 3, 4, 5 are free, the answer is 3, 4, 5. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Pair each seat with a neighbor

Using the column names the statement gives:

```sql
SELECT DISTINCT a.seat_id
FROM Cinema AS a
JOIN Cinema AS b
  ON ABS(a.seat_id - b.seat_id) = 1
 AND a.free = 1 AND b.free = 1
ORDER BY a.seat_id;
```

A seat qualifies if at least one neighbor is free. The join makes one row per free neighbor, so a seat in the middle of a run appears twice, and `DISTINCT` removes the repeat. `LAG`/`LEAD` over `seat_id` works too: keep the row when `free = 1` and the previous or next row is free.

Do not join only on `b.seat_id = a.seat_id + 1`; the last seat of a run has its free neighbor on the left. Do not forget `DISTINCT`.

Time: O(n) with an index on `seat_id`  
Space: O(n)

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
