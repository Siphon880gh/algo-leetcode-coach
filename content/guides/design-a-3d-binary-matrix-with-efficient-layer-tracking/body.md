Design a class over an n × n × n binary array that starts all 0. It can set a cell to 1, set a cell to 0, and report the layer index x whose 2D slice holds the most 1s, choosing the larger x on ties. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Lazy heap

This assumes the tie rule also applies when every layer is empty (the answer is then n − 1); check the official statement.

1. set(x, y, z): if the cell is already 1, do nothing; else add it, cnt[x] += 1, push (cnt[x], x).
2. unset: if the cell is 1, remove it, cnt[x] −= 1, push (cnt[x], x).
3. query: pop while the top’s count ≠ cnt[x]; return the top’s x (largest count, then largest x).

Constructed check (run in code): n = 3; set (0, 0, 0) twice, (1, 2, 2), (1, 0, 1) → 1; unset (1, 2, 2) → 1 (tie, larger index). Checked against recounting on 300 random sequences.

Counting a repeated set again: the second query → 0 instead of 1.

Time: O(log q) amortized per operation  
Space: O(n + q)

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
