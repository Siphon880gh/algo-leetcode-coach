## Dijkstra

1. Push (0, −power, source).
2. Pop (t, −p, u). u = target → return [t, p].
3. Skip u if a state with at least p power was already expanded there. If p ≥ cost[u], push (t + w, −(p − cost[u]), v) for each edge u → v.
4. Nothing left → [−1, −1].

Examples → [3, 0], [0, 3], [−1, −1]. Checked against trying every path on 3,000 random graphs. Times reach 10^12, so use 64-bit integers.

Keeping one best state per node: constructed check (run in code) n = 4, edges [[0, 2, 4], [0, 1, 1], [1, 2, 2], [2, 3, 5]], power = 8, cost = [2, 4, 3, 5], 0 → 3 → [−1, −1] instead of [9, 3].

Time: O(P · (n + E) log(P · n)), P = power  
Space: O(P · n)

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
