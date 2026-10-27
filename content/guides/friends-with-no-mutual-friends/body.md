A table lists pairs of users who are friends, each pair once. Report the friend pairs that have no friend in common. Table, column and output names, and the ordering, are in the official statement. _(Restated from memory. Table and column names in the SQL below follow the usual schema and may differ slightly; exact output names, formats, and sample data are in the official statement.)_

## Symmetric edges and NOT EXISTS

Using the column names the statement gives:

1. e = pairs in both directions (`UNION` of (a, b) and (b, a)).
2. Keep (u, v) from the table when no e1 = (u, w) and e2 = (v, w) exist.

Constructed check (run in SQLite): 1–2, 2–3, 2–4, 1–5, 6–7, 3–4, 2–5, 8–9 → (6, 7) and (8, 9).

Friendship goes both ways: using the pairs only as stored also returns (1, 5), (2, 4), (2, 5) and (3, 4), which do share friends.

Time: O(n²) worst case  
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
