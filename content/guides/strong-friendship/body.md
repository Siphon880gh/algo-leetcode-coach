A friendship table lists pairs of friends, each stored once (typically with the smaller id first). A friendship is strong if the two users have at least three common friends, as the statement specifies. Report each strong friendship with its number of common friends, using the column names the statement gives. For instance, with friendships 1–2, 1–3, 1–4, 1–5, 2–3, 2–4, 2–5, 1–6, 3–6, 6–7, only 1–2 is strong, with 3 common friends. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Shared neighbours

Using the column names the statement gives:

1. `a` = friendships in both directions (`UNION ALL`).
2. For each stored pair `(x, y)`: join `a` as `x`'s friends and `a` as `y`'s friends on the same friend.
3. `GROUP BY` the pair; `HAVING COUNT(*) ≥ 3`; report the count.

Constructed check (run in SQLite, the example above): (1, 2, 3).

Start from the stored pairs so only actual friendships are reported, each once. Both directions are needed when listing friends; otherwise friends stored on the other side are missed.

Time: O(F · d), d = typical number of friends  
Space: O(F)

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
