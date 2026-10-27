## Partner = x ^ 1

Couples are `(0, 1)`, `(2, 3)`, …, so the partner of `x` is `x ^ 1`.

Keep `pos[person] = seat`. For each even seat `i`:

- `p = row[i] ^ 1`. If `row[i + 1] == p`, continue.
- Otherwise swap `row[i + 1]` with `row[pos[p]]`, update both positions, and count a swap.

Each swap seats one couple for good and never undoes another.

**Why it is optimal:** treat each seat pair as a node and connect two nodes when they share a couple. Each component of size `k` is a cycle needing exactly `k − 1` swaps, so the minimum is `couples − components`, which union-find computes directly, and the greedy achieves it.

Do not search the row for the partner each time; with the map it is O(1). Do not swap the first person away; fix the second seat to keep the pairing simple.

Time: O(n)  
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
